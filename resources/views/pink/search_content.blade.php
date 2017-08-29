<div id="content-blog" class="content group">
<div class="hentry group">

	@if($result)
		@if($articles)
			
			{!! Form::open(['url' => route('search'),'method'=>'GET','enctype'=>'multipart/form-data']) !!}
									<div>
										<label for="result">Введите слово или текст для поиска поста</label>
										<div class="divforinput">
											<input class="INPUT_1" id="result" type="text" name="result" value="" style="width:100%;">
										</div>
									</div>
		
									<div class="submit-button"> 
										{!! Form::button('Поиск', ['class' => 'btn btn-honey-pot-4','type'=>'submit']) !!}			
									</div>
			{!! Form::close() !!}
			<!-- table start -->
			<div class="JapTable"><!-- div for table css -->
			<table style="width: 100%" cellspacing="0" cellpadding="0">
			<tr>
				<th>Результат поиска: {{$keysearch}}</th>
			</tr>
			
			@foreach($articles as $post)
				<tr>
					<td class="align-left">
					<div class="recent-post group" style="margin-top:1em;margin-bottom:1em;">
					<div class="hentry-post group">
				                        <div class="thumb-img">
										@if(isset($post->img))
											<div style="overflow:hidden;width:82px;height:28px;">
												<div style="width:100%;">
												{!! Html::image($post->img) !!}
												</div>
											</div>
										@endif
										</div>
										
				                        <div class="text" style="margin-left:0px;">
											<div style="margin-left:100px;">
												<a href="{{ route('posts.show',['id'=>$post->id]) }}">{{ $post->title }}</a>
												
													@if($post->created_at)
														<p class="post-date">{{ LocalizedCarbon::instance($post->created_at)->diffForHumans() }}</p>
													@endif
												
											</div>
											
				                            <p style="margin-top:0.5em;">{!!str_limit(strip_tags($post->text, '<a><p><br><strong><i>'),256)!!}</p>
											
											<div style="float:right;margin-right:1em;padding-top:0.5em;">										
												<p class="post-date">{{$post->category->title}}</p>
											</div>
											
											<div style="float:right;margin-right:1em;padding-top:0.5em;">
												<p>
													<span title="{{Lang::choice('ru.views',$post->view)}}"><i class="icon-eye-open" style="margin-right:0.1em;"></i>{{($post->view)}}</span>
												</p>
											</div>
											
											<div style="float:right;margin-right:1em;padding-top:0.5em;">
												<p>
													<span title="{{Lang::choice('ru.comments',count($post->comments))}}"><i class="icon-comment" style="margin-right:0.1em;"></i>{{count($post->comments)}}</span>
												</p>
											</div>
											
				                        </div>
				    </div>
					</div>
					</td>
				</tr>
			@endforeach	
			</table>
			</div>			
			<!-- table end -->	        
				        @if($articles->lastPage() > 1)     
				            <div class="general-pagination group">
				            		
				            		@if($articles->currentPage() !== 1)
				            			<a href="{{ $articles->url(($articles->currentPage() - 1)) }}&result={{$keysearch}}">{{ Lang::get('pagination.previous') }}</a>
				            		@endif
				            		
				            		@for($i = 1; $i <= $articles->lastPage(); $i++)
				            			@if($articles->currentPage() == $i)
				            				<a class="selected disabled">{{ $i }}</a>
				            			@else
				            				<a href="{{ $articles->url($i) }}&result={{$keysearch}}">{{ $i }}</a>
				            			@endif		
				            		@endfor
				            		
				            		@if($articles->currentPage() !== $articles->lastPage())
				            			<a href="{{ $articles->url(($articles->currentPage() + 1)) }}&result={{$keysearch}}">{{ Lang::get('pagination.next') }}</a>
				            		@endif
				            		
				            </div>	
				        @endif   
				            
		@else
			
			<h3>{!! Lang::get('ru.articles_not_find') !!}</h3>
		
				{!! Form::open(['url' => route('search'),'method'=>'GET','enctype'=>'multipart/form-data']) !!}
									<div>
										<label for="result">Введите слово или текст для поиска поста</label>
										<div class="divforinput">
											<input class="INPUT_1" id="result" type="text" name="result" value="" style="width:100%;">
										</div>
									</div>
		
									<div class="submit-button"> 
										{!! Form::button('Поиск', ['class' => 'btn btn-honey-pot-4','type'=>'submit']) !!}			
									</div>
				{!! Form::close() !!}
			
		@endif
	@else
			{!! Form::open(['url' => route('search'),'method'=>'GET','enctype'=>'multipart/form-data']) !!}
									<div>
										<label for="result">Введите слово или текст для поиска поста</label>
										<div class="divforinput">
											<input class="INPUT_1" id="result" type="text" name="result" value="" style="width:100%;">
										</div>
									</div>
		
									<div class="submit-button"> 
										{!! Form::button('Поиск', ['class' => 'btn btn-honey-pot-4','type'=>'submit']) !!}			
									</div>
			{!! Form::close() !!}	
	@endif            
</div>
</div>