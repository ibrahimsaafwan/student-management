<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //Run the migrations.

    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('username', 20)->unique();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('phone', 11)->unique();
            $table->string('email', 100)->unique();
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->enum('course', ['PHP', 'Laravel', 'React', 'Vue']);
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    //Reverse the migrations.

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
