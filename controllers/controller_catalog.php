<?php

echo 'catalog controller'.'<br/>';
var_dump($id_route); echo '<br/>';

$categories = ($db->query('SELECT * FROM `categories`'));
// var_dump( $categories->rowCount() );

foreach( $categories as $key => $category ) {
	 print_r($category);
	 echo '<br/>';
 }
 echo '<hr/>';