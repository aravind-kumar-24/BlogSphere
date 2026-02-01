<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bloggers', function (Blueprint $table) {
            $table->enum('user_type', ['1','2'])->default('2')->after('profession');
        });
    }

    public function down(): void
    {
        Schema::table('bloggers', function (Blueprint $table) {
            $table->dropColumn('user_type');
        });
    }
};
