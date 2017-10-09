<div id="copyright">
                    <div class="inner group">
                        <div class="left">
                            <a href="{{route('contacts')}}"><strong>Связь с администрацией сайта</strong></a>
                        </div>
                        <div class="right">
							@if(Route::currentRouteName() == 'home')
								@include('pink.i-ua')
								@include('pink.meta-ua')
							@endif
							<a href="{{route('rules')}}"><strong>Правила сайта</strong></a>
						<!--
                            <a href="#" class="socials-small facebook-small" title="Facebook">facebook</a>
                            <a href="#" class="socials-small rss-small" title="Rss">rss</a>
                            <a href="#" class="socials-small twitter-small" title="Twitter">twitter</a>
                            <a href="#" class="socials-small flickr-small" title="Flickr">flickr</a>
                            <a href="#" class="socials-small skype-small" title="Skype">skype</a>
                            <a href="#" class="socials-small google-small" title="Google">google</a>
                            <a href="#" class="socials-small pinterest-small" title="Pinterest">pinterest</a>
						-->
                        </div>
                    </div>
</div>