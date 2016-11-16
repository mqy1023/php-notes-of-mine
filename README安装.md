
## 一、安装Composer
* 1、上官网查看安装命令[Composer官网](https://getcomposer.org/download/)
在terminal终端中输入
```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === 'e115a8dc7871f15d853148a7fbac7da27d6c0030b848d9b3dc09e2a0388afed865e6a3d6b3c0fad45c48e2b5fc1196ae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

* 2、安装后检查
在terminal中输入: `php composer.phar, ` 会出现一堆composer命令

* 3、重命名全局composer.phar
先`mv composer.phar /usr/local/bin/composer`,以后终端输入`composer`相当于使用`composer.phar`

* 4、创建项目
`composer create-project laravel/laravel learnlaravel5`

* 5、启动服务器

进入项目根目录下:
  * 方式a、`php -S localhost:7777 -t public`.
    然后在浏览器中输入`localhost:7777`就能看到默认的'Laravel5'网页
  * 方式b、`php artisan serve`, 启动服务后访问 http://localhost:8000/
