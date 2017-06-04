<div id="content-page" class="content group">
				            <div class="hentry group">

{!! Form::open(['url' => (isset($menu->id)) ? route('admin.menus.update',['menus'=>$menu->id]) : route('admin.menus.store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}
    
	<ul>
		
		<li class="text-field">
			<label for="name-contact-us">
				<span class="label">Заголовок:</span>
				<br />
				<span class="sublabel">Заголовок пункта</span><br />
			</label>
			<div class="input-prepend"><span class="add-on"><i class="icon-pencil"></i></span>
			{!! Form::text('title',isset($menu->title) ? $menu->title  : old('title'), ['placeholder'=>'Введите название страницы']) !!}
			 </div>
		 </li>
		
		
		<li class="text-field">
			<label for="name-contact-us">
				<span class="label">Родительский пункт меню:</span>
				<br />
				<span class="sublabel">Родитель:</span><br />
			</label>
			<div class="input-prepend">
				{!! Form::select('parent', $menus, isset($menu->parent) ? $menu->parent : null) !!}
			 </div>
			 
		</li>
	</ul>	
		
			
			<ul>
			
				<li class="text-field">
					<label for="name-contact-us">
						<span class="label">Путь для ссылки:</span>
						<br />
						<span class="sublabel">Путь для ссылки</span><br />
					</label>
					<div class="input-prepend"><span class="add-on"><i class="icon-pencil"></i></span>
					{!! Form::text('custom_link',(isset($menu->path)) ? $menu->path  : old('custom_link'), ['placeholder'=>'Введите название страницы']) !!}
					 </div>
				</li>
			<div style="clear: both;"></div>
			</ul>
			
		<br />
		
		@if(isset($menu->id))
			<input type="hidden" name="_method" value="PUT">		
		
		@endif
		<ul>
			<li class="submit-button"> 
						{!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}			
			</li>	
		</ul>
		 
	
	
    
    
    
    
{!! Form::close() !!}


</div>
</div>