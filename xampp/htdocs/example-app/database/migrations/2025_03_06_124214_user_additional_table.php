<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // email_verified_atカラムを追加
            $table->timestamp('email_verified_at')->nullable()->after('email');
            // remember_tokenカラムを追加
            $table->string('remember_token')->nullable()->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email_verified_at');
            if (Schema::hasColumn('users', 'remember_token')) {
                $table->dropColumn('remember_token');
            }
        });
    }
};
