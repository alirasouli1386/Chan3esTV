<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kids extends Model
{
  public $timestamps = false;

  protected $casts = [
    'playback_casts' => 'array',
  ];
}
