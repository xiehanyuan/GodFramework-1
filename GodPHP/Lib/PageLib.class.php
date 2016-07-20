<?php
class PageLib extends Model
{
    protected $page;
    private $start_page;
    private $pagesize=5;
    protected $zongyeshu;
    private $total;

    function Pagetotal(){
        $table=$this->get_table();
        $sql="select COUNT(*) from $table";
        return $this->db->fetchRow($sql);
    }
    public function PagingStart($page,$pagesize=5)
    {
        $table=$this->get_table();
        $this->total=$this->Pagetotal();
        $this->zongyeshu=ceil($this->total['COUNT(*)']/$pagesize);
        $this->page=$page;
        $this->start_page=($this->page-1)*$this->pagesize;
        $sql="select * from $table limit $this->start_page,$pagesize";
        return $this->db->FetchAll($sql);
    }


}