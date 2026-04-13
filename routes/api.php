<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\RFIDLog;

Route::post('/sensor-data', function (Request $request) {

    // Always log raw scan
    RFIDLog::create([
        'rfid_uid'  => $request->rfid_no,
        'scan_time' => now()
    ]);

    // Find student by rfid_code
    $student = Student::where('rfid_code', $request->rfid_no)->first();

    if (!$student) {
        Cache::put('last_notification', [
            'message' => 'Card not registered',
            'student' => 'Unknown',
            'type'    => 'warning',
            'time'    => now()->toTimeString()
        ], 10);

        return response()->json([
            'message' => 'Student not found',
            'uid'     => $request->rfid_no
        ], 404);
    }

    // Check today's attendance
    $existing = Attendance::where('student_id', $student->student_id)
        ->where('date', now()->toDateString())
        ->first();

    if ($existing) {
        if ($existing->time_in && $existing->time_out) {
            Cache::put('last_notification', [
                'message' => 'Attendance already completed for today',
                'student' => $student->name,
                'type'    => 'warning',
                'time'    => now()->toTimeString()
            ], 10);

            return response()->json([
                'message' => 'Attendance already completed for today',
                'student' => $student->name
            ]);
        }

        if ($existing->time_in && !$existing->time_out) {
            $existing->update([
                'time_out' => now()->toTimeString()
            ]);

            Cache::put('last_notification', [
                'message' => 'Time out recorded',
                'student' => $student->name,
                'type'    => 'info',
                'time'    => now()->toTimeString()
            ], 10);

            return response()->json([
                'message' => 'Time out recorded',
                'student' => $student->name
            ]);
        }
    }

    // First scan — record time in
    Attendance::create([
        'student_id' => $student->student_id,
        'date'       => now()->toDateString(),
        'time_in'    => now()->toTimeString()
    ]);

    Cache::put('last_notification', [
        'message' => 'Time in recorded',
        'student' => $student->name,
        'type'    => 'success',
        'time'    => now()->toTimeString()
    ], 10);

    return response()->json([
        'message' => 'Time in recorded',
        'student' => $student->name
    ]);
});

// Notification polling
Route::get('/notification', function () {
    return response()->json(Cache::get('last_notification'));
});

// Latest scan for registration autofill
Route::get('/latest-scan', function () {
    $latest = \App\Models\RFIDLog::latest('scan_time')->first();
    return response()->json($latest ? ['rfid_uid' => $latest->rfid_uid] : null);
});