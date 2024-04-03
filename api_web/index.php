<?php
require_once __DIR__ . "/libraries/path.php";
require_once __DIR__ . "/database/connection.php";
require_once __DIR__ . "/libraries/method.php";

ini_set("display_errors", 1);
error_reporting(E_ALL);

echo "Hello, world!";

if(isPath("/adduser")){

	if(isPostMethod("post")){
	require_once __DIR__ . "/routes/adduser.php";
    die();
	}
}

if(isPath("/getusers")){

    if(isPostMethod("post")){
        require_once __DIR__ . "/routes/getusers.php";
        die();
    }





}
