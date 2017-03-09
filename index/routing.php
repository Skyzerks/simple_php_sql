    <?php

    //file for address parsing and finding route to needed page

    $routs = [
        'catalog',
        'product',
        'add-product-to-basket',

        'registration',
        'login',
        'myadmin',
        'guest',

        'basket',
        'order'
    ];

    $action = null;
    $_action = null;
    $id_route = null;

    if( $_SERVER['REQUEST_URI'] != '/' ) {
        $url =  parse_url($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
        $url_arr = explode('/',$url['path']);
        $url_arr = array_filter($url_arr);
        $action = $url_arr[1];
        if( isset($url_arr[2]) ) {
            if(is_numeric($url_arr[2])){
                $id_route = $url_arr[2];
            }
            else $_action = $url_arr[2];
        }
        if( !in_array( $action, $routs ) ) {
            $action = null;
            $_action = null;
        }
    }
    else {
        $action = 'main';
    }

