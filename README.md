# smart-php-api
简单的、高效的、mvc结构的、restful路由风格的api框架
# 使用手册
## 下载该项目
<code>

</code>
## 添加伪静态
<code>
location / {	
	rewrite ^(.*)$ /index.php$1 last;
}
</code>
