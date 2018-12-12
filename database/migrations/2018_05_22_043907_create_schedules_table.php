<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('schedules', function (Blueprint $table) {
      $table->increments('id');
      $table->unsignedTinyInteger('order')->default(1);
      $table->string('title_au');
      $table->string('title_fa');
      $table->time('schedule_time');
      $table->date('schedule_date');
      $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('schedules');
  }
}
