<?php

error_reporting(E_ALL & ~E_NOTICE);
require_once __DIR__ . '/setup.php';

use \Zend\Db\Sql\Sql;

function get_genres() {
    global $moviedb;
    $sql = new Sql($moviedb);
    $select = $sql->select()->from('genre');
    $statement = $sql->prepareStatementForSqlObject($select);
    $results = $statement->execute();
    return $results;
}

function get_countries() {
    global $moviedb;
    $sql = new Sql($moviedb);
    $select = $sql->select()->columns(['name' => 'c21'])->from('movie')->group('c21');
    echo $select->getSqlString();
    $statement = $sql->prepareStatementForSqlObject($select);
    $results = $statement->execute();
    //print_r($results);
    return $results;
}