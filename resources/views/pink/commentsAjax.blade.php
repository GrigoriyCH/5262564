@if(count('$comments') > 0)
@set($num,$idp+1)
@foreach($comments as $comment)
				                    <li id="li-comment-{{ $comment->id }}" class="comment even {{ ($comment->user_id == $article_id) ?  'bypostauthor odd' : ''}}">
				                        <div id="comment-{{ $comment->id }}" class="comment-container">
				                            <div class="vcard mycomment"> 
												
												<div class="thumb-img div-comment-img">
													<div style="overflow:hidden;width:89px;max-height:89px">
														<img src="{{ isset($comment->user) ? $comment->user->avatar : config('settings.default_avatar')}}" title = "" style="width:100%;"/>
													</div>
												</div>
												
                                                <cite class="fn">{{$comment->user->name or $comment->name}}</cite>                 
				                            </div>
				                            <!-- .comment-author .vcard -->
				                            <div class="comment-meta commentmetadata">
				                                <div class="intro">
				                                    <div class="commentDate">
				                                        <a>
				                                        {{ is_object($comment->created_at) ? $comment->created_at->format('F d, Y \a\t H:i') : ''}}</a>                        
				                                    </div>
				                                    <div class="commentNumber">#&nbsp;{{$num}}</div>
				                                </div>
				                                <div class="comment-body">
				                                    <p>{{$comment->text}}</p>
				                                </div>
				                                <div class="reply group">
														<a id="reply_comment" class="comment-reply-link"  onclick="return addComment.moveForm(&quot;comment-{{$comment->id}}&quot;, &quot;{{$comment->id}}&quot;, &quot;respond&quot;, &quot;{{$comment->article_id}}&quot;),sayHello(&quot;<?php echo ($comment->name.", "); ?>&quot;,&quot;<?php echo($comment->user_id); ?>&quot;)">Ответить</a>   												
				                                </div>
				                                <!-- .reply -->
				                            </div>
				                            <!-- .comment-meta .commentmetadata -->
				                        </div>
				                        <!-- #comment-##  -->				                    
				                    </li>
@set($num,$num+1)				                    
@endforeach
@endif