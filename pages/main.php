<?php
$comments = Comment::load();
$comments_count = Comment::count();
$comments_slider = Comment::load(0, 5, 'RAND()');