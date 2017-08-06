<div id="content-page" class="content group">
<div class="hentry group">

{!! Form::open(['url' => (isset($article->id)) ? route('admin.posts.update',['articles'=>$article->id]) : route('admin.posts.store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}
    
	<ul>
		<li class="text-field" style="width:50%;">
			<label for="name-contact-us">
				<span class="label">Большая картинка:</span>
				<br />
				<span class="sublabel">Будет использоваться в качестве шапки вашего поста</span><br />
			</label>
			<div class="input-prepend">
			{!! Form::text('img', isset($article->img) ? $article->img  : old('img'), ['placeholder'=>' Укажите ссылку на изображение']) !!}
			 </div>
		 </li>
		
		<li class="text-field" style="width:50%;">
			<label for="name-contact-us">
				<span class="label">Название:</span>
				<br />
				<span class="sublabel">Заголовок поста</span><br />
			</label>
			<div class="input-prepend">
			{!! Form::text('title',isset($article->title) ? $article->title  : old('title'), ['placeholder'=>' Введите название вашего поста']) !!}
			 </div>
		 </li>
		
		<li class="textarea-field">
			<label for="message-contact-us">
				 <span class="label">Введите текст поста:</span>
			</label>
			<div class="input-prepend"><span class="add-on"><i class="icon-pencil"></i></span>
			{!! Form::textarea('text', isset($article->text) ? $article->text  : old('text'), ['id'=>'editor2','class' => 'form-control','placeholder'=>'Введите текст вашей записи']) !!}
			</div>
			<div class="msg-error"></div>
		</li>
		
		 <li class="text-field" style="width:50%;">
			<label for="name-contact-us">
				<span class="label">Ключевые слова:</span>
				<br />
				<span class="sublabel">Теги поста (Не стоит указывать в теге больше 7 слов или словосочетаний. Не стоит использовать союзы, предлоги, междометия и частицы в этом теге.)</span><br />
			</label>
			<div class="input-prepend">
			{!! Form::text('keywords', isset($article->keywords) ? $article->keywords  : old('keywords'), ['placeholder'=>' Введите через запятую ключевые слова или словосочетания']) !!}
			 </div>
		 </li>
		
		<li class="text-field" style="width:25%;">
			<label for="name-contact-us">
				<span class="label">Категория:</span>
				<br />
				<span class="sublabel">Выберите категорию поста</span><br />
			</label>
			<div class="input-prepend">
				{!! Form::select('category_id', $categories,isset($article->category_id) ? $article->category_id  : '') !!}
			 </div>
			 
		</li>	 
		
		@if(isset($article->id))
			<input type="hidden" name="_method" value="PUT">		
		
		@endif

		<li class="submit-button"> 
			{!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}			
		</li>
		 
	</ul>
	
    
    
    
    
{!! Form::close() !!}

 <script>
	CKEDITOR.replace( 'editor2' );
</script>
</div>
</div>