									
								@foreach($items as $item)	
									<li id="li-comment-{{ $item->id }}" class="comment even {{ ($item->user_id == $article->user_id) ?  'bypostauthor odd' : ''}}">
				                        <div id="comment-{{ $item->id }}" class="comment-container">
				                            <div class="vcard mycomment"> 
												
												<div class="thumb-img div-comment-img">
													<div style="overflow:hidden;width:89px;max-height:89px">
														<img src="{{$item->user->avatar}}" alt="{{$item->user->avatar}}" title="{{$item->user->avatar}}" style="width:100%;"/>
													</div>
												</div>
												
                                                <cite class="fn">{{$item->user->name or $item->name}}</cite>                 
				                            </div>
				                            <!-- .comment-author .vcard -->
				                            <div class="comment-meta commentmetadata">
				                                <div class="intro">
				                                    <div class="commentDate">
				                                        <a href="#comment-2">
				                                        {{ is_object($item->created_at) ? $item->created_at->format('F d, Y \a\t H:i') : ''}}</a>                        
				                                    </div>
				                                    <div class="commentNumber">#&nbsp;</div>
				                                </div>
				                                <div class="comment-body">
				                                    <p>{{$item->text}}</p>
				                                </div>
				                                <div class="reply group">
				                                    <a class="comment-reply-link" href="#respond" onclick="return addComment.moveForm(&quot;comment-{{$item->id}}&quot;, &quot;{{$item->id}}&quot;, &quot;respond&quot;, &quot;{{$item->article_id}}&quot;)">Reply</a>                    
				                                </div>
				                                <!-- .reply -->
				                            </div>
				                            <!-- .comment-meta .commentmetadata -->
				                        </div>
				                        <!-- #comment-##  -->
				                    	
				                    	@if(isset($com[$item->id]))
				                    		<ul class="children">
				                    			@include(config('settings.theme').'.comment',['items'=>$com[$item->id]])
				                    		</ul>
				                    	@endif
				                    
				                    </li>
				                   
				                  
				                  @endforeach  