<?php

/**
 * @param string    $var     要打印的变量
 * @param bool|true $type   是否打印变量类型
 * 说明：该函数属于调试函数,建议不要在线上使用.
 */
function P($var,$type=true){
    echo '<pre>';
    if($type){
     var_dump($var);
    }else{
     print_r($var);
    }
    echo '</pre>';
}

/**
 * @param string $path
 */
function U($path){
    $url='/index.php/'.$path;
    echo $url;
}