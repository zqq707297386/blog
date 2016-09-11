# Laravel5.2.23 PHP Framework

    git clone 后在根目录下执行 composer install 

    个人把index.php跟.htaccess移动到了跟目录。

    无须指定为public目录下index.php。

    复制.env.example改名为.env 

    在config/database.php下找到mysql。
    把'prefix' ='',改为'prefix' =env('DB_PREFIX', ''),

    数据库前缀DB_PREFIX=可自定义名字 例：test_

    创建数据库（最好与自定义前缀相同）例:test。

	执行数据表迁移命令 php artisan migrate

**执行php artisan key:generate 重新生成key**
	
	找到database/seeds/user.php 在encrypt()中写入密码

	然后php artisan db:seed --class=user （填充后台登录帐号跟密码）
    即可登录后台

    后台访问地址 域名/admin/index  

