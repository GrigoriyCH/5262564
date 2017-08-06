				            <div class="widget-first widget contact-info">
				                <h3 style="color: #656262;">{{ $user->name }}</h3>
				                <div class="sidebar-nav">
									<center>
										<img alt="" src="{{$user->avatar}}" class="useravatar"/>
									</center>
				                </div>
				            </div>
				            <div class="widget-last widget text-image">
								{!! Form::open(['url' => (isset($user->id)) ? route('user.name.update',['name'=>$user->id]) : route('home'),'method'=>'POST','enctype'=>'multipart/form-data']) !!}
									<div>
										<label for="email">Ваше имя</label>
										<div class="divforinput">
											<input class="INPUT_1" id="name" type="text" name="name" value="{{$user->name}}" style="width:100%;">
										</div>
									</div>
									<div>
										<label for="email">Ссылка на аватарку</label>
										<div class="divforinput">
											<input class="INPUT_1" id="avatar" type="text" name="avatar" value="{{$user->avatar}}" style="width:100%;">
										</div>
									</div>
									<br>
									
									@if(isset($user->id))
										<input type="hidden" name="_method" value="PUT">		
									@endif		
		
									<div class="submit-button"> 
										{!! Form::button('Обновить', ['class' => 'btn btn-honey-pot-4','type'=>'submit']) !!}			
									</div>
								{!! Form::close() !!}
								
								<div style="margin-top:1em;">
									{!! Html::link(route('user.post.create'),'Добавить новый пост',['class' => 'btn btn-the-salmon-dance-3']) !!}
								</div>
								
				            </div>