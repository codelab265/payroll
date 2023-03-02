<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unsigned()->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('department_id')->unsigned()->references('id')->on('departments')->cascadeOnDelete();
            $table->foreignId('schedule_id')->unsigned()->references('id')->on('schedules')->cascadeOnDelete();
            $table->string('address');
            $table->string('dob')->nullable();
            $table->string('gender');
            $table->float('hour_rate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_details');
    }
};