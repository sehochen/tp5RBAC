![](https://m.qpic.cn/psb?/V129zQEx2JxbGA/WPNJYtg7UbVN8A5*qmU5LONtr47U8QpwMuYGd5MN7FE!/b/dDIBAAAAAAAA&bo=xgBKAAAAAAADB64!&rf=viewer_4) 

ThinkPHP 5.1（LTS版本） —— 12载初心，你值得信赖的PHP框架
===============
## QQ群：484043598


## 安装

1.使用GitHub获取源码

~~~
git clone https://github.com/sehochen/tp5.1RBAC.git
~~~

2.导入sql数据

~~~
public目录下
创建数据库，导入greeting.sql
~~~

3.nginx配置路由隐藏index.php入口文件

~~~
server {
    listen       80;
    server_name  127.0.0.1; 
    root   "E:/phpStudy/PHPTutorial/WWW/Greeting/public";

    index  index.html index.php;

location / { 
    if (!-e $request_filename) {
        rewrite  ^(.*)$  /index.php?s=/$1  last;
        break;
    }
}

    location ~ \.php(.*)$  {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        fastcgi_param  PATH_INFO  $fastcgi_path_info;
        fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
        include        fastcgi_params;
    }

}
~~~

4.访问项目
~~~
127.0.0.1/admin/login/index    ##后台登录接卖弄
~~~

5.后台登录账号
~~~
账号：admin
密码：admin
~~~
## 项目演示：
![Image text](https://m.qpic.cn/psb?/V129zQEx2JxbGA/SusvyoQ0D8iyLBqbty9o9xZ.tdloocLFE2qSjk62JPg!/b/dL8AAAAAAAAA&bo=pQSHAgAAAAADBwY!&rf=viewer_4)

![Image text](http://m.qpic.cn/psb?/V129zQEx2JxbGA/Lb3zkYrZPdk5ubV4qUJ9lxwfYFPRFd3j9weVMIL9DLc!/b/dC0BAAAAAAAA&bo=KQWAAgAAAAADF5w!&rf=viewer_4)

![Image text](https://m.qpic.cn/psb?/V129zQEx2JxbGA/X60546z7sxBtKIjBNw*t3D9avg6z*OE7gsuNqPGvhGI!/b/dL8AAAAAAAAA&bo=*wRUAgAAAAADB48!&rf=viewer_4)
![Image text](http://m.qpic.cn/psb?/V129zQEx2JxbGA/IPpNz2nhA*lFSkjIjspKSuLtkUd7C4BQTuj3VDYsGcg!/b/dL8AAAAAAAAA&bo=AwVOAgAAAAADF3g!&rf=viewer_4)

## 目录结构

初始的目录结构如下：

~~~
www  WEB部署目录（或者子目录）
├─application           应用目录
│  ├─common             公共模块目录（可以更改）
│  ├─module_name        模块目录
│  │  ├─common.php      模块函数文件
│  │  ├─controller      控制器目录
│  │  ├─model           模型目录
│  │  ├─view            视图目录
│  │  └─ ...            更多类库目录
│  │
│  ├─command.php        命令行定义文件
│  ├─common.php         公共函数文件
│  └─tags.php           应用行为扩展定义文件
│
├─config                应用配置目录
│  ├─module_name        模块配置目录
│  │  ├─database.php    数据库配置
│  │  ├─cache           缓存配置
│  │  └─ ...            
│  │
│  ├─app.php            应用配置
│  ├─cache.php          缓存配置
│  ├─cookie.php         Cookie配置
│  ├─database.php       数据库配置
│  ├─log.php            日志配置
│  ├─session.php        Session配置
│  ├─template.php       模板引擎配置
│  └─trace.php          Trace配置
│
├─route                 路由定义目录
│  ├─route.php          路由定义
│  └─...                更多
│
├─public                WEB目录（对外访问目录）
│  ├─index.php          入口文件
│  ├─router.php         快速测试文件
│  └─.htaccess          用于apache的重写
│
├─thinkphp              框架系统目录
│  ├─lang               语言文件目录
│  ├─library            框架类库目录
│  │  ├─think           Think类库包目录
│  │  └─traits          系统Trait目录
│  │
│  ├─tpl                系统模板目录
│  ├─base.php           基础定义文件
│  ├─console.php        控制台入口文件
│  ├─convention.php     框架惯例配置文件
│  ├─helper.php         助手函数文件
│  ├─phpunit.xml        phpunit配置文件
│  └─start.php          框架入口文件
│
├─extend                扩展类库目录
├─runtime               应用的运行时目录（可写，可定制）
├─vendor                第三方类库目录（Composer依赖库）
├─build.php             自动生成定义文件（参考）
├─composer.json         composer 定义文件
├─LICENSE.txt           授权说明文件
├─README.md             README 文件
├─think                 命令行入口文件
~~~

> 可以使用php自带webserver快速测试
> 切换到根目录后，启动命令：php think run

## 命名规范

`ThinkPHP5`遵循PSR-2命名规范和PSR-4自动加载规范，并且注意如下规范：

### 目录和文件

*   目录不强制规范，驼峰和小写+下划线模式均支持；
*   类库、函数文件统一以`.php`为后缀；
*   类的文件名均以命名空间定义，并且命名空间的路径和类库文件所在路径一致；
*   类名和类文件名保持一致，统一采用驼峰法命名（首字母大写）；

### 函数和类、属性命名

*   类的命名采用驼峰法，并且首字母大写，例如 `User`、`UserType`，默认不需要添加后缀，例如`UserController`应该直接命名为`User`；
*   函数的命名使用小写字母和下划线（小写字母开头）的方式，例如 `get_client_ip`；
*   方法的命名使用驼峰法，并且首字母小写，例如 `getUserName`；
*   属性的命名使用驼峰法，并且首字母小写，例如 `tableName`、`instance`；
*   以双下划线“__”打头的函数或方法作为魔法方法，例如 `__call` 和 `__autoload`；

### 常量和配置

*   常量以大写字母和下划线命名，例如 `APP_PATH`和 `THINK_PATH`；
*   配置参数以小写字母和下划线命名，例如 `url_route_on` 和`url_convert`；

### 数据表和字段

*   数据表和字段采用小写加下划线方式命名，并注意字段名不要以下划线开头，例如 `think_user` 表和 `user_name`字段，不建议使用驼峰和中文作为数据表字段命名。




