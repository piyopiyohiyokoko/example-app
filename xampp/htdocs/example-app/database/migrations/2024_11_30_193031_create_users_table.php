<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->string('user_name')->comment('ユーザー名');
            $table->string('email')->comment('Eメール');
            $table->string('password')->comment('パスワード');
            $table->timestamp('created_at')->comment('作成した日時')->nullable();
            $table->timestamp('updated_at')->comment('更新した日時')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
