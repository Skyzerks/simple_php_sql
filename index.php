<?php
session_start();

// Simple function to handle PDO prepared statements
function sql($db, $q, $params = [], $return = null) {

    // Prepare statement
    $stmt = $db->prepare($q);

    // Execute statement
    $res = $stmt->execute($params);

    // Decide whether to return the rows themselves, or query status
    if ($return == "rows") {
        return $stmt->fetchAll();
    }
    else {
        return $res;
    }
}


// Configs
define("HOST", "localhost"); //server address
define("USER", "root");
define("PASS", "1111");
define("DBNAME", "base");
// Connect to database
try {
    $_db = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8mb4", "".USER."", "".PASS."");
    $_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
}



$routs = ['catalog', 'product'];

$_action = null;
$_subAction = null;
$_id = null;

if( $_SERVER['REQUEST_URI'] != '/' ) {
    $url =  parse_url($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
    $urlArray = explode('/',$url['path']);
    $urlArray = array_filter($urlArray);
    $_action = $urlArray[1];
    if( isset($urlArray[2]) ) {
        if(is_numeric($urlArray[2])){
            $_id = $urlArray[2];
        }
        else $_subAction = $urlArray[2];
    }
    if( !in_array( $_action, $routs ) ) {
        $_action = null;
        $_subAction = null;
    }
}
else {
    $_action = 'main';
}

echo '<br/>$_action = ' . $_action;
echo '<br/>$_subAction = ' . $_subAction;
echo '<br/>$_id = ' . $_id;
echo '<hr/>';

if( $_action == 'main' ) {

    $categories = sql( $_db, 'SELECT * FROM `categories`', [], 'rows' );

    foreach( $categories as $category ) {
        echo '<a href="/catalog/'.$category['id'].'">'.$category['title'].'</a><br/>';
    }
}

if( $_action == 'catalog' && $_id ) {

    $category = sql( $_db,
        'SELECT * FROM `categories` WHERE `id` = '.$_id,
        [],
        'rows'
    );

    $products = sql( $_db,
        'SELECT * FROM `products` WHERE `category_id` = '.$_id,
        [],
        'rows'
    );

    echo '<h1>'.$category[0]['title'].'</h1>';

    foreach( $products as $product ) {
        echo '<a href="/product/'.$product['id'].'">'.$product['title'].'</a><br/>';
    }
}

if( $_action == 'product' && $_id ) {

    $product = sql( $_db,
        'SELECT * FROM `products` WHERE `id` = '.$_id,
        [],
        'rows'
    );


    echo '<h1>'.$product[0]['title'].'</h1>';
    echo '<p>'.$product[0]['description'].'</p>';
    echo '<p>Price: '.$product[0]['price'].'</p>';
    echo '<button>Buy</button>';
}