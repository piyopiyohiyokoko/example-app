<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->integer('grade')->default(1)->comment('学年');
            $table->string('name')->comment('名前');
            $table->string('address')->comment('住所');
            $table->string('img_path')->comment('写真のパス');
            $table->string('comment')->nullable()->comment('コメント');
            $table->timestamp('created_at')->comment('作成した日時')->nullable();
            $table->timestamp('updated_at')->comment('更新した日時')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
