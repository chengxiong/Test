<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AestheticsImage extends Model {

  protected $table = "aesthetics_image";
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['id',
  ];

}
