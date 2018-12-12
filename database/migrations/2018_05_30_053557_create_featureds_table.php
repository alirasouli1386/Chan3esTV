<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturedsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('featureds', function (Blueprint $table) {
      $table->increments('id');
      $table->unsignedTinyInteger('order')->default(1);
      $table->enum('content_type', ['tvshow','movie','series','documentary','music','sport','kids']);
      $table->integer('reference_id');
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
    Schema::dropIfExists('featureds');
  }
}
