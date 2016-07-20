<?php
namespace GodPHP;
use Smarty;

/**
 * Class Controller  基础控制器类
 * @package GodPHP
 */
class Controller
{
    protected $Smarty;
    public function __Construct()
    {
        $this->Smarty=new Smarty();
        $this->Smarty->setTemplateDir(__View__);
        $this->Smarty->setCompileDir(__Compile__);
    }
}