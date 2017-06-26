<div id="content-blog" class="content group">
	
		@if($user_post)
			<div class="short-table white">
			<table style="width: 100%" cellspacing="0" cellpadding="0">
			<caption>Все посты пользователя: {{$username}}</caption>
				<th>Заголовок</th>
				<th>Текст</th>
				<th>Дата</th>
				<th>Действие</th>
			@foreach($user_post as $post)
				<tr>
					<td class="align-left"><a href="{{ route('user.userpost.edit',['id'=>$post->id]) }}">{{ $post->title }}</a></td>
					<td class="align-left">{!!str_limit(strip_tags($post->text, '<a><p><br><strong><i>'),256)!!}</td>
					<td><p class="date">{{ $post->created_at->format('F d, Y') }}</p></td>
					<td>
					{!! Form::open(['url' => route('user.userpost.destroy',['post'=>$post->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
					{{ method_field('DELETE') }}
					{!! Form::button('Удалить', ['class' => 'btn btn-french-5','type'=>'submit']) !!}
					{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
			</table>
			</div>
		@else
		<h3> У вас еще нет постов...<h3>
		@endif
				            
</div>