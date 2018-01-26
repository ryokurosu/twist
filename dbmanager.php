<?php 
date_default_timezone_set('Asia/Tokyo');

define('DB_HOST','127.0.0.1');
define('DB_STAFF','root');
define('DB_PASS','Kurosu96');
define('DB_NAME','twist');

function connectDb(){
	$db = new mysqli(DB_HOST,DB_STAFF,DB_PASS,DB_NAME);
// $db = new mysqli( 'localhost', 'staff', 'password', 'shop' );
	if ($db->connect_error) {
		echo $db->connect_error;
		exit ();
	} 
	return $db;
}
function getDb() {
    // database connected check
	$pdo = new PDO ( 'mysql:dbname='.DB_NAME.'; host='.DB_HOST.';port=3306; charset=utf8', DB_STAFF, DB_PASS );
	return $pdo;
}

function getkey($account_id){
	$db = connectDb();
	$pdo = getDb();
	$db->set_charset ( "utf8" );
	$que = $pdo->prepare("select * from accounts where account_id = ?");
	if($que->execute([$account_id])){
	}
	$result = $que->fetchAll();
	return $result[0];
}

function getbottsetting($account_id){
	$db = connectDb();
	$pdo = getDb();
	$db->set_charset ( "utf8" );
	$que = $pdo->prepare("select * from botsettings where account_id = ?");
	if($que->execute([$account_id])){
	}
	$result = $que->fetchAll();
	return $result[0];
}
function getbotrule($botrule_id){
	$db = connectDb();
	$pdo = getDb();
	$db->set_charset ( "utf8" );
	$que = $pdo->prepare("select * from botrules where botrule_id = ?");
	if($que->execute([$botrule_id])){
	}
	$result = $que->fetchAll();
	return $result[0];
}
function getbotstory($botstory_id){
	$db = connectDb();
	$pdo = getDb();
	$db->set_charset ( "utf8" );
	$que = $pdo->prepare("select * from storytexts where story_id = ?");
	if($que->execute([$botstory_id])){
	}
	$result = $que->fetchAll();
	return $result;
}
function settweet($botstory_id,$text){
	$db = connectDb();
	$pdo = getDb();
	$db->set_charset ( "utf8" );
	$que = $pdo->prepare("insert into storytexts (story_id,text) value (?,?)");
	if($que->execute([$botstory_id,$text])){
		echo "|";
	}else{
		echo "error";
	}
}


function getdmsetting($account_id){
	$db = connectDb();
	$pdo = getDb();
	$db->set_charset ( "utf8" );
	$que = $pdo->prepare("select * from dmsettings where account_id = ?");
	if($que->execute([$account_id])){
	}
	$result = $que->fetchAll();
	return $result[0];
}
function getdmrule($dmrule_id){
	$db = connectDb();
	$pdo = getDb();
	$db->set_charset ( "utf8" );
	$que = $pdo->prepare("select * from dmrules where dmrule_id = ?");
	if($que->execute([$dmrule_id])){
	}
	$result = $que->fetchAll();
	return $result[0];
}
function getdmstory($dmstory_id){
	$db = connectDb();
	$pdo = getDb();
	$db->set_charset ( "utf8" );
	$que = $pdo->prepare("select * from dmtexts where dmstory_id = ?");
	if($que->execute([$dmstory_id])){
	}
	$result = $que->fetchAll();
	return $result;
}

function savefollowers($account_id,$follower_id){
	$db = connectDb();
	$pdo = getDb();
	$db->set_charset ( "utf8" );
	$que = $pdo->prepare("insert into followers (account_id,target_id) value (?,?)");
	if($que->execute([$account_id,$follower_id])){
		echo "|";
	}else{
		echo "error";
	}
}
function setStatisticData($account_id,$follow,$follower){
	$db = connectDb();
	$pdo = getDb();
	$db->set_charset ( "utf8" );
	$que = $pdo->prepare("insert into statistics (account_id,follow,follower) value (?,?,?)");
	if($que->execute([$account_id,$follow,$follower])){
		echo "|";
	}else{
		echo "error";
	}
}









?>