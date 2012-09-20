<?php

require_once __DIR__ . '/setup.php';

function get_movies() {
    global $moviedb;
    $sql = $moviedb->select()->from('movieview');
    print_r($sql->query());
}