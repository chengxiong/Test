<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AestheticsSimilar extends Model {

  protected $table = "aesthetics_similar";
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['id',
  ];

}
