<?php
namespace GodPHP;
class DB
{
    private $host;
    private $user;
    private $pass;
    private $db_name;
    public $link;
    private static $Mysql_Init;  //私有属性

    /*
     *
	 *  防止实例化
     */
    private function __construct()
    {
        $this->host=$GLOBALS['Config']['DataBase']['DB_HOST'];
        $this->user=$GLOBALS['Config']['DataBase']['DB_USER'];
        $this->pass=$GLOBALS['Config']['DataBase']['DB_PWD'];
        $this->db_name=$GLOBALS['Config']['DataBase']['DB_NAME'];
        $this->link=mysqli_connect($this->host,$this->user,$this->pass,$this->db_name);
    }
    /*
     *  防止克隆
     */
    private function __clone()
    {

    }
    /*
     *
     */
    public static function InitMysql()
    {
        if(!(self::$Mysql_Init instanceof Mysql)){
            return self::$Mysql_Init=new DB();
        }
        return self::$Mysql_Init;
    }

    /*
     * @param $sql
     * @return bool|mysqli_result
     */
    public function Query($sql)
    {
        if($link=mysqli_query($this->link,$sql))
        {
            return $link;
        }else{
            echo 'SQL语句出错<br>';
            echo 'Sql编号'.mysql_errno(),'<br>';
            echo 'Sql文本错误信息'.mysql_error(),'<br>';
            echo 'Sql语句',$sql,'<br>';
            exit;
        }


    }

    /*
    * @param $sql   //Sql
    * @param string $type
    */
    public function FetchAll($sql,$type='assoc')
    {
        $rs=$this->Query($sql);
        $types=array('assoc','array','row');
        $rs_arr=array();  //数据数组
        if(!in_array($type,$types)){
            $type='assoc';
        }
        $fun_type='mysqli_fetch_'.$type;
        while($row=$fun_type($rs)){
            $rs_arr[]=$row;
        }
        return $rs_arr;
    }

    /*
     * @param $sql
     * @param string $type
     */
    public function FetchRow($sql,$type='assoc'){
        $rs=$this->FetchAll($sql,$type);
        return empty($rs)?null:$rs[0];
    }

    /*
     * @param $sql
     * @return null
     */
    public function FetchColumns($sql)
    {
        $rs=$this->FetchRow($sql,'row');
        return empty($rs)?null:$rs[0];
    }
}