#目录结构
* item 
 -├─Application  APP目录
 -│  ├─Admin     Admin目录
 -│  │  ├─Compile  Smarty缓存目录
 -│  │  ├─Controller Admin下的控制器目录
 -│  │  ├─Model      模型目录
 -│  │  └─View       视图目录
 -│  └─Home          Home目录
 -│      └─Controller  Home下的控制器目录
 -├─GodPHP       核心框架类
 -│  │  Controller.class.php
 -│  │  DB.class.php
 -│  │  Functions.php
 -│  │  GodPHP.php
 -│  │  Model.class.php
 -│  │
 -│  ├─Com    公共文件目录
 -│  ├─Conf   配置文件目录
 -│  │      Config.php  配置文件
 -│  │
 -│  └─Lib    扩展库目录
 -│      │  CodeLib.class.php
 -│      │  ImageLib.class.php
 -│      │  PageLib.class.php
 -│      │  SessionLib.class.php
 -│      │  UploadLib.class.php           
 -│      └─Smarty
 -│          ├─plugins
 -│          └─SysPlugins
 -└─Public            资源目录

* item 
#-命名规范
 -类文件都是以.class.php为后缀（这里是指的GodPHP内部使用的类库文件，不代表外部加载的类库文件），使用驼峰法命名，并且首字母大写，例如 DbMysql.class.php； 
 -类的命名空间地址和所在的路径地址一致，例如 Home\Controller\UserController类所在的路径应该是 Application/Home/Controller/UserController.class.php；
 -确保文件的命名和调用大小写一致，是由于在类Unix系统上面，对大小写是敏感的
 -
# -自由
 -免费开源，遵循Apache2开源协议发布
 -没有严格或额外的约束，一切按你的规范、习惯来
 -架构思想来源于众多项目总结，你的需求决定框架结构，无论怎么玩都行
# -安全
 -基于命名空间自动加载类
 -从接收到运行输出，验证、过滤、SQL注入、XSS、CSRF安全预防
