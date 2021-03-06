<?php

namespace Japblog\Http\Controllers;

use Illuminate\Http\Request;

use Japblog\Http\Requests;
use App;
use Japblog\Repositories\PostsRepository;
use Config;
class RssController extends Controller
{
	public function __construct(PostsRepository $p_rep){
		$this->p_rep = $p_rep;
	}
    //
	public function animation(){
		
	// create new feed
		$feed = App::make("feed");

	// multiple feeds are supported
	// if you are using caching you should set different cache keys for your feeds

	// cache the feed for 60 minutes (second parameter is optional)
		$feed->setCache(60, 'animationFeedKey');

    // check if there is cached feed and build new only if is not
    if (!$feed->isCached())
    {
    // creating rss feed with our most recent 20 posts
		$where = 'category_id';

		$posts = $this->p_rep->getRssAn(['id','title','created_at','text','user_id','meta_desc','category_id'],Config::get('settings.rss-count'),$where);
		/*подгружаю авторов*/
	    if($posts){
			$posts->load('user');
		}
		//dd($posts);
    // set your feed's title, description, link, pubdate and language
		
		$feed->title = 'MOYZHURNAL.COM || RSS-лента о аниме и мультиках';
		$feed->description = 'Новостная лента о постах на тему аниме и мультфильмов';
        
        $feed->logo = asset(config('settings.theme')).'/images/logo.png';
		
	    $feed->link = route('rss-animation');

        $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
        $feed->pubdate = $posts[0]->created_at;
        $feed->lang = 'ru';
        $feed->setShortening(true); // true or false
        $feed->setTextLimit(256); // maximum length of description text

       foreach ($posts as $post)
       {
        // set item's title, author, url, pubdate, description, content, enclosure (optional)*
           $feed->add($post->title, $post->user->name, route('posts.show',['id'=>$post->id]), $post->created_at, $post->meta_desc, $post->meta_desc);
       }

    }

    // first param is the feed format
    // optional: second param is cache duration (value of 0 turns off caching)
    // optional: you can set custom cache key with 3rd param as string
		return $feed->render('atom');

    // to return your feed as a string set second param to -1
    // $xml = $feed->render('atom', -1);
	}
	
	public function movies(){
		
	// create new feed
		$feed = App::make("feed");

	// multiple feeds are supported
	// if you are using caching you should set different cache keys for your feeds

	// cache the feed for 60 minutes (second parameter is optional)
		$feed->setCache(60, 'moviesFeedKey');

    // check if there is cached feed and build new only if is not
    if (!$feed->isCached())
    {
    // creating rss feed with our most recent 20 posts
		$where = 'category_id';

		$posts = $this->p_rep->getRssTv(['id','title','created_at','text','user_id','meta_desc','category_id'],Config::get('settings.rss-count'),$where);
		/*подгружаю авторов*/
	    if($posts){
			$posts->load('user');
		}
		//dd($posts);
    // set your feed's title, description, link, pubdate and language
		
		$feed->title = 'MOYZHURNAL.COM || RSS-лента о кино и сериалахах';
		$feed->description = 'Новостная лента о постах на тему кино и сериалов';
        
        $feed->logo = asset(config('settings.theme')).'/images/logo.png';
		
	    $feed->link = route('rss-movies');

        $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
        $feed->pubdate = $posts[0]->created_at;
        $feed->lang = 'ru';
        $feed->setShortening(true); // true or false
        $feed->setTextLimit(256); // maximum length of description text
		
       foreach ($posts as $post)
       {
        // set item's title, author, url, pubdate, description, content, enclosure (optional)*
           $feed->add($post->title, $post->user->name, route('posts.show',['id'=>$post->id]), $post->created_at, $post->meta_desc, $post->meta_desc);
       }

    }

    // first param is the feed format
    // optional: second param is cache duration (value of 0 turns off caching)
    // optional: you can set custom cache key with 3rd param as string
		return $feed->render('atom');

    // to return your feed as a string set second param to -1
    // $xml = $feed->render('atom', -1);
	}
	public function dzen(){
		$dzen = array();
		$articles = $this->p_rep->get(['id','title','created_at','img','text','user_id','category_id','keywords','meta_desc'],Config::get('settings.rss-count'),FALSE,FALSE,FALSE);
		if($articles){
			$articles->load('user');
		}
		
		return view(config('settings.theme').'.dzen')->with(['articles' => $articles]);
	}
}
