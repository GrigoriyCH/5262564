<div id="content-single" class="content group">
				            @if($news)
				            <div class="hentry hentry-post blog-big group ">
				                <!-- post featured & title -->
				                
				                
				                <!--   -->
				                <input type="hidden" id="countComments" value="{{count($news->newscomments)}}" />
				                <input type="hidden" id="postID" value="{{$news->id}}" />
				                <input type="hidden" id="stepComments" value="{{config('settings.get_comments')}}" />
				                <!--   -->
				                <div class="thumbnail" style="max-width:100%;width:100%">
				                    <!-- post title -->
				                    <h1 class="post-title"><a href="#">{{$news->title}}</a></h1>
				                    <!-- post featured -->
				                    <div class="image-wrap img-head">
				                        <img style="width:100%" src="{{asset(env('THEME'))}}/images/projects/{{$news->img->max}}" alt="{{ $news->title }}" title="{{ $news->title }}" />  
				                    </div>
				                    <p class="date">
				                        <span class="month">{{$news->created_at->format('M')}}</span>
				                        <span class="day">{{$news->created_at->format('d')}}</span>
				                    </p>
				                </div>
				                <!-- post meta -->
				        
				                <!-- post content -->
				                <div class="the-content single group">
				                    
				                    <p>{!!$news->text!!}</p>
				                    
				                    <div class="socials">
				                        <h2>love it, share it!</h2>
				                        <a href="https://www.facebook.com/sharer.html?u=http%3A%2F%2Fyourinspirationtheme.com%2Fdemo%2Fpinkrio%2F2012%2F09%2F24%2Fthis-is-the-title-of-the-first-article-enjoy-it%2F&amp;t=This+is+the+title+of+the+first+article.+Enjoy+it." class="socials-small facebook-small" title="Facebook">facebook</a>
				                        <a href="https://twitter.com/share?url=http%3A%2F%2Fyourinspirationtheme.com%2Fdemo%2Fpinkrio%2F2012%2F09%2F24%2Fthis-is-the-title-of-the-first-article-enjoy-it%2F&amp;text=This+is+the+title+of+the+first+article.+Enjoy+it." class="socials-small twitter-small" title="Twitter">twitter</a>
				                        <a href="https://plusone.google.com/_/+1/confirm?hl=en&amp;url=http%3A%2F%2Fyourinspirationtheme.com%2Fdemo%2Fpinkrio%2F2012%2F09%2F24%2Fthis-is-the-title-of-the-first-article-enjoy-it%2F&amp;title=This+is+the+title+of+the+first+article.+Enjoy+it." class="socials-small google-small" title="Google">google</a>
				                        <a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fyourinspirationtheme.com%2Fdemo%2Fpinkrio%2F2012%2F09%2F24%2Fthis-is-the-title-of-the-first-article-enjoy-it%2F&amp;media=http://yourinspirationtheme.com/demo/pinkrio/files/2012/09/00212.jpg&amp;description=Fusce+nec+accumsan+eros.+Aenean+ac+orci+a+magna+vestibulum+posuere+quis+nec+nisi.+Maecenas+rutrum+vehicula+condimentum.+Donec+volutpat+nisl+ac+mauris+consectetur+gravida.+Lorem+ipsum+dolor+sit+amet%2C+consectetur+adipiscing+elit.+Donec+vel+vulputate+nibh.+Pellentesque%5B...%5D" class="socials-small pinterest-small" title="Pinterest">pinterest</a>
				                        <a href="http://yourinspirationtheme.com/demo/pinkrio/2012/09/24/this-is-the-title-of-the-first-article-enjoy-it/" class="socials-small bookmark-small" title="This is the title of the first article. Enjoy it.">bookmark</a>
				                    </div>
				                </div>
				                <p class="tags">Tags: <a href="#" rel="tag">book</a>, <a href="#" rel="tag">css</a>, <a href="#" rel="tag">design</a>, <a href="#" rel="tag">inspiration</a></p>
				                <div class="clear"></div>
				            </div>
				            <!-- START COMMENTS -->
				            <div id="comments">
				                <h3 id="comments-title">
				                    <span id="spanCountComms">{{count($news->newscomments)}}</span> {{Lang::choice('ru.comments',count($news->newscomments))}}    
				                </h3>

				                <ol id="ajaxels" class="commentlist group">
				                
				                
				                    
				                </ol>
                                <center id="cent"><a id="getContent">Показать еще комментарии</a><div id="divWait" style="display: none">Загрузка комментариев...</div><div id="divContent"></div></center>
				                <!-- START TRACKBACK & PINGBACK -->
				                <h2 id="trackbacks">Trackbacks and pingbacks</h2>
				                <ol class="trackbacklist"></ol>
				                <p><em>No trackback or pingback available for this article.</em></p>
                                
				                <!-- END TRACKBACK & PINGBACK -->								
				                <div id="respond">
				                    <h3 id="reply-title">Leave a <span>Reply</span> <small onclick="cancelHello(&quot;<?php echo($news->user_id); ?>&quot;)"><a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;">Cancel reply</a></small></h3>
				                    <form id="commentform" action="{{route('comment.store')}}" method="post" >
				                        @if(!Auth::check())
					                        <p class="comment-form-author"><label for="author">Name</label> <input id="name" name="name" type="text" value="" size="30" aria-required="true" /></p>
					                        <p class="comment-form-email"><label for="email">Email</label> <input id="email" name="email" type="text" value="" size="30" aria-required="true" /></p>
					                        <p class="comment-form-url"><label for="url">Website</label><input id="url" name="site" type="text" value="" size="30" /></p>
				                        @endif
				                        <p class="comment-form-comment"><label for="comment">Your comment</label><textarea id="comment" name="text" cols="45" rows="8"></textarea></p>
				                        <div class="clear"></div>
				                        <p class="form-submit">
				                            {{ csrf_field() }}
				                            <input id="comment_post_ID" type="hidden" name="comment_post_ID" value="{{ $news->id }}" />
				                        	<input id="comment_parent" type="hidden" name="comment_parent" value="0" />
				                        	<input id="comment_to_user_id" type="hidden" name="comment_to_user_id" value="{{ $news->user_id }}" />
				                            <input name="submit" type="submit" id="submit" value="Post Comment" />
				                        </p>
				                    </form>
				                </div>
				                <!-- #respond -->
				            </div>
				            <!-- END COMMENTS -->
				            
				            @else
				            <h3>Новость не существует...<h3>
				            
				            @endif
				            
				            
				        </div>