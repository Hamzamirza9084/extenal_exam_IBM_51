<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BmiRecord extends Model
{
    protected $fillable = ['age', 'gender', 'height', 'weight', 'bmi', 'classification'];
}
