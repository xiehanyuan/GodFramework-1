<?php

class CodeLib{
    private $length;
    private $font;

    public function __Construct($length=4,$font=5){
        $this->length=$length;
        $this->font=$font;
    }
    private function YzmArray(){
        $Arr=array_merge(range('A','Z'),range('a','z'),range(0,9));
        $index=array_rand($Arr,$this->length);
        shuffle($index);
        $str='';
        foreach ($index as $v) {
            $str.=$Arr[$v];
        }
        return $str;
    }

    public function ScYzm(){
        $str=$this->YzmArray();
        $_SESSION['Code']=$str;
        $path=captcha_path.'\captcha_bg'.rand(1,5).'.jpg';
        $image=imagecreatefromjpeg($path);
        $color=imagecolorallocate($image,0,0,0);
        if(rand(1,2)==2)
            $color=imagecolorallocate($image,255,255,255);
        $x=(imagesx($image)-imagefontwidth($this->font)*strlen($str))/2;
        $y=(imagesy($image)-imagefontheight($this->font))/2;
        imagestring($image,$this->font,$x,$y,$str,$color);
        header('content-type:image/jpeg');
        ob_clean();
        imagejpeg($image);
        imagejpeg($image);
    }
    public function checkCode($code){
        return strtolower($code)==strtolower($_SESSION['Code']);
    }
}


