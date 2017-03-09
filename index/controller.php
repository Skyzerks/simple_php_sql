<?php

//main logic (file for action recognition)

if($action==null){
    include "templates/view_404.php";
}
if($action=='catalog'){
    include 'controllers/controller_catalog.php';
}
else if($action=='product'){
    include 'controllers/controller_product.php';
}
else{
    echo 'action= '.$action.'<br/>';
    echo '_action= '.$_action.'<br/>';
}

