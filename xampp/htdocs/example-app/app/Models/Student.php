<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'grade','address','comment','img_path']; 
    public function editOne($params){
        // DBに保存
        $student = Student::find($params['id']);
        unset($params['id']);
        $student->fill($params)->save();
    }

    public function createOne($params){
        // DBに保存
        $student = new Student();
        $student->fill($params)->save();
    }
}
