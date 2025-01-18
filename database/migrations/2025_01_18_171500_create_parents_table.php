<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
          
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            
          
            $table->string('father_name');
            $table->string('father_national_id')->unique();
            $table->string('father_passport_id')->nullable();
            $table->string('father_phone');
            $table->string('father_job');
            $table->foreignId('father_nationality_id')->constrained('nationalities');
            $table->foreignId('father_blood_type_id')->constrained('blood_types');
            $table->foreignId('father_religion_id')->constrained('religions');
            $table->string('father_address');

        
            $table->string('mother_name');
            $table->string('mother_national_id')->unique();
            $table->string('mother_passport_id')->nullable();
            $table->string('mother_phone');
            $table->string('mother_job');
            $table->foreignId('mother_nationality_id')->constrained('nationalities');
            $table->foreignId('mother_blood_type_id')->constrained('blood_types');
            $table->foreignId('mother_religion_id')->constrained('religions');
            $table->string('mother_address');

            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parents');
    }
};
