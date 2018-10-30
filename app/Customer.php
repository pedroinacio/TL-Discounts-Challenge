<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $table = 'customers';
    /**
     * @var array
     */
    protected $fillable = ['name', 'since', 'revenue'];
}