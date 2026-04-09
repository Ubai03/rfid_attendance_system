<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use App\Models\Attendance;

Route::post('/sensor-data', function (Request $request) {

    $existing = Attendance::where('matrix_no', $request->matrix_no)
        ->where('date', now()->toDateString())
        ->first();

    if ($existing) {
        if ($existing->time_in && $existing->time_out) {
            Cache::put('last_notification', [
                'message' => 'Attendance already completed for today',
                'student' => $request->student_name,
                'type'    => 'warning',
                'time'    => now()->toTimeString()
            ], 10);

            return response()->json([
                'message' => 'Attendance already completed for today',
                'student' => $request->student_name
            ]);
        }

        if ($existing->time_in && !$existing->time_out) {
            $existing->update([
                'time_out' => now()->toTimeString()
            ]);

            Cache::put('last_notification', [
                'message' => 'Time out recorded',
                'student' => $request->student_name,
                'type'    => 'info',
                'time'    => now()->toTimeString()
            ], 10);

            return response()->json([
                'message' => 'Time out recorded',
                'student' => $request->student_name
            ]);
        }
    }

    Attendance::create([
        'student_name' => $request->student_name,
        'matrix_no'    => $request->matrix_no,
        'course_name'  => $request->course_name,
        'date'         => now()->toDateString(),
        'time_in'      => now()->toTimeString()
    ]);

    Cache::put('last_notification', [
        'message' => 'Time in recorded',
        'student' => $request->student_name,
        'type'    => 'success',
        'time'    => now()->toTimeString()
    ], 10);

    return response()->json([
        'message' => 'Time in recorded',
        'student' => $request->student_name
    ]);
});

// Polling endpoint for dashboard
Route::get('/notification', function () {
    $notification = Cache::get('last_notification');
    return response()->json($notification);
});