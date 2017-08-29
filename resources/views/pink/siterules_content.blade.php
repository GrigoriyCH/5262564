<div id="content-single" class="content group">
	<div class="hentry hentry-post blog-big group ">
	
	@if($rules)
		
		@set($i,0)
	
		<div class="JapTable"><!-- div for table css -->
			<table style="width: 100%" cellspacing="0" cellpadding="0">
			<tr>
				<th><h3>Правила сайта<h3></th>
			</tr>
			
			@foreach($rules as $key => $rule)
				<tr>
					<td class="align-left">
					{{$key}}. {{$rule}}
					</td>
				</tr>
			@endforeach
			</table>
		</div>
	@else
		<center><h3>Правила сайта<h3></center>
		<h3>1. Не говорить о сайте.<h3>
		<h3>2. Никогда не говорить о сайте.<h3>
	@endif
				            
	</div>			            
</div>