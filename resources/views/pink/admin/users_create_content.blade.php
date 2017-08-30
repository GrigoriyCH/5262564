<div id="content-page" class="content group">
				            <div class="hentry group">

{!! Form::open(['url' => (isset($user->id)) ? route('admin.users.update',['users'=>$user->id]) :route('admin.users.store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}
    
	<ul>
		<li class="text-field">
			<label for="name-contact-us">
				<span class="label">Имя:</span>
				<br />
				<span class="sublabel">Имя пользователя, отображается на сайте</span><br />
			</label>
			<div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
			{!! Form::text('name',isset($user->name) ? $user->name  : old('name'), ['placeholder'=>'Введите имя пользователя']) !!}
			 </div>
		 </li>
		 
		 
		  <li class="text-field">
			<label for="name-contact-us">
				<span class="label">Email:</span>
				<br />
				<span class="sublabel">Email пользователя, не отображается на сайте</span><br />
			</label>
			<div class="input-prepend"><span class="add-on"><i class="icon-envelope"></i></span>
			{!! Form::text('email',isset($user->email) ? $user->email  : old('email'), ['placeholder'=>'Введите email пользователя']) !!}
			 </div>
		 </li>
		 
		 <li class="text-field">
			<label for="name-contact-us">
				<span class="label">Пароль:</span>
				<br />
				<span class="sublabel">Минимум 6 символов</span><br />
			</label>
			<div class="input-prepend"><span class="add-on"><i class="icon-key"></i></span>
			{!! Form::text('password',isset($user->password) ? $user->password  : old('password')) !!}
			 </div>
		 </li>
		 
		 <li class="text-field">
			<label for="name-contact-us">
				<span class="label">Повтор пароля:</span>
				<br />
				<span class="sublabel">Повторный ввод пароля</span><br />
			</label>
			<div class="input-prepend"><span class="add-on"><i class="icon-key"></i></span>
			{!! Form::text('password_confirmation',isset($user->password) ? $user->password  : old('password')) !!}
			 </div>
		 </li>
		 
		 <li class="text-field">
			<label for="name-contact-us">
				<span class="label">Аватар:</span>
				<br />
				<span class="sublabel">Аватар</span><br />
			</label>
			<div class="input-prepend"><span class="add-on"><i class="icon-picture"></i></span>
			{!! Form::text('avatar',isset($user->avatar) ? $user->avatar  : old('avatar'), ['placeholder'=>'Введите название страницы']) !!}
			 </div>
		 </li>
		 
		 <li class="text-field">
			<label for="name-contact-us">
				<span class="label">Роль:</span>
				<br />
				<span class="sublabel">Роль</span><br />
			</label>
			<div class="input-prepend">
			
				{!! Form::select('role_id', $roles, (isset($user)) ? $user->roles()->first()->id : null) !!}
			 </div>
			 
		</li>	
		 
		 
		 
		 	 
		
		@if(isset($user->id))
			<input type="hidden" name="_method" value="PUT">		
		
		@endif

		<li class="submit-button"> 
			{!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}			
		</li>
		 
	</ul>
	
    
    
    
    
{!! Form::close() !!}

</div>
</div>