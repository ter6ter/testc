<?php
$start = $_REQUEST['start'] ?? false;
$variants = [];
if ($start && mb_strlen($start) > 2) {
    $variants = User::get_variants($start);
}
$data['variants'] = $variants;