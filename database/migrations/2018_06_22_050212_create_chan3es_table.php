<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChan3esTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chan3es', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name_exclusive')->unique();
          $table->date('publish_date');
          $table->string('title_au');
          $table->string('title_fa')->charset('utf8');
          $table->string('subtitle_au');
          $table->string('subtitle_fa')->charset('utf8');
          $table->text('content_au');
          $table->text('content_fa')->charset('utf8');
          $table->string('href');
          $table->string('thumbnail_image_route')->default('');
          $table->string('cover_image_route')->default('');
          $table->string('background_image_route')->default('');
          $table->string('trailer_route')->default('');
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
        Schema::dropIfExists('chan3es');
    }
}
