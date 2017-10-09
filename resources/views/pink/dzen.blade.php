@if($articles)
<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<rss version="2.0"
xmlns:content="http://purl.org/rss/1.0/modules/content/"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:media="http://search.yahoo.com/mrss/"
xmlns:atom="http://www.w3.org/2005/Atom"
xmlns:georss="http://www.georss.org/georss">
<channel>
<title>МОЙ ЖУРНАЛ</title>
<link>http://moyzhurnal.com/</link>
<description>Проект посвященный обзорам кино, аниме, мультфильмов и сериалов</description>
<language>ru</language>
@foreach($articles as $article)
<item>
	<title>{{$article->title}}</title>
	<link>{{ route('posts.show',['id'=>$article->id]) }}</link>
	<pdalink>{{ route('posts.show',['id'=>$article->id]) }}</pdalink>
	<amplink>{{ route('posts.show',['id'=>$article->id]) }}</amplink>
	<guid>{{ route('posts.show',['id'=>$article->id]) }}</guid>
	<pubDate>{{$article->created_at->format(DateTime::RSS)}}</pubDate>
	<media:rating scheme="urn:simple">nonadult</media:rating>
	<author>{{$article->user->name}}</author>
	<category>Кино</category>
	<enclosure url="{{$article->img}}" type="image/jpeg"/>
	<description><![CDATA[{!!$article->meta_desc!!}]]></description>
	<content:encoded><![CDATA[{!!$article->text!!}]]></content:encoded>
</item>
@endforeach
</channel>
</rss>
@endif