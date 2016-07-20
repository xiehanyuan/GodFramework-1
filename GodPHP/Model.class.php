<?php
namespace GodPHP;
class Model{
    protected $db;

    public function __construct()
    {
         $this->initMysql();
    }

    public function initMysql(){
       $this->db=DB::InitMysql();
    }
    public function get_table(){
       $array=explode('\\',get_class($this));
       return substr($array[3],0,-5);
    }
    public function get_Pri($table){
        $rs=$this->db->Query("desc `$table`");
        while($rows=mysqli_fetch_assoc($rs)){
            if($rows['Key']=='PRI'){
                return $rows['Field'];
            }
        }

    }
    public function Insert($data)
    {
        $table=$this->get_table();
        $fileds=array_keys($data);
        $values=array_values($data);
        $fileds=array_map(function($filed){
            return "`$filed`";
        },$fileds);
        $values=array_map(function($value){
            $value=htmlspecialchars($value);
            return "'$value'";
        },$values);
        $fileds_str=implode(',',$fileds);
        $values_str=implode(',',$values);
        $sql="insert into `$table` ($fileds_str) values ($values_str)";
        if($this->db->Query($sql)){
            return mysqli_insert_id($this->db->link);
        }
        return false;
    }
    public function Select($order_by='asc',$fileds=''){
        $table=$this->get_table();
        $sql="select * from $table";
        if($fileds!=''){
            $sql.="Order by $fileds $order_by";
        }
        return $this->db->FetchAll($sql);
    }
    public function Update($data){
        $table=$this->get_table();
        $pri=$this->get_Pri($table);
        $fileds=array_keys($data);
        $index=array_search($pri,$fileds);
        unset($fileds[$index]);
        $fileds=array_map(function($filed) use ($data){
            $data[$filed]=htmlspecialchars($data[$filed]);
            return "`$filed`='$data[$filed]'";
        },$fileds);
        $fileds_str=implode(',',$fileds);
        $sql="update `$table` set $fileds_str WHERE $pri=$data[$pri]";
        return $this->db->Query($sql);
    }
    public function Del($id){
        $table=$this->get_table();
        $pri=$this->get_Pri($table);
        $sql="delete from `$table` WHERE $pri=$id";
        return $this->db->Query($sql);
    }

    public function Find($id){
        $table=$this->get_table();
        $pri=$this->get_Pri($table);
        $sql="select * from `$table` WHERE $pri=$id";
        return $this->db->FetchRow($sql);
    }
    public function beginTransaction(){
        $this->db->Query('begin');
    }
    public function rollback(){
        $this->db->Query('rollback');
    }
    public function commit(){
        $this->db->Query('commit');
    }
    public function realString($value){
        $rs=array();
        foreach ($value as $key => $rows)
        {
            $rs[mysqli_real_escape_string($this->db->link,$key)]=mysqli_real_escape_string($this->db->link,$rows);
        }
        return $rs;
    }
    public function realSql($value){
        return mysqli_real_escape_string($this->db->link,$value);
    }
}