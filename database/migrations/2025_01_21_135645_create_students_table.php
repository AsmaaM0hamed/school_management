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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
       
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female']);
            $table->string('national_id')->unique();
            $table->string('photo')->nullable();
            
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            $table->foreignId('classroom_id')->constrained('classrooms')->onDelete('cascade');
            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');
            $table->string('academic_year');
            
          
            $table->foreignId('parent_id')->constrained('parents')->onDelete('cascade');
            
          
            $table->enum('status', ['active', 'inactive', 'graduated'])->default('active');
            $table->text('notes')->nullable();
            
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
