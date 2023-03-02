<?php
ini_set('display_errors', 1);
session_start();

if (!empty($_POST['Register'])) {
    require_once('authenticate_class.php');
    $DB = new Authenticate();
    //set variables
    $username = trim(strip_tags($_POST['username']));
    $password = trim(strip_tags($_POST['pw']));
    $first_name = trim(strip_tags($_POST['name']));
    $last_name = trim(strip_tags($_POST['surname']));
    $birthyear = trim(strip_tags($_POST['birthyear']));
    $email = trim(strip_tags($_POST['email']));

    // test for null/empty inputs, which can't exist
    $FormData = array($username, $password, $first_name, $last_name, $birthyear, $email);
    // Test for empty inputs
    if ($DB->IsEmpty($FormData)) {
        // exception
        http_response_code(400);
        die();
    }

    $DB->type = 'CreateUser';
    $DB->param = $FormData;

    if ($DB->Insert()) {
        http_response_code(200);
        die();
    } else {
        http_response_code(500);
        die();
    }
} else if (!empty($_POST['Login']) && isset($_POST['email'], $_POST['pw'])) {
    require_once('authenticate_class.php');
    $DB = new Authenticate();
    $email = trim(strip_tags($_POST['email']));
    $password = trim(strip_tags($_POST['pw']));
    $FormData = array($email, $password);
    // Test for empty inputs
    if ($DB->IsEmpty($FormData)) {
        // exception
        http_response_code(400);
        die();
    }
    $DB->type = 'LoginUser';
	$DB->param = $FormData;
    $result = $DB->Fetch();
    if ($result && count($result) == 1) {
        $_SESSION['username'] = $result[0]["username"];
        $_SESSION['user_id'] = $result[0]["ID"];
        echo json_encode(array("login"=>"success"));
    } else {
		http_response_code(500);
		die();
	}
} else if (!empty($_POST['Comment'])) {
    require_once('authenticate_class.php');
    $DB = new Authenticate();
    $commentText = trim(strip_tags($_POST['commentText']));
    $bookId = trim(strip_tags($_POST['bookId']));
    $userId = trim(strip_tags($_POST['userId']));
    $FormData = array($userId, $bookId, $commentText);
    // Test for empty inputs
    if ($DB->IsEmpty($FormData)) {
        // exception
        http_response_code(400);
        die();
    }
    $DB->type = 'PostComment';
    $DB->param = $FormData;

    if ($DB->Insert()) {
        http_response_code(200);
        die();

    } else {
        http_response_code(500);
        die();
    }
}