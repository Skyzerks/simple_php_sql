<?php
include "db.php";
$insertedIds = [];
function rand_val($valName ) {
	/* User Data */
	$names = ['Misha','Vasya','Grisha','Masha','Dasha'];
	$emails = ['misha@gmail.com','vasya@mail.ru','grisha@yandex.ru','masha@i.ua','dasha@yahoo.com'];
	$roles = ['admin','customer'];
	$logins = ['misha','vasya','grisha','masha','dasha'];
	
	/* Categories */
	$categories = ['food', 'leasure', 'books', 'music', 'tech'];
	
	/* Products */
	$productTitles = ['Pineapple', 'Tourist tour', 'Alphabet book', 'Austian Opera CD', 'Toshiba laptop'];
	$productDescriptions  = ['test test test test', 'axst axst axst axst', 'stsd testsd stxc estgfs', 'dqq1st sdazst czxast 123st', 'czxest fdest test teasd', ];
	
	/* Orders */
	$orderStatuses = ['open','in progress','closed'];
	
	/* Reviews */
	$reviewTexts = ['Good', 'Bad', 'Normal', 'Auwfull', 'Great'];
	
	if( $valName == 'roles' ) {
		return "'".$$valName[rand(0,1)]."'";
	}
	else if( $valName == 'orderStatuses' ) {
		return "'".$$valName[rand(0,2)]."'";
	}
	else {
		return "'".$$valName[rand(0,4)]."'";
	}
}
function insertRow( $db, &$insertedIds, $table ) {
	
	if( $table == 'categories' ) {
		
		$values = [
			'title' => rand_val('categories')
		];
	}
	else if( $table == 'products' ) {
		
		$values = [
			'title' => rand_val('productTitles'),
			'description' => rand_val('productDescriptions'),
			'price' => rand(15,100),
			'category_id' => $insertedIds['categories'][ rand(0, count($insertedIds['categories'])-1) ]
		];
	}
	else if( $table == 'users' ) {
		
		$values = [
			'name' => rand_val('names'),
			'role' => rand_val('roles'),
			'email' => rand_val('emails'),
			'password' => "'".md5(rand(1000,9999))."'",
			'login' => rand_val('logins'),
			'last_activity' => "'".rand(2015,2016).'-'.rand(1,12).'-'.rand(1,28).' '.rand(0,23).':'.rand(0,59).':'.rand(0,59)."'",
			'birth' => "'".rand(1980,2000).'-'.rand(1,12).'-'.rand(1,28).' '.rand(0,23).':'.rand(0,59).':'.rand(0,59)."'",
			'age' => rand(10,90)
		];
	}
	else if( $table == 'orders' ) {
		
		$values = [
			'user_id' => $insertedIds['users'][ rand(0, count($insertedIds['users'])-1) ],
			'product_id' => $insertedIds['products'][ rand(0, count($insertedIds['products'])-1) ],
			'created_at' => "'".rand(2015,2016).'-'.rand(1,12).'-'.rand(1,28).' '.rand(0,23).':'.rand(0,59).':'.rand(0,59)."'",
			'delivered_at' => "'".rand(2015,2016).'-'.rand(1,12).'-'.rand(1,28).' '.rand(0,23).':'.rand(0,59).':'.rand(0,59)."'",
			'status' => rand_val('orderStatuses'),
			'total_price' => rand(15,100)
		];
	}
	else if( $table == 'reviews' ) {
		
		$values = [
			'user_id' => $insertedIds['users'][ rand(0, count($insertedIds['users'])-1) ],
			'product_id' => $insertedIds['products'][ rand(0, count($insertedIds['products'])-1) ],
			'created_at' => "'".rand(2015,2016).'-'.rand(1,12).'-'.rand(1,28).' '.rand(0,23).':'.rand(0,59).':'.rand(0,59)."'",
			'text' => rand_val('reviewTexts'),
			'rating' => rand(1,5)
		];
	}
	
	// var_dump("INSERT INTO ".$table."( ".join(',',array_keys($values))." ) VALUES( ".join(',',array_values($values))." )");
	$db->exec("INSERT INTO ".$table."( ".join(',',array_keys($values))." ) VALUES( ".join(',',array_values($values))." )");
	
	if( in_array($table,['users','categories','products']) ) {
		$insertedIds[$table][] = $db->lastInsertId();
	}
}
function fakeDataInsert( $db, &$insertedIds, $table, $amount ) {
	for( $i=0; $i<$amount; $i++ ) {
		insertRow( $db, $insertedIds, $table);
	}
}
fakeDataInsert( $db, $insertedIds, 'categories', 10 );
fakeDataInsert( $db, $insertedIds, 'products', 500 );
fakeDataInsert( $db, $insertedIds, 'users', 100 );
fakeDataInsert( $db, $insertedIds, 'orders', 300 );
fakeDataInsert( $db, $insertedIds, 'reviews', 200 );
