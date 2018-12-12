<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSportsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('sports', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name_exclusive')->unique();
      $table->string('groupname_au')->default('');
      $table->string('groupname_fa')->charset('utf8')->default('');
      $table->string('name_au');
      $table->string('name_fa')->charset('utf8');
      $table->string('cue_au')->default('');
      $table->string('cue_fa')->charset('utf8')->default('');
      $table->date('match_date');
      $table->string('match_place_au')->default('');
      $table->string('match_place_fa')->charset('utf8')->default('');
      $table->string('field_au')->default('');
      $table->string('field_fa')->charset('utf8')->default('');
      $table->string('genre_au')->default('');
      $table->string('genre_fa')->charset('utf8')->default('');
      $table->string('language_au')->default('');
      $table->string('language_fa')->charset('utf8')->default('');
      $table->string('thumbnail_image_route')->default('');
      $table->string('cover_image_route')->default('');
      $table->string('background_image_route')->default('');
      $table->string('trailer_route')->default('');
      $table->json('playback_casts');
      $table->json('external_resources'); //imdb
      $table->text('description_au');
      $table->text('description_fa')->charset('utf8');
      $table->enum('comment_status', ['hide','freeze','active']);
      $table->boolean('is_archived')->default(false);
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
    Schema::dropIfExists('sports');
  }
}
