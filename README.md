# smart-php-api
简单的、高效的、mvc结构的、restful路由风格的api框架

# 使用手册

## 一、下载该项目，并将项目添加至一个站点中

`git clone https://github.com/ganganlee/smart-php-api.git`

## 二、为站点添加伪静态，接受所有请求

`
location / {	
	rewrite ^(.*)$ /index.php$1 last;
}
`

## 访问测试
`http://www.host.com`

# 目录结构
![image](https://p.pstatp.com/origin/138cf00007ac64585146b)
https://p.pstatp.com/origin/138cf00007ac64585146b

# 全局方法
详情参考文件：**/app/common/***
