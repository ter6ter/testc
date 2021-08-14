<?php
$start = $_REQUEST['start'] ?? 0;
$comments = Comment::load($start);
$comments_count = Comment::count();