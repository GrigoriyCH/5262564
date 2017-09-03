<div id="content-page" class="content group">
				            <div class="clear"></div>
				            <div class="posts">
				                <div class="group portfolio-post internal-post">
				                      
				                @if($news)
				                
				                    <div id="portfolio" class="portfolio-full-description">
				                   
				                        <div class="fulldescription_title gallery-filters">
				                            <h1>{{$news->title}}</h1>
				                        </div>
				                        
				                        <div class="portfolios hentry work group">
				                            <div class="work-thumbnail">
				                                <img src="{{asset(config('settings.theme'))}}/images/projects/{{$news->img->max}}" alt="{{$news->title}}" title="{{$news->title}}" />
				                            </div>
				                            <div class="work-description">
				                               <p>{{$news->text}}</p>
				                               <div class="clear"></div>
				                                <div class="work-skillsdate">
				                                    <p class="workdate"><span class="label">Date:</span>{{ $news->created_at->format('F d, Y') }}</p>
				                                </div>
				                            </div>
				                            <div class="clear"></div>
				                        </div>
				                        
				                        <div class="clear"></div>
				                        
				                    </div>
				                    
				                @endif
				                    
				                    <div class="clear"></div>
				                </div>
				            </div>
				        </div>