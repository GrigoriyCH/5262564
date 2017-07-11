@extends(env('THEME').'.layouts.user')

@section('navigation')
	{!! $navigation !!}
@endsection

@section('content')
	{!! $content !!}
@endsection

@section('footer')
	{!! $footer !!}
@endsection 