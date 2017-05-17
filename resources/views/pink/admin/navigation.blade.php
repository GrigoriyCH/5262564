@if($menu)
	<div class="menu classic">
	{!!$menu->asUl(['id'=>'nav','class'=>'menu'])!!}
	</div>
@endif