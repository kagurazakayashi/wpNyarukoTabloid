![wpNyarukoTabloid](https://raw.githubusercontent.com/kagurazakayashi/wpNyarukoTabloid/master/img/wpNyaruko.gif)  Tabloid 0.1

[介绍](#功能) | [功能](#功能) | [安装](#安装步骤) | [截图](#截图) | [兼容性](#兼容性) | [第三方](#使用的第三方软件) | [License](#许可协议-license)

- 警告：目前尚未开发完成，请勿使用。

## 介绍
- wpNyaruko 系列成员之一，一款可以为 WordPress 文章提供大图样式的插件， wpNyaruko-F 主题无缝集成。
  - 此分支虽然提供了很多自定义设置，但仍然主要是以定制网站开发的，因此不保证在其他网站上可以正确运行。
  - 目前尚未开发完成。
  - 这是 [yaNyaruko Project](https://github.com/kagurazakayashi) 项目的一部分。

## 功能
- 直接在文章中按照格式加入代码即可创建。
- 兼容电脑和手机浏览。
- 支持页码显示。
- 左右翻页按钮可以设置为跟随网页垂直居中还是跟随图片垂直居中。
- 可以用 触屏手势、方向键、空格回车、wsad键、鼠标滚轮，以及数字键来控制翻页。
  - 鼠标滚轮满速滚动为滚动图片（图片溢出浏览区域情况下），快速滚动为翻页。
- 可以为网站原有的固定顶栏留出空间。

## 安装步骤

1. 准备一个安装好的 WordPress 站点，并将本项目克隆到插件文件夹，启用插件。
2. 新建文章或页面（可直接使用可视化模式编辑）。
3. 输入 `[nyarukotabloid]` 并换行。
4. 插入图片并换行，输入对应的文字并换行。
5. 重复上一步直到输入所有图片和文字（一行图片一行文字）。
6. 输入 `[/nyarukotabloid]` 结束。

下面是一份示例：

```
[nyarukotabloid]

<img src="/1.jpg" />

这是 图片1 对应的文字。

<img src="/2.jpg" />

这是 图片2 对应的文字。

<img src="/3.jpg" />

这是 图片3 对应的文字。

<img src="/4.jpg" />

这是 图片4 对应的文字。

<img src="/5.jpg" />

这是 图片5 对应的文字。

[/nyarukotabloid]
```

## 截图

![电脑版](https://raw.githubusercontent.com/kagurazakayashi/wpNyarukoTabloid/master/screenshots/1.jpg)

![手机版](https://raw.githubusercontent.com/kagurazakayashi/wpNyarukoTabloid/master/screenshots/2.jpg)

## 兼容性

- 建议使用 WordPress 4.9.x ，4.9.4 是该插件的开发环境。
- 欢迎使用最新版 Chrome 浏览器，以及 PHP7 。这是该插件的开发环境。
- 支持其他带有最新版 webkit 内核浏览器。
- 可以适配最新版 Firefox 浏览器。
- 欢迎使用最新版 iOS 里的 Safari ，这是该主题的开发环境。
- Android 请使用最新版 Chrome 浏览器。
- 要正常使用，浏览器必须开启 JavaScript 。
- 要保存浏览器令牌和游客保存用户名邮箱等信息，浏览器需要开启 Cookie 。

## 使用的第三方软件

- [jquery](https://github.com/jquery) / [jQuery](https://github.com/jquery/jquery)

## 许可协议 License

MIT License.