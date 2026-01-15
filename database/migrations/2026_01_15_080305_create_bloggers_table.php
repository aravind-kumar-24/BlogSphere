<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('bloggers', function(Blueprint $table){
            $table->id();
            $table->string('user_id')->unique();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('user_name', 50)->unique();
            $table->string('profession', 50);
            $table->string('email_id', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('contact_number',10)->unique();
            $table->timestamp('contact_verified_at')->nullable();
            $table->foreignId('state_id')->constrained('states')->restrictOnDelete();
            $table->foreignId('city_id')->constrained('cities')->restrictOnDelete();
            $table->enum('gender', ['Male', 'Female', 'Others']);
            $table->date('date_of_birth');
            $table->longText('address');
            $table->enum('status', ['active', 'inactive', 'rejected'])->default('inactive');
            $table->string('password');
            $table->string('profile_pic');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('bloggers');
    }
};
