<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('lesson_datetime');
            $table->text('body')->nullable();
            $table->text('evaluation')->nullable();
            $table->integer('total_participant')->nullable();
            $table->integer('total_revenue')->nullable();
            $table->integer('total_expenses')->nullable();
            $table->integer('total_budget')->nullable();
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
        Schema::dropIfExists('lessons');
    }
}
