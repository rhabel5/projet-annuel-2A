<?php
require_once __DIR__ . "/libraries/path.php";
require_once __DIR__ . "/database/connection.php";
require_once __DIR__ . "/libraries/method.php";

ini_set("display_errors", 1);
error_reporting(E_ALL);

echo "Hello, world!";

if(isPath("/adduser")){

	if(isPostMethod("post")){
	require_once __DIR__ . "/routes/routes_users/adduser.php";
    die();
	}
}

if(isPath("/getusers")) {

    if (isGetMethod("get")) {
        require_once __DIR__ . "/routes/routes_users/getusers.php";
        echo "ok test";
        die();
    }
}

if(isPath("/updateuser")){

    if(isPostMethod("post")){
        require_once __DIR__ . "/routes/routes_users/updateuser.php";
        echo "ok test";
        die();
    }

}
if(isPath("/updatebien")){

    if(isPostMethod("post")){
        require_once __DIR__ . "/routes/routes_biens/updatebien.php";
        echo "ok test";
        die();
    }

}

if(isPath("/addbien")){

    if(isPostMethod("post")){
        require_once __DIR__ . "/routes/routes_biens/addbien.php";
        echo "ok test";
        die();
    }

}

if(isPath("/deleteuser")){

    if(isDeleteMethod("delete")){
        require_once __DIR__ . "/routes/routes_users/deleteuser.php";
        echo "delete";
        die();
    }

}

if(isPath("/deletebien")){

    if(isDeleteMethod("delete")){
        require_once __DIR__ . "/routes/routes_biens/deletebien.php";
        echo "delete";
        die();
    }

}
if(isPath("/getallbiens")){

    if(isGetMethod("get")){
        require_once __DIR__ . "/routes/routes_biens/getallbiens.php";
        echo "delete";
        die();
    }

}
