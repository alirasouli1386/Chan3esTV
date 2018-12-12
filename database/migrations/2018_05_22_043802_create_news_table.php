<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('news', function (Blueprint $table) {
      $table->increments('id');
      $table->date('publish_date');
      $table->string('title_au');
      $table->string('subtitle_au');
      $table->longtext('content_au');
      $table->string('title_fa')->charset('utf8');
      $table->string('subtitle_fa')->charset('utf8');
      $table->longtext('content_fa')->charset('utf8');
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
    Schema::dropIfExists('news');
  }
}
