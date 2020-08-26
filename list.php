<?php 

// директивы

/* параметры отладки */
ini_set('display_errors','Off'); 

session_start();

$db = mysqli_connect("localhost", "root", "", "us4mez") or die("Нет соединения с БД");
mysqli_set_charset($db, "utf8") or die("Не установлена кодировка соединения");

function getCountries(){
    global $db;
    $query = "SELECT * FROM marks";
    $res = mysqli_query($db, $query);
    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}

function getCities(){
    global $db;
    $code = mysqli_real_escape_string($db, $_POST['code']);
    $query = "SELECT id, model FROM models WHERE mark_id = '$code'";
    $res = mysqli_query($db, $query);
    $data = '';
    while($row = mysqli_fetch_assoc($res)){
        $data .= "<option value='{$row['id']}'>{$row['model']}</option>";
    }
    return $data;
}

if(!empty($_POST['code'])){
    echo getCities();
    exit;
}

$countries = getCountries();


?>