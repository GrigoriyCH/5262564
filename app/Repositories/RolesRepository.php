<?php 

namespace Japblog\Repositories;
use Japblog\Role;

class RolesRepository extends Repository{
	
	public function __construct(Role $roles){
		$this->model = $roles;
	}
	
}

?>