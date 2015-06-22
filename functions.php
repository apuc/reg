<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 10.06.2015
 * Time: 16:25
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