<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
  public $timestamps = false;

  protected $casts = [
    'playback_casts' => 'array',
  ];
}
