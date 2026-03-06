<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $primaryKey = 'student_id';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'matric_no',
        'course',
        'rfid_code'
    ];

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }
}