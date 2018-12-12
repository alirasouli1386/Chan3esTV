<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TvShow extends Model
{
  public $timestamps = false;

  protected $casts = [
    'playback_casts' => 'array',
  ];
}
