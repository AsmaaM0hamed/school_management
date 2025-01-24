<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('from_class_id')->constrained('classrooms');
            $table->foreignId('to_class_id')->constrained('classrooms');
            $table->foreignId('from_section_id')->constrained('sections');
            $table->foreignId('to_section_id')->constrained('sections');
            $table->foreignId('from_grade_id')->constrained('grades');
            $table->foreignId('to_grade_id')->constrained('grades');
            $table->date('promotion_date');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
