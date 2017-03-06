<?php
 
// Configs
define("HOST", "localhost"); //server address
define("USER", "root");
define("PASS", "1111");
define("DBNAME", "base");
// Connect to database
try {
  $db = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8mb4", "".USER."", "".PASS."");
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


