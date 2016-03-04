<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pupil extends Model {

    public $timestamps = false;

    protected $fillable = array('name');
}