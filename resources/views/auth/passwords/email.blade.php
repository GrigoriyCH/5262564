<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ie" dir="ltr" lang="en-US">
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="ie" dir="ltr" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="ie" dir="ltr" lang="en-US">
<![endif]-->
<!--[if IE 9]>
<html id="ie9" class="ie" dir="ltr" lang="en-US">
<![endif]-->
<!--[if gt IE 9]>
<html class="ie" dir="ltr" lang="en-US">
<![endif]-->
<!--[if !IE]>
<html dir="ltr" lang="en-US">
<![endif]-->
    
    <!-- START HEAD -->
    <head>
        
        <meta charset="UTF-8" />
        <!-- this line will appear only if the website is visited with an iPad -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />
        
        <meta name="description" content="Вход на сайт">
        <meta name="keywords" content="Вход, сайт, Japblog">
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>Сброс пароля на Japblog</title>
        
        <!-- [favicon] begin -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset(env('THEME'))}}/images/favicon.ico" />
        <link rel="icon" type="image/x-icon" href="{{asset(env('THEME'))}}/images/favicon.ico" />
        <!-- Touch icons more info: http://mathiasbynens.be/notes/touch-icons -->
        <!-- For iPad3 with retina display: -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset(env('THEME'))}}/apple-touch-icon-144x.png" />
        <!-- For first- and second-generation iPad: -->
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset(env('THEME'))}}/apple-touch-icon-114x.png" />
        <!-- For first- and second-generation iPad: -->
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset(env('THEME'))}}/apple-touch-icon-72x.png" />
        <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
        <link rel="apple-touch-icon-precomposed" href="{{asset(env('THEME'))}}/apple-touch-icon-57x.png" />
        <!-- [favicon] end -->
        
        <!-- CSSs -->
        <link rel="stylesheet" type="text/css" media="all" href="{{asset(env('THEME'))}}/css/reset.css" /> <!-- RESET STYLESHEET -->
        <link rel="stylesheet" type="text/css" media="all" href="{{asset(env('THEME'))}}/style.css" /> <!-- MAIN THEME STYLESHEET -->
        
        <link rel="stylesheet" type="text/css" media="all" href="{{asset(env('THEME'))}}/mycss.css" />
        <link rel="stylesheet" type="text/css" media="all" href="{{asset(env('THEME'))}}/auth.css" />
        
        <link rel="stylesheet" id="max-width-1024-css" href="{{asset(env('THEME'))}}/css/max-width-1024.css" type="text/css" media="screen and (max-width: 1240px)" />
        <link rel="stylesheet" id="max-width-768-css" href="{{asset(env('THEME'))}}/css/max-width-768.css" type="text/css" media="screen and (max-width: 987px)" />
        <link rel="stylesheet" id="max-width-480-css" href="{{asset(env('THEME'))}}/css/max-width-480.css" type="text/css" media="screen and (max-width: 480px)" />
        <link rel="stylesheet" id="max-width-320-css" href="{{asset(env('THEME'))}}/css/max-width-320.css" type="text/css" media="screen and (max-width: 320px)" />
        
        <!-- CSSs Plugin -->
        <link rel="stylesheet" id="thickbox-css" href="{{asset(env('THEME'))}}/css/thickbox.css" type="text/css" media="all" />
        <link rel="stylesheet" id="styles-minified-css" href="{{asset(env('THEME'))}}/css/style-minifield.css" type="text/css" media="all" />
        <link rel="stylesheet" id="buttons" href="{{asset(env('THEME'))}}/css/buttons.css" type="text/css" media="all" />
        <link rel="stylesheet" id="cache-custom-css" href="{{asset(env('THEME'))}}/css/cache-custom.css" type="text/css" media="all" />
        <link rel="stylesheet" id="custom-css" href="{{asset(env('THEME'))}}/css/custom.css" type="text/css" media="all" />
	    
        <!-- FONTs -->
        <link rel="stylesheet" id="google-fonts-css" href="http://fonts.googleapis.com/css?family=Oswald%7CDroid+Sans%7CPlayfair+Display%7COpen+Sans+Condensed%3A300%7CRokkitt%7CShadows+Into+Light%7CAbel%7CDamion%7CMontez&amp;ver=3.4.2" type="text/css" media="all" />
        <link rel='stylesheet' href="{{asset(env('THEME'))}}/css/font-awesome.css" type='text/css' media='all' />
        
</head>
<body>
<div class="wrapper">
                <!-- START HEADER -->
                <div id="header" class="group">
                    
                    <div class="group inner">
                        
                        <!-- START LOGO -->
                        <div id="logo" class="group">
                            <a href="{{route('home')}}" title="Pink Rio"><img src="{{asset(env('THEME'))}}/images/logo.png" title="Pink Rio" alt="Pink Rio" /></a>
                        </div>
                        <!-- END LOGO -->
                        <div class="clearer"></div>
                        <hr />
                        
                    </div>
                    <!-- START PAGE META -->
				    <div id="page-meta">
				    <div class="inner group" style="margin-top: 20px;">
				        <h3>Welcome to my portfolio page</h3>
				        <h4>... i hope you enjoy my works</h4>
				    </div>
				    </div>
				    <!-- END PAGE META -->	
                </div>
<div class="content">
<div id="wrapper" class="group">
       <div id="block">
                    @if (session('status'))
                        <div>
                            {{ session('status') }}
                        </div>
                    @endif

                    <form role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div>
                            <label for="email">E-Mail Address</label>

                            <div>
                                <input class="INPUT_1" id="email" type="email" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span>
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div>
                                <center><button type="submit" id="butsend"  style="margin-top: 1em;">Send Password Reset Link</button></center>
                        </div>
                    </form>
       </div>
</div>
</div>
<div class="footer" id="wrapper">
     <div id="copyright">
                    <div class="inner group">
                        <div class="left">
                            <a href="{{route('contacts')}}"><strong>Связь с администрацией сайта</strong></a>
                        </div>
                        <div class="right">
                            <a href="#" class="socials-small facebook-small" title="Facebook">facebook</a>
                            <a href="#" class="socials-small rss-small" title="Rss">rss</a>
                            <a href="#" class="socials-small twitter-small" title="Twitter">twitter</a>
                            <a href="#" class="socials-small flickr-small" title="Flickr">flickr</a>
                            <a href="#" class="socials-small skype-small" title="Skype">skype</a>
                            <a href="#" class="socials-small google-small" title="Google">google</a>
                            <a href="#" class="socials-small pinterest-small" title="Pinterest">pinterest</a>
                        </div>
                    </div>
     </div>
</div>
</div>
</body>
</html>
