<?php
class GodFramework
{
    /*
     *定义路径常量
     *
     * */
    private static function Const_Method()
    {
        define('DS',DIRECTORY_SEPARATOR);
        define('Root_Path',getcwd().DS);
        define('God_Path',Root_Path.'GodPHP'.DS);
        define('Lib_Path',God_Path.'Lib'.DS);
        define('Tools_Path',Root_Path.'/Tools'.DS);
        define('App_Path',Root_Path.'/Application'.DS);
        define('Controller_Path',App_Path.'/Controller'.DS);
        define('Model_Path',App_Path.'/Model'.DS);
        define('Public_Path',Root_Path.'/Public'.DS);
        define('Conf_Path',Root_Path.'GodPHP/Conf'.DS);
    }
    #初始化Function
    private static function initFunctions(){
        require_once God_Path.'Functions.php';
    }
    private static function InitConfig(){
        $GLOBALS['Config']=require Conf_Path."Config.php";
    }
    /*
     * 定义路由
     */
    private static function InitRoutes()
    {
        $m=isset($_REQUEST['m'])?$_REQUEST['m']:$GLOBALS['Config']['App']['DEFAULT_MODULE'];
        $c=isset($_REQUEST['c'])?$_REQUEST['c']:$GLOBALS['Config']['App']['DEFAULT_CONTROLLER'];
        $a=isset($_REQUEST['a'])?$_REQUEST['a']:$GLOBALS['Config']['App']['DEFAULT_ACTION'];
        define('Module_name',$m);
        define('Controller_name',$c);
        define('Action_name',$a);
        define('__Url__',Controller_Path.Module_name.DS);
        define('__Model__',Model_Path.Module_name.DS);
        define('__View__',App_Path.$m.DS.'View'.DS);
        define('__Compile__',App_Path.$m.DS.'Compile'.DS);
        define('Class_Name','.class.php');
        define('__Controller__',Module_name.DS.'Controller'.DS.Controller_name.'Controller');
    }
    #初始化配置文件

    /*
     * 自动加载
     */
    /**
     * @param $Class_Name
     */
    private static function AutoLoad($Class_Name)
    {
        echo $Class_Name.Class_Name.'<br>';
       if(is_file(Root_Path.$Class_Name.Class_Name)){
           require Root_Path.$Class_Name.Class_Name;
           return;
       }elseif(is_file(App_Path.$Class_Name.Class_Name)){

           require App_Path.$Class_Name.Class_Name;
           return;
       }
        #后期可扩展
        switch($Class_Name)
        {
            case 'Smarty':
                require Lib_Path."Smarty".DS.$Class_Name.Class_Name;
        }
    }
    #注册自动加载类
    private static function RegAutoLoad(){
        spl_autoload_register('self::AutoLoad');
    }
    #定义路由
    private static function RequestDistribute(){

        $Controller_Name=__Controller__;
        $Controller=new $Controller_Name();
        $Action_Name=Action_name;
        $Controller->$Action_Name();
    }

    /*
     * 加载静态方法
     */
    public static function InitRun()
    {
        self::Const_Method();
        self::initFunctions();
        self::InitConfig();
        self::InitRoutes();
        self::RegAutoLoad();
        self::RequestDistribute();
    }
}