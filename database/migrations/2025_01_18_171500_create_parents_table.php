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
            
            // Father information
            $table->string('father_name');
            $table->string('father_national_id')->unique();
            $table->string('father_passport_id')->nullable();
            $table->string('father_phone');
            $table->string('father_job');
            $table->string('father_nationality');
            $table->string('father_blood_type');
            $table->string('father_religion');
            $table->string('father_address');

            // Mother information
            $table->string('mother_name');
            $table->string('mother_national_id')->unique();
            $table->string('mother_passport_id')->nullable();
            $table->string('mother_phone');
            $table->string('mother_job');
            $table->string('mother_nationality');
            $table->string('mother_blood_type');
            $table->string('mother_religion');
            $table->string('mother_address');

            // Status and timestamps
            $table->boolean('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parents');
    }
};
