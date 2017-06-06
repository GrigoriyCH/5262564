<?php

namespace Japblog\Repositories;

use Japblog\User;
use Config;

use Gate;


class UsersRepository extends Repository
{
	
    
	public function __construct(User $user) {
		$this->model  = $user;
		
	}
	
	public function addUser($request) {
		
		
		if (\Gate::denies('create',$this->model)) {
            abort(403);
        }
		
		$data = $request->all();
		
		$user = $this->model->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
		
		if($user) {
			$user->roles()->attach($data['role_id']);
		}
		
		return ['status' => 'Пользователь добавлен'];
		
	}
	
	
	public function updateUser($request, $user) {
		
		
		if (\Gate::denies('edit',$this->model)) {
            abort(403);
        }
		
		$data = $request->all();
		
		if(isset($data['password'])) {
			$data['password'] = bcrypt($data['password']);
		}
		
		$user->fill($data)->update();
		$user->roles()->sync([$data['role_id']]);
		
		return ['status' => 'Пользователь изменен'];
		
	}
	
	public function deleteUser($user) {
		
		if (Gate::denies('edit',$this->model)) {
            abort(403);
        }
		
		
		$user->roles()->detach();
		
		if($user->delete()) {
			return ['status' => 'Пользователь удален'];	
		}
	}
	
	

	
}