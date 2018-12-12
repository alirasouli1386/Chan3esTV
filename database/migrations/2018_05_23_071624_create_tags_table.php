<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('tags', function (Blueprint $table) {
      $table->increments('id');
      $table->unsignedTinyInteger('order')->default(1);
      $table->enum('content_type', ['tvshow','movie','series','documentary','music','sport','kids','news','chan3es']);
      $table->integer('reference_id');
      $table->string('tag_au');
      $table->string('tag_fa')->charset('utf8');
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
    Schema::dropIfExists('tags');
  }
}
