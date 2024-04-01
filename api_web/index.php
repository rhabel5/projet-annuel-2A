<?php
require_once __DIR__ . "/libraries/path.php";
require_once __DIR__ . "/database/connection.php";
require_once __DIR__ . "/libraries/method.php";

ini_set("display_errors", 1);
error_reporting(E_ALL);

//echo "Hello, world!";

if(isPath("/register")){

	if(isPostMethod("post")){
	require_once __DIR__ . "/routes/register.php";
    die();
	}


}

if(isPath("/login")){

	if(isPostMethod("post")){
	require_once __DIR__ . "/routes/login.php";
    die();
	}


}

if(isPath("/tasks")){

	if(isPostMethod("get")){
	require_once __DIR__ . "/routes/tasks.php";
    die();
	}


}

if(isPath("/tasks")){

	if(isPostMethod("post")){
	require_once __DIR__ . "/routes/addtasks.php";
    die();
	}


}