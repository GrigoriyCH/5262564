@foreach($items as $item)
<li>
<a href="{{$item->url()}}">{{$item->title}}</a>
@if($item->hasChildren())
<ul class="sub-menu">
@include(config('settings.theme').'.customMenuItems',['items'=>$item->children()])
</ul>
@endif
</li>

@endforeach