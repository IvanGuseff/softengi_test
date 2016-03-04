<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mistake extends Model {

    public $timestamps = false;

    protected $fillable = array('test_id', 'sample', 'answer');
}