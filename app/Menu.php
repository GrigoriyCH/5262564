<?php

namespace Japblog;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
	protected $fillable = [
		'title', 'path', 'parent'
	];
}
