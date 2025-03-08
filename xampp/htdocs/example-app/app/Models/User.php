<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Exception;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_name', 'email', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * ユーザーを作成する
     *
     * @param array $params ユーザー情報の配列
     * @return User 作成されたユーザーインスタンス
     * @throws Exception 作成中にエラーが発生した場合
     */
    public function createOne(array $params)
    {
        try {
            // パスワードをハッシュ化（casts設定がない場合）
            if (isset($params['password']) && !$this->getAttributeValue('password')) {
                $params['password'] = Hash::make($params['password']);
            }

            // DBに保存
            $user = new User();
            $user->fill($params);
            $user->save();

            return $user;
        } catch (Exception $e) {
            // エラーログを記録
            \Log::error('ユーザー作成エラー: ' . $e->getMessage());
            throw $e; // または適切なカスタム例外を投げる
        }
    }
}
