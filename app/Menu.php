<?php

namespace Japblog;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
	protected $fillable = [
		'title', 'path', 'parent'
	];
	
	public function delete(array $options = []){
		$child = self::where('parent',$this->id);
		$child->delete();
		
		return parent::delete($options);
	}
}
