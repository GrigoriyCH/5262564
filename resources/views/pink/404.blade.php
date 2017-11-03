@extends(config('settings.theme').'.layouts.site')

@section('navigation')
{!!$navigation!!}
@endsection

@section('content')
<div id="content-index" class="content group">
				            <img class="error-404-image group" src="{{asset(config('settings.theme'))}}/images/features/404.png" title="Error 404" alt="404" />
				            <div class="error-404-text group">
				                <p>Запрашиваемая страничка не существует.<br />Вы можете <a href="{{route('home')}}">перейти на главную страницу сайта</a> или перейти в раздел <a href="{{route('search')}}">"Поиск"</a>.</p>
				            </div>
				        </div>
@endsection

@section('footer')
@include((config('settings.theme').'.footer'))
@endsection