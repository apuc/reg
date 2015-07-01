<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 10.06.2015
 * Time: 16:25
 */
/*
 test
 */
function gen_pass($max = 10){
    $chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";

    $size=StrLen($chars)-1;

    $password=null;

    while($max--){
        $password.=$chars[rand(0,$size)];
    }

    return $password;
}

function prn_reg($content) {
    echo '<pre style="background: lightgray; border: 1px solid black; padding: 2px">';
    print_r ( $content );
    echo '</pre>';
}

//аякс экшн
add_action('wp_ajax_region', 'get_region');
add_action('wp_ajax_nopriv_region', 'get_region');
//получение регионов
function get_region(){
    global $wpdb;
    $sql = "SELECT `name` FROM `region` WHERE id_country=1";
    $result = $wpdb->get_results($sql,ARRAY_A);
    
    $data = array();

    foreach ($result as $region) {
        $data[] = $region['name'];
    }
    //prn_reg($data);
    $data = json_encode($data);
    echo $data;
    die();
}
//аякс экшн города
add_action('wp_ajax_city', 'get_city');
add_action('wp_ajax_nopriv_city', 'get_city');
//получение городов
function get_city(){
    global $wpdb;
    $region = $_POST['region'];

    $sql_region = "SELECT 'id_region' FROM `region` WHERE name LIKE '$region'";
    $result_region = $wpdb->get_results($sql_region,ARRAY_A);

    $sql = "SELECT `name` FROM `city` WHERE id_region=".$result_region[0]['id_region'];
    $result = $wpdb->get_results($sql,ARRAY_A);

    $data = array();

    foreach ($result as $city) {
        $data[] = $city['name'];
    }

    $data= json_encode($data);
    echo $data;
    die();
}

function get_tree($par_id, $first = 1){
    global $wpdb;
    $q = "SELECT * FROM `class_okved` WHERE `parent_id` = $par_id";
    $res = $wpdb->get_results($q);
    if($first == 1){
        echo '<ul class="parent-ul">';
    }
    else {
        echo '<ul class="child-ul">';
    }
    foreach($res as $row){
        if(is_child($row->id)){
            echo  '<li><a href="#" class="parent-link">'.$row->name.'</a></li>';
        }
        else {
            echo  '<li><a href="#" style="color:GREEN;" class="no-child">'.$row->name.'</a></li>';
        }
        get_tree($row->id, 2);
    }
    echo  '</ul>';
}

function get_all_parent_id(){
    global $wpdb;
    $q = "SELECT *  FROM `class_okved` WHERE `parent_id` IS NULL";
    $res = $wpdb->get_results($q);
    foreach($res as $v){
        $arr[] = $v->id;
    }
    return $arr;
}

function is_child($id){
    global $wpdb;
    $q = "SELECT *  FROM `class_okved` WHERE `parent_id` = $id";
    $res = $wpdb->get_results($q);
    if(empty($res)){
        return false;
    }
    else {
        return true;
    }
}