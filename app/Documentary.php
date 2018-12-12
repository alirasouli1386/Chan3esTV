<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentary extends Model
{
  public $timestamps = false;

  protected $casts = [
    'playback_casts' => 'array',
    'external_resources' => 'array',
  ];
}
