<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Exception;

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

    /**
     * 成績データを取得
     * @param int $student_id
     * @return array 成績データの配列
     */
    public function createOne($params)
    {
        try {
            // DBに保存
            $school_grade = new SchoolGrade();
            $school_grade->fill($params)->save();
            return true;
        } catch (Exception $e) {
            // エラー処理
            report($e);
            return false;
        }
    }

    /**
     * 成績データを取得
     * @param int $student_id
     * @return array 成績データの配列
     */
    public function editOne($params)
    {
        try {
            // DBに保存
            $school_grade = SchoolGrade::find($params['id']);
            if (!$school_grade) {
                return false;
            }
            unset($params['id']);
            $school_grade->fill($params)->save();
            return true;
        } catch (Exception $e) {
            // エラー処理
            report($e);
            return false;
        }
    }

    /**
     * 成績データを削除
     * @param int $id
     * @return bool 削除成功時true、失敗時false
     */
    public function deleteOne($id)
    {
        try {
            // 対象の成績データを取得
            $school_grade = SchoolGrade::find($id);

            // 存在する場合のみ削除を実行
            if ($school_grade) {
                return $school_grade->delete();
            }

            return false;
        } catch (Exception $e) {
            // エラー処理
            report($e);
            return false;
        }
    }
}
