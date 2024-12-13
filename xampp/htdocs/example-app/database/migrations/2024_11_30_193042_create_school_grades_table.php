<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolGradesTable extends Migration
{
    public function up()
    {
        Schema::create('school_grades', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->unsignedBigInteger('student_id')->comment('生徒ID');
            $table->integer('grade')->default(1)->comment('学年');
            $table->integer('term')->default(1)->comment('学期');
            $table->integer('japanese')->nullable()->comment('国語');
            $table->integer('math')->nullable()->comment('数学');
            $table->integer('science')->nullable()->comment('理科');
            $table->integer('social_studies')->nullable()->comment('社会');
            $table->integer('music')->nullable()->comment('音楽');
            $table->integer('home_economics')->nullable()->comment('家庭科');
            $table->integer('english')->nullable()->comment('英語');
            $table->integer('art')->nullable()->comment('美術');
            $table->integer('health_and_physical_education')->nullable()->comment('保健体育');
            $table->timestamp('created_at')->comment('作成した日時')->nullable();
            $table->timestamp('updated_at')->comment('更新した日時')->nullable();

            // 外部キー制約
            $table->foreign('student_id')->references('id')->on('students');
        });
    }

    public function down()
    {
        Schema::dropIfExists('school_grades');
    }
}
