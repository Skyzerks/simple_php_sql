<?php

//file for connection to database 'dbname' on 'host' loged in as 'user' with password 'pass'

// Configs
define("host", "localhost"); //server address
define("user", "root");
define("pass", "1111");
define("dbname", "base");
// Connect to database
try {
  $db = new PDO("mysql:host=".host.";dbname=".dbname.";charset=utf8mb4", user, pass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo $e->getMessage();
}
//var_dump($db);


// Simple function to handle PDO prepared statements
// function sql($db, $q, $params = [], $return = null) {
  
  //Prepare statement
  // $stmt = $db->prepare($q);
  
  //Execute statement
  // $res = $stmt->execute($params);
  
  //Decide whether to return the rows themselves, or query status
  // if ($return == "rows") {
    // return $stmt->fetchAll();
  // }
  // else {
    // return $res;
  // }
// }


