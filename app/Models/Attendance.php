<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';
    protected $primaryKey = 'attendance_id';

    protected $fillable = [
        'student_id',
        'date',
        'time_in',
        'time_out'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}