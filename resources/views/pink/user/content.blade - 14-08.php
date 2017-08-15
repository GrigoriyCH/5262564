
<div id="content-page" class="content group">
	<div class="hentry group">
	
		
	
		@if($user_post)
			<div class="short-table white">
			<table style="width: 100%" cellspacing="0" cellpadding="0">
			<tr>
				<th>Все посты пользователя: {{$username}}</th>
			</tr>
			@foreach($user_post as $post)
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
												<a href="{{ route('user.post.edit',['id'=>$post->id]) }}">{{ $post->title }} | Редатировать</a>
												
													@if($post->created_at)
														<p class="post-date">{{ $post->created_at->format('F d, Y') }}</p>
													@endif
												
											</div>
											
				                            <p style="margin-top:0.5em;">{!!str_limit(strip_tags($post->text, '<a><p><br><strong><i>'),256)!!}</p>
											
											<div style="float:right;">
												{!! Form::open(['url' => route('user.post.destroy',['post'=>$post->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
												{{ method_field('DELETE') }}
												{!! Form::button('Удалить', ['class' => 'btn btn-french-5','type'=>'submit']) !!}
												{!! Form::close() !!}
											</div>
											
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
											
											<div style="float:right;margin-right:1em;padding-top:0.5em;">
												<p>
													<a href="{{ route('posts.show',['id'=>$post->id])}}">Перейти к посту</a>
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
					@if($user_post->lastPage() > 1) 
						<div class="general-pagination group">
				            		
				            		@if($user_post->currentPage() !== 1)
				            			<a href="{{ $user_post->url(($user_post->currentPage() - 1)) }}">{{ Lang::get('pagination.previous') }}</a>
				            		@endif
				            		
				            		@for($i = 1; $i <= $user_post->lastPage(); $i++)
				            			@if($user_post->currentPage() == $i)
				            				<a class="selected disabled">{{ $i }}</a>
				            			@else
				            				<a href="{{ $user_post->url($i) }}">{{ $i }}</a>
				            			@endif		
				            		@endfor
				            		
				            		@if($user_post->currentPage() !== $user_post->lastPage())
				            			<a href="{{ $user_post->url(($user_post->currentPage() + 1)) }}">{{ Lang::get('pagination.next') }}</a>
				            		@endif
				            	
				        </div>
					@endif
		@else
		<h3> У вас еще нет постов...<h3>
		@endif
		
		
		
	</div>			            
</div>
