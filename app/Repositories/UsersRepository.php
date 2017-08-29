<?php

namespace Japblog\Repositories;

use Japblog\User;

use Gate;
use Auth;

class UsersRepository extends Repository
{
	protected $iam;
	public function __construct(User $user) {
		$this->model  = $user;
		$this->iam = Auth::user();
	}
	
	public function addUser($request) {
		
		
		if (\Gate::denies('create',$this->model)) {
            abort(403);
        }
		
		$data = $request->all();
		
		if(trim($data['avatar'])==''){$data['avatar']=config('settings.default_avatar');}
		
		$user = $this->model->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
			'avatar' => $data['avatar']
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
		
		if(trim($data['avatar'])==''){$data['avatar']=config('settings.default_avatar');}
		
		if(isset($data['password'])) {
			$data['password'] = bcrypt($data['password']);
		}
		
		$user->fill($data)->update();
		$user->roles()->sync([$data['role_id']]);
		
		return ['status' => 'Пользователь изменен'];
		
	}
	
	public function updateSelf($request, $useredit){
		
		if(Gate::denies('editSelf',$useredit)){
			abort(403);
		}
		
		if ($this->iam->id == $useredit->user_id) {
            abort(403);
        }
		
		$data = $request->except('_token','_method');
		
		if(empty($data)){
			return array('error' => 'Нет данных!');
		}
		
		if(trim($data['avatar'])==''){$data['avatar']=config('settings.default_avatar');}
		
		if(($this->iam->name == $data['name'])&&(($this->iam->avatar == $data['avatar']))){return ['status' => 'Вы не ввели новой информации!'];}
		
		$useredit->fill($data);
		
		if($useredit->update()){
			return ['status' => 'Пользователь обновлен!'];
		}
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