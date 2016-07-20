<?php
class UploadLib
{
    private $path;
    private $type;
    private $size;
    private $error;
    public function __construct()
    {
        $this->path=$GLOBALS['Config']['Upload']['upload_path'];
        $this->type=$GLOBALS['Config']['Upload']['upload_type'];
        $this->size=$GLOBALS['Config']['Upload']['upload_size'];
    }
    public function Get_error()
    {
       return $this->error;
    }
    public function UploadFile($file)
    {
        $error=$file['error'];
        if($error)
        {
            switch($error)
            {
                case 1:
                    $this->error="�ϴ��ļ���С�����������ļ�����������ֵ";
                    return false;
                case 2:
                    $this->error="�ϴ��ļ���С�����˱���������ֵ";
                    return false;
                case 3:
                    $this->error="�ļ�ֻ�в����ϴ����ļ�û���ϴ�����";
                    return false;
                case 4:
                    $this->error="û���ϴ��ļ�";
                    return false;
                case 6:
                    $this->error="�Ҳ�����ʱ�ļ�";
                    return false;
                case 7:
                    $this->error="�ļ�д��ʧ��";
                    return false;
                default :
                    $this->error="δ֪����";
                    return false;
            }
        }
        if(!in_array($file['type'],$this->type)){
            $this->error="���Ͳ���ȷ";
            return false;
        }
        if($file['size']>$this->size){
            $this->error="��������������ϴ�����";
            return false;
        }
        if(!is_uploaded_file($file['tmp_name'])){
            $this->error="����ͨ��Http�ϴ�";
            return false;
        }
        $folder_name=date('Y-m-d');
        $folder_path=$this->path.ds.$folder_name;
        if(!file_exists($folder_path))
        {
            mkdir($folder_path);
        }
        $file_name=uniqid().$file['name'];
        $file_path=iconv('utf-8','gb2312',$folder_path.ds.$file_name);
        if(move_uploaded_file($file['tmp_name'],$file_path)){
            return "{$folder_name}/{$file_name}";
        }else{
            $this->error='�ϴ�ʧ��';
        }
    }
}