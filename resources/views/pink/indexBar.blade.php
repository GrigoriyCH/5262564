
				            <div class="widget-first widget recent-posts">
				            
				            @if($news)
				               <h3>{{ trans('ru.latest_projects') }}</h3>
				               <div class="recent-post group">
				               
				                   @foreach($news as $post)
				               
				                   <div class="hentry-post group">
				                        <div class="thumb-img"><div style="overflow:hidden;width:55px;max-height:55px"><img src="{{$post->img_mini}}" alt="{{$post->title}}" title="{{$post->title}}" style="width:100%;" /></div></div>
				                        <div class="text">
				                            <a href="{{route('sitenews.show',['id'=>$post->id])}}" title="{{$post->title}}" class="title">{{$post->title}}</a>
											@if($post->created_at)
				                            <p class="post-date">{{ LocalizedCarbon::instance($post->created_at)->diffForHumans() }}</p>
											@endif
				                        </div>
				                    </div>
				                    
				                   @endforeach
				                    
				               </div>
				            @endif
				            <!--
				            <div class="widget-last widget text-image">
				                <h3>Место для рекламы</h3>
								
				                <div class="text-image" style="text-align:left"><img src="{{asset(config('settings.theme'))}}/images/callus.gif" alt="Customer support" /></div>
				                <p>Proin porttitor dolor eu nibh lacinia at ultrices lorem venenatis. Sed volutpat scelerisque vulputate. </p>
								
				            </div>
							-->
							<div class="widget-last widget text-image">
				                <h3>Наша статистика</h3>
								<!--LiveInternet logo-->
								<a href="//www.liveinternet.ru/click"target="_blank">
								<img src="//counter.yadro.ru/logo?29.1"title="LiveInternet: показано количество просмотров и посетителей"alt="" border="0" width="88" height="120"/></a>
								<!--/LiveInternet-->
				            </div>
				            