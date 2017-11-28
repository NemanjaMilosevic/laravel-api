<?php

namespace App;

use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
		use Rateable;
        protected $fillable = ['text', 'type'];
}
