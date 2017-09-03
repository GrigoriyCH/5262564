<div id="content-page" class="content group">
	<div class="hentry group">
		@if($user_post)
			<div class="short-table white">
			<table style="width: 100%" cellspacing="0" cellpadding="0">
			<caption>Все посты пользователя: {{$username}}</caption>
				<th>Заголовок</th>
				<th>Текст</th>
				<th>Картинка</th>
				<th>Дата</th>
				<th>Действие</th>
				
			<tbody>
			@foreach($user_post as $post)
				<tr>
					<td class="align-left"><a href="{{ route('user.userpost.edit',['id'=>$post->id]) }}">{{ $post->title }}</a></td>
					<td class="align-left">{!!str_limit(strip_tags($post->text, '<a><p><br><strong><i>'),256)!!}</td>
					<td>
						<center style="	overflow:hidden;width:82px;height:28px">
							<div style="width:100%;">
								@if(isset($post->img))
									{!! Html::image($post->img) !!}
								@endif
							</div>
						</center>
					</td>
					<td><p class="date">{{ $post->created_at->format('F d, Y') }}</p></td>
					<td>
					{!! Form::open(['url' => route('user.userpost.destroy',['post'=>$post->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
					{{ method_field('DELETE') }}
					{!! Form::button('Удалить', ['class' => 'btn btn-french-5','type'=>'submit']) !!}
					{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
			</tbody>
			</table>
			</div>
		@else
		<h3> У вас еще нет постов...<h3>
		@endif
	</div>			            
</div>