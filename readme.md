##  基于[Laravel5.6](https://github.com/laravel/laravel/tree/5.6?_blank "Laravel5.6") 开发发的博客
本博客基于Laravel5.6，所以要求 `PHP>=7.2`
* 克隆源代码到本地：
 ```
    git clone git@github.com:vvk/laravel_blog.git
 ```
* 安装依赖包
 ```
    composer install
 ```
* 生成配置文件
 ```
    cp .env.example .env 
 ```
* 编辑 `.env` 文件里的下面内容为自己的实际配置信息
```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```
* 执行数据库迁移
```
php artisan migrate
```
* 填充初始数据
```
php artisan db:seed
```

至此，博客安装完成
>* 前台地址：`http://example.com`
>* 后台地址：`http://example.com/admin`
>* 账号/密码：`admin/admin`
