<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';

    protected $primaryKey = 'attendance_id';

    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'time_in',
        'time_out',
        'date'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}