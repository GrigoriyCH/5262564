@extends(config('settings.theme').'.layouts.user')

@section('navigation')
{!!$navigation!!}
@endsection

@section('content')
{!!$content!!}
@endsection

@section('bar')
{!!$leftBar!!}
@endsection

@section('footer')
{!!$footer!!}
@endsection