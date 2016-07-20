<?php
#配置文件
return array(
    'App'=>array(
        'DEFAULT_MODULE'=>'Home',  //默认模块
        'DEFAULT_CONTROLLER'=>'Index',  //默认控制器
        'DEFAULT_ACTION'=>'Index',  //默认操作方法名称
    ),
    'DataBase'=>array(
        'DB_HOST'               =>  '127.0.0.1', // 服务器地址
        'DB_NAME'               =>  'GodKiller',          // 数据库名
        'DB_USER'               =>  'root',      // 用户名
        'DB_PWD'                =>  'root',          // 密码
        'DB_PORT'               =>  '3306',        // 端口
    ),
);