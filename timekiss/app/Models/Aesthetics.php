<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aesthetics extends Model {

  protected $table = "aesthetics";
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['id',
  ];

}
