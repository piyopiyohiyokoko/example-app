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

    /**
     * 成績データを削除
     * @param int $id
     * @return bool 削除成功時true、失敗時false
     */
    public function deleteOne($id){
        // 対象の成績データを取得
        $school_grade = SchoolGrade::find($id);

        // 存在する場合のみ削除を実行
        if($school_grade) {
            return $school_grade->delete();
        }

        return false;
    }
}
