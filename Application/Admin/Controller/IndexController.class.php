<?php
namespace Admin\Controller;
use Admin\Model\Role\RoleModel;
use GodPHP\Controller;
class IndexController extends Controller{
    function Index(){
        echo "Admin下的Index方法";
    }
    function TestSmarty(){
        $test='Test方法';
        $this->Smarty->assign('test',$test);
        $this->Smarty->display('Index.html');
    }
    function TestModel(){
        $test=new Model();
        $test->Model();
    }
    function QQ(){
        $model=new RoleModel();
        $b=$model->Select();
        var_dump($b);
    }

}