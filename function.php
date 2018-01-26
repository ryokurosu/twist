<?php 
require_once 'dbmanager.php';
require "twitteroauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;
mb_language("japanese");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');


$ac_id = 1;
$result = getkey($ac_id);


$consumerKey = $result['consumerkey']; 
$consumerSecret = $result['consumersecret']; 
$accessToken = $result['accesstoken']; 
$accessTokenSecret = $result['accesstokensecret'];
$screenname = $result['screenname'];

$connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);


// $botsetting = getbottsetting($ac_id);
// $botrule_id = $botsetting['botrule_id'];
// $botstory_id = $botsetting['botstory_id'];

// $botrule = getbotrule($botrule_id);
// $span = $botrule['span'];
// $botlimit = $botrule['botlimit'];

// $botstory = getbotstory($botstory_id);


// foreach($botstory as $story){
// 	$statues = $connection->post("statuses/update", [
// 		"status"                 => $story['text']
// 	]);
// 	echo "done!";
// 	sleep($span);
// }


// $keyword = '笑';
// $retweet = '10';
// $fav = '10';

// $tweets = $connection->get('search/tweets',[
// 	'q' => $keyword.' min_retweets:'.$retweet.' min_faves:'.$fav,
// 	'lang' => 'ja',
// 	'locale' => 'ja',
// 	'result_type' => 'recent',
// 	'count' => '10'
// ]);


// foreach($tweets->statuses as $tweet){
// 	settweet($botstory_id,$tweet->text);
// }
// 
// 
// 


$dmsetting = getdmsetting($ac_id);
$dmrule_id = $dmsetting['dmrule_id'];
$dmstory_id = $dmsetting['dmstory_id'];

$dmrule = getdmrule($dmrule_id);
$span = $botrule['span'];
$dmlimit = $botrule['botlimit'];
$dmstory = getdmstory($dmstory_id);


echo $dmstory[rand(0,count($dmstory)-1)]['text']."\n";



$status = $connection->get("users/show",[
'screen_name' => $screenname

]);
setStatisticData($ac_id,$status->friends_count,$status->followers_count);


// $temp = $connection->get("followers/ids",[
// 	'screen_name' => $screenname,
// 	'stringify_ids' => true,
// 	'count' => 15
// ]);


// foreach ($temp->ids as $v) {
	// $temp = $connection->post("direct_messages/new",[
	// 'user_id' => $v,
	// 'text' => $dmstory[0]['text']
	// 
// ]);
	// savefollowers($ac_id,$v);
// }


// foreach($botstory as $story){
// 	$statues = $connection->post("statuses/update", [
// 		"status"                 => $story['text']
// 	]);
// 	echo "done!";
// 	sleep($span);
// }


// $keyword = '笑';
// $retweet = '10';
// $fav = '10';

// $tweets = $connection->get('search/tweets',[
// 	'q' => $keyword.' min_retweets:'.$retweet.' min_faves:'.$fav,
// 	'lang' => 'ja',
// 	'locale' => 'ja',
// 	'result_type' => 'recent',
// 	'count' => '10'
// ]);


// foreach($tweets->statuses as $tweet){
// 	settweet($botstory_id,$tweet->text);
// }








?>