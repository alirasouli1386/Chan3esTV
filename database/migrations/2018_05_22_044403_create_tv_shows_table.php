<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTvShowsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('tv_shows', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name_exclusive')->unique();
      $table->string('groupname_au');
      $table->string('groupname_fa');
      $table->string('name_au');
      $table->string('name_fa')->charset('utf8');
      $table->string('cue_au')->default('');
      $table->string('cue_fa')->charset('utf8')->default('');
      $table->date('production_date');
      $table->string('subject_au')->default('');
      $table->string('subject_fa')->charset('utf8')->default('');
      $table->string('language_au')->default('');
      $table->string('language_fa')->charset('utf8')->default('');
      $table->string('producers_au')->default('');
      $table->string('producers_fa')->charset('utf8')->default('');
      $table->string('executive_au')->default('');
      $table->string('executive_fa')->charset('utf8')->default('');
      $table->string('guests_au')->default('');
      $table->string('guests_fa')->charset('utf8')->default('');
      $table->string('thumbnail_image_route')->default('');
      $table->string('cover_image_route')->default('');
      $table->string('background_image_route')->default('');
      $table->string('trailer_route')->default('');
      $table->json('playback_casts');
      $table->text('description_au');
      $table->text('description_fa')->charset('utf8');
      $table->enum('comment_status', ['hide','freeze','active'])->default('active');
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
    Schema::dropIfExists('tv_shows');
  }
}
