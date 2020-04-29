<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'student_no', 'faculty_id', 'user_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function faculty()
    {
        return $this->belongsTo('App\Models\Faculty');
    }
}
