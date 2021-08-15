<?php
require_once("includes.php");
session_start();
if (isset($_REQUEST['method'])) {
	$page = $_REQUEST['method'];
} else {
	$page = 'main';
}
$user = null;

$page = preg_replace('/[^a-z0-9_]+/', '', $page);

if (isset($_SESSION['uid'])) {
    $user = User::get($_SESSION['uid']);
}

if ($page == 'login') {
    $login = $_REQUEST['login'] ?? false;
    $password = $_REQUEST['password'] ?? false;
    if (!$login || !$password) {
        $error_message = 'Вы не ввели данные для авторизации';
    } else {
        $user = User::login($login, $password);
        if (!$user) {
            $error_message = 'Неверный логин или пароль';
        }
    }
    $page = 'main';
}
if (!file_exists("pages/{$page}.php")) {
    header('HTTP/1.0 404 not found');
    exit();
}
$page_no_login = ['main', 'login', 'get_comments', 'get_authors'];
if (!$user && !in_array($page, $page_no_login)) {
    $page = 'main';
}
$error = false;
$data = [];
include "pages/{$page}.php";

if (isset($_REQUEST['json'])) {
	if ($error) {
		$response = ['status' => 'error',
			         'error' => $error];
	} else {
		$response = ['status' => 'ok',
			         'data' => $data];
	}
	print json_encode($response);
} else {
    if (file_exists("templ/{$page}.php")) {
        include "templ/{$page}.php";
    } else {
        header('HTTP/1.0 404 not found');
    }
}