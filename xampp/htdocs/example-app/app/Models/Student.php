<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'students';

    /**
     * 複数代入可能な属性
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'grade', 'address', 'comment', 'img_path'];

    /**
     * キャストする属性
     *
     * @var array<string, string>
     */
    protected $casts = [
        'grade' => 'integer',
    ];

    /**
     * 画像をアップロードして保存パスを返す
     *
     * @param UploadedFile $file アップロードされたファイル
     * @param string|null $oldPath 古い画像パス（存在する場合は削除）
     * @return string 保存されたファイルのパス
     * @throws Exception アップロード失敗時に例外をスロー
     */
    public function saveImage(UploadedFile $file, ?string $oldPath = null)
    {
        try {
            // アップロードファイルのバリデーション
            $this->validateImageFile($file);

            // 古いファイルがある場合は削除
            if ($oldPath && Storage::disk('public')->exists(str_replace('uploads/', '', $oldPath))) {
                Storage::disk('public')->delete(str_replace('uploads/', '', $oldPath));
            }

            // ファイル名をユニークにする
            $filename = time() . '_' . $file->getClientOriginalName();

            // ファイルを保存(public/uploads に保存)
            $path = Storage::disk('public')->putFileAs('', $file, $filename);
            return "uploads/" . $path;
        } catch (Exception $e) {
            \Log::error('画像保存中にエラーが発生しました: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * アップロードされた画像ファイルをバリデーション
     *
     * @param UploadedFile $file
     * @throws Exception バリデーション失敗時
     */
    private function validateImageFile(UploadedFile $file)
    {
        $allowedMimes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 5 * 1024 * 1024; // 5MB

        if (!in_array($file->getMimeType(), $allowedMimes)) {
            throw new Exception('許可されていないファイル形式です。JPEG、PNG、GIF形式のみアップロード可能です。');
        }

        if ($file->getSize() > $maxSize) {
            throw new Exception('ファイルサイズが大きすぎます。5MB以下のファイルを選択してください。');
        }
    }

    /**
     * 学生データを編集（画像処理を含む）
     *
     * @param array $params リクエストパラメータ
     * @param UploadedFile|null $file アップロードされた画像ファイル
     * @param bool $fileChanged 画像が変更されたかどうか
     * @return Student 更新された学生モデル
     * @throws Exception 更新失敗時に例外をスロー
     */
    public function editOneWithImage(array $params, ?UploadedFile $file = null, bool $fileChanged = false)
    {
        try {
            // DBに保存
            $student = Student::find($params['id']);
            if (!$student) {
                throw new Exception('編集対象の学生が見つかりません。');
            }

            $studentId = $params['id'];
            unset($params['id']);

            // ファイル変更があった場合
            if ($fileChanged && $file) {
                $oldPath = $student->img_path;
                $params['img_path'] = $this->saveImage($file, $oldPath);
            }

            $student->fill($params)->save();
            return $student;
        } catch (Exception $e) {
            \Log::error('学生データ編集中にエラーが発生しました: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * 学生データを新規作成（画像処理を含む）
     *
     * @param array $params リクエストパラメータ
     * @param UploadedFile|null $file アップロードされた画像ファイル
     * @return Student 作成された学生モデル
     * @throws Exception 作成失敗時に例外をスロー
     */
    public function createOneWithImage(array $params, ?UploadedFile $file = null)
    {
        try {
            // 画像がある場合は保存
            if ($file) {
                $params['img_path'] = $this->saveImage($file);
            }

            // DBに保存
            $student = new Student();
            $student->fill($params)->save();
            return $student;
        } catch (Exception $e) {
            \Log::error('学生データ作成中にエラーが発生しました: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * 学生データを編集
     *
     * @param array $params リクエストパラメータ
     * @return Student 更新された学生モデル
     * @throws Exception 編集失敗時に例外をスロー
     */
    public function editOne(array $params)
    {
        try {
            return $this->editOneWithImage($params);
        } catch (Exception $e) {
            \Log::error('学生データ編集中にエラーが発生しました: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * 学生データを作成
     *
     * @param array $params リクエストパラメータ
     * @return Student 作成された学生モデル
     * @throws Exception 作成失敗時に例外をスロー
     */
    public function createOne(array $params)
    {
        try {
            return $this->createOneWithImage($params);
        } catch (Exception $e) {
            \Log::error('学生データ作成中にエラーが発生しました: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * 学生データを削除
     *
     * @param int $id
     * @return bool 削除成功時true、失敗時false
     * @throws Exception 削除中にエラーが発生した場合
     */
    public function deleteOne(int $id)
    {
        try {
            // 対象のStudentを取得
            $student = Student::find($id);

            // 存在する場合のみ削除を実行
            if ($student) {
                // 関連する画像の削除
                if ($student->img_path && Storage::disk('public')->exists(str_replace('uploads/', '', $student->img_path))) {
                    Storage::disk('public')->delete(str_replace('uploads/', '', $student->img_path));
                }

                return $student->delete();
            }

            return false;
        } catch (Exception $e) {
            \Log::error('学生削除中にエラーが発生しました: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * 学年を一括で更新する（N+1問題を避けるため一括更新）
     *
     * @return int 更新された学生数
     * @throws Exception 更新に失敗した場合
     */
    public function updateSchoolYear()
    {
        try {
            // N+1問題を避けるため、一括で更新を行う
            $affectedRows = Student::where('grade', '<', 6)
                ->update(['grade' => \DB::raw('grade + 1')]);

            return $affectedRows;
        } catch (Exception $e) {
            \Log::error('学年更新中にエラーが発生しました: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * このモデルが所属するリレーションシップの例
     * （実際のアプリケーションに応じて調整）
     */
    public function schoolGrade()
    {
        return $this->belongsTo(SchoolGrade::class, 'grade', 'id');
    }
}
