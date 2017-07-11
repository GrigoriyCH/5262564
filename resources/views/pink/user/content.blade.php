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
												<a href="{{ route('user.userpost.edit',['id'=>$post->id]) }}">{{ $post->title }}</a>
											
												@if($post->created_at)
												<p class="post-date">{{ $post->created_at->format('F d, Y') }}</p>
												@endif
											</div>
											
											<br>
											
				                            <p>{!!str_limit(strip_tags($post->text, '<a><p><br><strong><i>'),256)!!}<p>
											
											<div style="float:right;">
												{!! Form::open(['url' => route('user.userpost.destroy',['post'=>$post->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
												{{ method_field('DELETE') }}
												{!! Form::button('Удалить', ['class' => 'btn btn-french-5','type'=>'submit']) !!}
												{!! Form::close() !!}
											</div>
											
				                        </div>
				    </div>
					</div>
					</td>
				</tr>
			@endforeach
			</table>
			</div>
		@else
		<h3> У вас еще нет постов...<h3>
		@endif
		
		{!! HTML::link(route('user.userpost.create'),'Добавить новый пост',['class' => 'btn btn-the-salmon-dance-3']) !!}
		
	</div>			            
</div>