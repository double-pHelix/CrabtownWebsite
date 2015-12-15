<?php

require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;


function getTweets($querySTring){
	$oauth_token = "4530140774-8eJh3ti4Px4aa76jb4YNhrRdZ5vyxGAKGUMUZ7S";
	$oauth_token_secret = "XxsU4wuZbYYjDaXWgShbT9TWyVXiEVqUmQqVZ9e68KgeJ";
	
	// $connection = getConnectionWithAccessToken($oauth_token, $oauth_token_secret);
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
	
	$statuses = $connection->get("search/tweets", array("q" => $querySTring));
	//var_dump($statuses);
	
	$tweets = $statuses->statuses;
	
	return $tweets;
}