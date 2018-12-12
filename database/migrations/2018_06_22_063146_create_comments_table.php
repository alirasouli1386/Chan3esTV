<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('comments', function (Blueprint $table) {
      $table->increments('id');
      $table->enum('content_type', ['chan3es','tvshow','documentary','kids','movie','music','series','sport','news','contact']);
      $table->integer('reference_id');
      $table->datetime('comment_date');
      $table->enum('input_language', ['au','fa']);
      $table->string('name')->charset('utf8');
      $table->string('email');
      $table->string('subject')->charset('utf8');
      $table->string('content')->charset('utf8');
      $table->json('reply');
      $table->json('extra_information');
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
    Schema::dropIfExists('comments');
  }
}
