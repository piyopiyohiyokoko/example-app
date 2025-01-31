<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolGrade extends Model
{
    protected $fillable = [
        'student_id', 
        'grade',
        'term',
        'japanese',
        'math',
        'science',
        'social_studies',
        'music',
        'home_economics',
        'english',
        'art',
        'health_and_physical_education',
    ]; 
    public function createOne($params){
        // DBに保存
        $school_grade = new SchoolGrade();
        $school_grade->fill($params)->save();
    }

    public function editOne($params){
        // DBに保存
        $school_grade = SchoolGrade::find($params['id']);
        unset($params['id']);
        $school_grade->fill($params)->save();
    }

    
}
