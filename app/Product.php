<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table = 'products';
    /**
     * @var array
     */
    protected $fillable = ['description', 'category', 'price'];
}