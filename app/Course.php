<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $primaryKey = 'course_id';
    protected $table = 'r_courses';
    protected $filable = ['course_id', 'course_code', 'course_description', 'year_level', 'semester', 'is_active'];
}
