<?php
class SessionLib{
    private $db;
    /*
     *
     */
    public function __Construct()
    {
        session_set_save_handler(
            array($this,'open'),
            array($this,'close'),
            array($this,'read'),
            array($this,'write'),
            array($this,'destroy'),
            array($this,'gc')
        );
    }

    public function open(){
        $this->db=Mysql::InitMysql();
    }
    public function close()
    {
        return true;
    }
    public function read($session_id){
        $sql="select sess_value from sess WHERE id='$session_id'";
        return $this->db->FetchColumns($sql);
    }
    public function write($session_id,$session_value)
    {
        $time=time();
        $sql="insert into sess values('$session_id','$session_value',$time) on duplicate key update sess_value='$session_value'";
        return $this->db->Query($sql);
    }
    public function destroy($session_id){
        $sql="delete from sess WHERE id='$session_id'";
        return $this->db->Query($sql);
    }
    public function gc($maxlifetime){
        $time=time()-$maxlifetime;
        $sql="delete from WHERE expires<$time";
        return $this->db->Query($sql);
    }
}