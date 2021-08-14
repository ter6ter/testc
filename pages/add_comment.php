<?php
$text = $_REQUEST['text'] ?? '';
if (strlen($text)) {
    $comment = $user->add_comment($text);
    $page = 'comment';
} else {
    $error_message = "Вы не ввели текст комментария";
    $page = 'error';
}