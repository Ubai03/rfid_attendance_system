<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RFIDLog extends Model
{
    protected $table = 'rfid_scans';

    protected $primaryKey = 'id';

    public $timestamps = false; 

    protected $fillable = [
        'rfid_uid',
        'student_name',
        'matrix_no',
        'course_name',
        'scan_time'
    ];
}
