<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once __DIR__ . '/setup.php';

use \Zend\Db\Sql\Sql;

function get_movies($filters) {
    global $moviedb;
    $limit = 20;
    $sql = new Sql($moviedb);
    $select = $sql->select()->from('movieview');
    if($filters['name']) {
        $select->where('c00 LIKE "%'.addslashes($filters['name']).'%"');
    }
    if($filters['genre']>0) {
        $select->join('genrelinkmovie', 'movieview.idMovie=genrelinkmovie.idMovie')->where(array('genrelinkmovie.idGenre=?'=> (int)$filters['genre']))->group('idMovie');
    }
    if($filters['name']) {
        $select->where('c00 LIKE "%'.addslashes($filters['name']).'%"');
    }
    $select->limit($limit);
    //echo $select->getSqlString();
    $statement = $sql->prepareStatementForSqlObject($select);
    $results = $statement->execute();
    return $results;
}

function get_texture_lookup() {
    global $texturedb;
    $sql = new Sql($texturedb);
    $select = $sql->select()->from('texture',['url', 'cachedurl']);
    $statement = $sql->prepareStatementForSqlObject($select);
    $results = $statement->execute();
    $lu = [];
    foreach($results as $row) {
        $lu[$row['url']] = $row['cachedurl'];
    }
    return $lu;
}

$res = [];
$filters = [];
if($_REQUEST['name']) {
    $filters['name'] = $_REQUEST['name'];
}
if($_REQUEST['genre']) {
    $filters['genre']=(int)$_REQUEST['genre'];
}

$movies = get_movies($filters);
$textures = get_texture_lookup();
foreach($movies as $m) {
    //print_r($m);
    $thumbs = simplexml_load_string('<items>'.$m['c08'].'</items>');
    $url = (string)$thumbs->thumb[0];
    $lthumb = array_key_exists($url, $textures) ? $textures[$url] : null;
    $res[] = ['id' => $m['idMovie'], 'name' => $m['c00'], 'thumb' => $lthumb];
}

echo json_encode($res);