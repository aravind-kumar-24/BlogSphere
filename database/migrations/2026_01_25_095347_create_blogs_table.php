<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blogger_id')->constrained('bloggers')->restrictOnDelete();
            $table->string('user_id');
            $table->string('email_id');
            $table->string('blog_id')->unique();
            $table->foreignId('blog_category_id')->constrained('blog_category')->restrictOnDelete();
            $table->string('blog_name', 25);
            $table->string('blog_description', 255);
            $table->string('blog_image');
            $table->enum('status', ['active', 'inactive', 'deleted'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
