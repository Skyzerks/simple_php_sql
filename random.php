<?php

//file for making random input data in databasse

include_once "index/database.php";
$input_id = [];

function rand_val( $val_name){

    //categories
    $categories = ['Furniture', 'Tech', 'Accessories', 'Joke items', 'Unidentified object'];

    //product data
    $product_titles = ['Orange', 'juke box', 'Smartphone', 'Bag-of-nothing', 'Exclusive CD', 'Rubber duck'];
    $product_descriptions = ['An exclusive item for leisure uses', 'Fragile', 'v 3.14', 'Confiscated goods', 'Item used by a celebrity...'];

    //user data
    $names = ['Gaus', 'Ada', 'Kaiser', 'Paul', 'Josh'];
    $roles = ['admin', 'customer'];
    $emails = ['socks@junk.ru', 'joke@rambler.su', 'duck@doge.de', 'pinky@rainbow.jp'];
    $logins = ['pipsqueak', 'birdbrain', 'yolo', 'omega', 'bucket'];

    //orders data
    //need user id, product id
    $order_statuses = ['open', 'in progress', 'closed'];

    //reviews
    //need user id, product id
    $review_texts = ['Great', 'Good', 'Normal', 'Bad', 'Awful'];


    switch($val_name){
        case "roles": return "'".$$val_name[rand(0,1)]."'"; break;
        case "order_statuses": return "'".$$val_name[rand(0,2)]."'"; break;
        default: return "'".$$val_name[rand(0,1)]."'"; break;
    }

}
function insertRow( $db, &$input_id, $table ) {


    switch($table){
    case 'categories':
        $values = [
            'title' => rand_val('categories')
        ];
        break;

    case 'products':
        $values = [
            'title' => rand_val('product_titles'),
            'description' => rand_val('product_descriptions'),
            'price' => rand(15,100),
            'category_id' => $input_id['categories'][ rand(0, count($input_id['categories'])-1) ]
        ];
        break;

    case 'users':
        $values = [
            'name' => rand_val('names'),
            'role' => rand_val('roles'),
            'email' => rand_val('emails'),
            'password' => "'".md5(rand(1000,9999))."'",
            'login' => rand_val('logins'),
            'last_activity' => "'".rand(2015,2016).'-'.rand(1,12).'-'.rand(1,28).' '.rand(0,23).':'.rand(0,59).':'.rand(0,59)."'" //,
            //'birth' => "'".rand(1980,2000).'-'.rand(1,12).'-'.rand(1,28).' '.rand(0,23).':'.rand(0,59).':'.rand(0,59)."'",
            //'age' => rand(10,90)
        ];
        break;

    case 'orders':
        $values = [
            'user_id' => $input_id['users'][ rand(0, count($input_id['users'])-1) ],
            'product_id' => $input_id['products'][ rand(0, count($input_id['products'])-1) ],
            'created_at' => "'".rand(2015,2016).'-'.rand(1,12).'-'.rand(1,28).' '.rand(0,23).':'.rand(0,59).':'.rand(0,59)."'",
            'delivered_at' => "'".rand(2015,2016).'-'.rand(1,12).'-'.rand(1,28).' '.rand(0,23).':'.rand(0,59).':'.rand(0,59)."'",
            'status' => rand_val('order_statuses'),
            'total_price' => rand(15,100)
        ];
        break;

    case 'reviews':
        $values = [
            'user_id' => $input_id['users'][ rand(0, count($input_id['users'])-1) ],
            'product_id' => $input_id['products'][ rand(0, count($input_id['products'])-1) ],
            'created_at' => "'".rand(2015,2016).'-'.rand(1,12).'-'.rand(1,28).' '.rand(0,23).':'.rand(0,59).':'.rand(0,59)."'",
            'text' => rand_val('review_texts'),
            'rating' => rand(1,5)
        ];
        break;
    }

    var_dump("INSERT INTO ".$table."( ".join(',',array_keys($values))." ) VALUES( ".join(',',array_values($values))." )"); echo '<br/>';
    //$db->exec("INSERT INTO ".$table."( ".join(',',array_keys($values))." ) VALUES( ".join(',',array_values($values))." )");

    if( in_array($table,['users','categories','products']) ) {
        $input_id[$table][] = $db->lastInsertId();
    }
}

function fakeDataInsert( $db, &$input_id, $table, $amount ) {
    for( $i=0; $i<$amount; $i++ ) {
        insertRow( $db, $input_id, $table);
    }
}
//fakeDataInsert( $db, $input_id, 'categories', 10 );
//fakeDataInsert( $db, $input_id, 'products', 500 );
//fakeDataInsert( $db, $input_id, 'users', 100 );
//fakeDataInsert( $db, $input_id, 'orders', 300 );
//fakeDataInsert( $db, $input_id, 'reviews', 200 );

fakeDataInsert( $db, $input_id, 'categories', 1 );
fakeDataInsert( $db, $input_id, 'products', 1 );
fakeDataInsert( $db, $input_id, 'users', 1 );
fakeDataInsert( $db, $input_id, 'orders', 1 );
fakeDataInsert( $db, $input_id, 'reviews', 1 );