<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AestheticsContent extends Model {

  protected $table = "aesthetics_content";
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['id',
  ];

}
