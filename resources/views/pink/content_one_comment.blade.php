<li id="li-comment-{{ $data['id']}}" class="comment even borGreen">
	<div id="comment-{{ $data['id'] }}" class="comment-container">
		<div class="vcard mycomment">	                                
			<div class="thumb-img div-comment-img">
				<div style="overflow:hidden;width:89px;max-height:89px">
					<img src="{{$data['avatar']}}" style="width:100%;"/>
				</div>
			</div>
        <cite class="fn">{{$data['name']}}</cite>                 
		</div>
<!-- .comment-author .vcard -->
	<div class="comment-meta commentmetadata">
		<div class="intro">
			
		</div>
		<div class="comment-body">
			<p>{{$data['text']}}</p>
		</div>
	</div>
	</div>				                    
</li>