<?php
class ImageLib
{
    private $error;
    public function Error(){
        return $this->error;
    }
    function thumb($src_path,$max_w,$max_h,$prefix='s_',$flag=false)
    {

        echo $src_path;
        $ext=strtolower(strrchr($src_path,'.'));
        echo $ext;
        switch($ext){
            case '.jpg':
               $type='jpeg';
                break;
            case '.png':
                $type='png';
                break;
            case '.gif':
                $type='gif';
                break;
            default:
                $this->error='�ļ���ʽ����ȷ';
                return false;
        }
        $fun_image='imagecreatefrom'.$type;
        $src=$fun_image($src_path);
        $dst=imagecreatetruecolor($max_w,$max_h);
        $src_w=imagesx($src);
        $src_h=imagesy($src);
        if($flag){
            if($max_w/$max_h<$src_w/$src_h){
                $dst_w=$max_w;
                $dst_h=$max_w*$src_h/$src_w;
            }else {
                $dst_h=$max_h;
                $dst_w=$max_h*$src_w/$src_h;
            }

            $dst_x=(int)(($max_w-$dst_w)/2);
            $dst_y=(int)(($max_h-$dst_h)/2);
        }else{
            $dst_x=0;
            $dst_y=0;
            $dst_w=$max_w;
            $dst_h=$max_h;
        }


        imagecopyresampled($dst,$src,$dst_x,$dst_y,0,0,$dst_w,$dst_h,$src_w,$src_h);
        $filename=basename($src_path);
        $foldername=substr(dirname($src_path),-10);
        $thumb_path=$GLOBALS['Config']['Upload']['upload_path'].$foldername.'\\'.$prefix.$filename;
        imagepng($dst,$thumb_path);
        imagedestroy($dst);
        imagedestroy($src);
        return $foldername.'/'.$prefix.$filename;
    }




}


