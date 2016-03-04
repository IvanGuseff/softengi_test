<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model {
    protected $fillable = array('pupil_id', 'types', 'correct', 'incorrect');
}