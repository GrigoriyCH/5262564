<div id="content-page" class="content group">
<div class="hentry group">

{!! Form::open(['url' => (isset($article->id)) ? route('user.post.update',['articles'=>$article->id]) : route('user.post.store'),'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    
		<div class="text-field">
			<label for="name-contact-us">
				<span class="label">Большая картинка:</span>
				<br />
				<span class="mysublabel">Будет использоваться в качестве шапки вашего поста</span><br />
			</label>
			<div class = "divforinput">
				<input class="INPUT_1" type="text" name="img" placeholder="Укажите/Вставте ссылку на изображение" value="{{ isset($article->img) ? $article->img  : old('img') }}">
			</div>
		</div>
		
		<div class="text-field">
			<label for="name-contact-us">
				<span class="label">Название:</span>
				<br />
				<span class="mysublabel">Заголовок поста</span><br />
			</label>
			<div class = "divforinput">
				<input class="INPUT_1" type="text" name="title" placeholder="Введите название вашего поста" value="{{ isset($article->title) ? $article->title  : old('title') }}">
			</div>
		</div>
		
		<div class="textarea-field">
			<label for="message-contact-us">
				 <span class="label">Введите текст поста:</span>
			</label>
			<br/>
			<span class="mysublabel">
				Воспользуйтесть редактором для ввода/редактирования поста
			</span>
			<div class="input-prepend"><span class="add-on"><i class="icon-pencil"></i></span>
			{!! Form::textarea('text', isset($article->text) ? $article->text  : old('text'), ['id'=>'editor2','class' => 'form-control','placeholder'=>'Введите текст вашей записи']) !!}
			</div>
			<div class="msg-error"></div>
		</div>
		
		<div class="text-field">
			<label for="name-contact-us">
				<span class="label">Ключевые слова:</span>
				<br />
				<span class="mysublabel">Теги поста (Не стоит указывать в теге больше 7 слов или словосочетаний. Не стоит использовать союзы, предлоги, междометия и частицы в этом теге.)</span><br />
			</label>
			<div class = "divforinput">
				<input class="INPUT_1" type="text" name="keywords" placeholder="Оставьте это поле пустое или введите через запятую ключевые слова/словосочетания." value="{{ isset($article->keywords) ? $article->keywords  : old('keywords') }}">
			</div>
		</div>
		
		<div class="text-field">
			<label for="name-contact-us">
				<span class="label">Категория:</span>
				<br />
				<span class="mysublabel">Кликните для выбора категории поста</span><br />
			</label>
			<div class="divforinput">
				{!! Form::select('category_id', $categories,isset($article->category_id) ? $article->category_id  : '', ['class' => 'INPUT_1']) !!}
			</div> 
		</div>
		
		@if(isset($article->id))
			<input type="hidden" name="_method" value="PUT">		
		@endif

		<div class="submit-button"> 
			{!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}			
		</div>
		 
	</div>
	
    
    
    
    
{!! Form::close() !!}

 <script>
	CKEDITOR.replace( 'editor2' );
</script>
</div>
</div>