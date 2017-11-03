<?php

namespace Japblog;

use Config;

class Keywords
{

public function seokeywords($contents,$symbol=5,$words=35){
	$contents = @preg_replace(array("'<[\/\!]*?[^<>]*?>'si","'([\r\n])[\s]+'si","'&[a-z0-9]{1,6};'si","'( +)'si"),
	array("","\\1 "," "," "),strip_tags($contents));
	
	$rearray = array("~","!","@","#","$","%","^","&","*","(",")","_","+",
		                 "`",'"',"№",";",":","?","-","=","|","\"","\\","/",
		                 "[","]","{","}","'",",",".","<",">","\r\n","\n","\t","«","»");

	$adjectivearray = config('stopwords');
	
	$contents = @str_replace($rearray," ",$contents);
	$keywordcache = @explode(" ",$contents);
	$rearray = array();

	foreach($keywordcache as $word){
		if(strlen($word)>=$symbol && !is_numeric($word)){
			$adjective = substr($word,-2);
			if(!in_array($adjective,$adjectivearray) && !in_array($word,$adjectivearray)){
				$rearray[$word] = (array_key_exists($word,$rearray)) ? ($rearray[$word] + 1) : 1;
			}
		}
	}

	@arsort($rearray);
	$keywordcache = @array_slice($rearray,0,$words);
	$keywords = "";

	foreach($keywordcache as $word=>$count){
		$keywords.= ",".$word;
	}

	return substr(mb_strtolower ($keywords),1);
}
}