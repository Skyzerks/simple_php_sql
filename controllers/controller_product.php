<?php

echo 'product controller'.'<br/>';
var_dump($id_route); echo '<br/>';

$products = ($db->query('SELECT * FROM `products`'));
// var_dump( $categories->rowCount() );

foreach( $products as $key => $product ) {
	 print_r($product);
	 echo '<br/>';
 }
 echo '<hr/>';