<div id="content-single" class="content group">
				            @if($news)
				            <div class="hentry hentry-post blog-big group ">
				                <!-- post featured & title -->
				                
				                
				                <!--   -->
				                
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
				            
				            <!-- END COMMENTS -->
				            
				            @else
				            <h3>Новость не существует...<h3>
				            
				            @endif
				            
				            
				        </div>