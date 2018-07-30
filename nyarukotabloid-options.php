<?php

function nyarukotabloidGetOptions() {
    $wpNyarukoTabloidOption = get_option('nyarukoTabloidOptions');
    if (!is_array($wpNyarukoTabloidOption)) {
        $wpNyarukoTabloidOption['wpNyarukoTabloidTest'] = '此处可以任意填写一些笔记';
        $wpNyarukoTabloidOption['wpNyarukoTabloidPageturnBtn'] = 'on';
        $wpNyarukoTabloidOption['wpNyarukoTabloidPageNumI'] = '0';
        $wpNyarukoTabloidOption['wpNyarukoTabloidPageNumO'] = '10';
        $wpNyarukoTabloidOption['wpNyarukoTabloidPageNumT'] = '20';
        $wpNyarukoTabloidOption['wpNyarukoTabloidPageNumFontSize'] = '12';
        $wpNyarukoTabloidOption['wpNyarukoTabloidPageNumIColor'] = '4800FD';
        $wpNyarukoTabloidOption['wpNyarukoTabloidMarginT'] = '0';
        $wpNyarukoTabloidOption['wpNyarukoTabloidMarginB'] = '0';
        $wpNyarukoTabloidOption['wpNyarukoTabloidMarginL'] = '0';
        $wpNyarukoTabloidOption['wpNyarukoTabloidMarginR'] = '0';
    }
	return $wpNyarukoTabloidOption;
}

function nyarukotabloidOptionsInit() {
    if (is_admin()) {
        if(isset($_GET['reset'])) {
            delete_option('nyarukoTabloidOptions');
        }
        //保存设置
        if(isset($_POST['nyarukoTabloidOptions'])) {
            $wpNyarukoTabloidOption = nyarukotabloidGetOptions();
            $wpNyarukoTabloidOptions = ['wpNyarukoTabloidTest','wpNyarukoTabloidPageturnBtn','wpNyarukoTabloidPageNumI','wpNyarukoTabloidPageNumO','wpNyarukoTabloidPageNumT','wpNyarukoTabloidPageNumFontSize','wpNyarukoTabloidPageNumIColor','wpNyarukoTabloidMarginT','wpNyarukoTabloidMarginB','wpNyarukoTabloidMarginL','wpNyarukoTabloidMarginR'];
            foreach ($wpNyarukoTabloidOptions as $value) {
                $wpNyarukoTabloidOption[$value] = stripslashes($_POST[$value]);
            }
            update_option('nyarukoTabloidOptions', $wpNyarukoTabloidOption);
        } else {
            nyarukotabloidGetOptions();
        }
    }
    add_theme_page('wpNyaruko Tabloid Options','wpNyaruko 图册选项', 'edit_themes', basename(__FILE__),  'nyarukotabloidOptionsDisplay');
}
function nyarukotabloidOptionsDisplay() {
    ?>
    <div id="optionbg2" class="optionfull"></div>
    <div id="optionbox">
    <?php 
    if(isset($_POST['nyarukoTabloidOptions'])) {
        echo '<div id="wpNyarukoInfo">已受理您的变更。</div>';
    }
    ?>
    <div id="wpNyarukoOptionTitle"><a title="版本升级日志" class="link" href="https://github.com/kagurazakayashi/wpNyarukoTabloid/commits/master" target="_blank"><div id="wpNyarukoPanelLogo"></div></a>&nbsp;图册（版本&nbsp;<?php include "version.php"; ?>）</div><hr>
    <?php
    if(!is_admin()) {
        echo '<p>欢迎使用 wpNyarukoTabloid，<br/>请使用管理员权限登录来继续设置。</p><hr><p>';
    } else {
        $wpNyarukoTabloidOption = nyarukotabloidGetOptions();
    //修改设置
    ?>
    <form action="#" method="post" enctype="multipart/form-data" name="op_form" id="op_form">
    <table border="0" cellspacing="0" cellpadding="10">
    <tbody>
    <tr>
        <td>笔记(不呈现)</td>
        <td><input name="wpNyarukoTabloidTest" type="text" id="wpNyarukoTabloidTest" value="<?php echo(@$wpNyarukoTabloidOption['wpNyarukoTabloidTest']); ?>" size=64 maxlength=128 /></td>
    </tr>
    <tr>
        <td>左右翻页按钮样式</td>
        <td><input name="wpNyarukoTabloidPageturnBtn" type="checkbox" id="wpNyarukoTabloidPageturnBtn" <?php if(@$wpNyarukoTabloidOption['wpNyarukoTabloidPageturnBtn']!='')echo('checked'); ?> />嵌入到图片层（以图片高度垂直居中，否则以整体高度）</td>
    </tr>
    <tr>
        <td>页码下沉样式设置</td>
        <td>当前页<input name="wpNyarukoTabloidPageNumI" type="text" id="wpNyarukoTabloidPageNumI" value="<?php echo(@$wpNyarukoTabloidOption['wpNyarukoTabloidPageNumI']); ?>" size="2" maxlength="2" />像素，斜线<input name="wpNyarukoTabloidPageNumO" type="text" id="wpNyarukoTabloidPageNumO" value="<?php echo(@$wpNyarukoTabloidOption['wpNyarukoTabloidPageNumO']); ?>" size="2" maxlength="2" />像素，总页数<input name="wpNyarukoTabloidPageNumT" type="text" id="wpNyarukoTabloidPageNumT" value="<?php echo(@$wpNyarukoTabloidOption['wpNyarukoTabloidPageNumT']); ?>" size="2" maxlength="2" />像素</td>
    </tr>
    <tr>
        <td>页码字体设置</td>
        <td>页码字体大小：<input name="wpNyarukoTabloidPageNumFontSize" type="text" id="wpNyarukoTabloidPageNumFontSize" value="<?php echo(@$wpNyarukoTabloidOption['wpNyarukoTabloidPageNumFontSize']); ?>" size="2" maxlength="2" />pt<br/>当前页数字颜色：#<input name="wpNyarukoTabloidPageNumIColor" id="wpNyarukoTabloidPageNumIColor" class="chcolor" type="text" value="<?php echo(@$wpNyarukoTabloidOption['wpNyarukoTabloidPageNumIColor']); ?>" size=6 maxlength=6 alt="当前页数字颜色" /></td>
    </tr>
    <tr>
        <td>翻页方式</td>
        <td><input type="checkbox" checked disabled />使用左右翻页按钮翻页<br/>
        <input type="checkbox" checked disabled />使用触摸屏 左划/右划 手势翻页<br/>
        <input type="checkbox" checked disabled />使用键盘 上下左右箭头键 翻页<br/>
        <input type="checkbox" checked disabled />使用键盘 w/s/a/d 键翻页<br/>
        <input type="checkbox" checked disabled />使用空格翻到下一页<br/>
        <input type="checkbox" checked disabled />使用回车翻到下一页<br/>
        <input type="checkbox" checked disabled />使用键盘数字键 1-0 直接翻到相应页码（0视为第10页）</td>
    </tr>
    <tr>
        <td>为页面原有元素<br/>留出空间</td>
        <td>上方留<input name="wpNyarukoTabloidMarginT" type="text" id="wpNyarukoTabloidMarginT" value="<?php echo(@$wpNyarukoTabloidOption['wpNyarukoTabloidMarginT']); ?>" size="3" maxlength="3" />像素，下方留<input name="wpNyarukoTabloidMarginB" type="text" id="wpNyarukoTabloidMarginB" value="<?php echo(@$wpNyarukoTabloidOption['wpNyarukoTabloidMarginB']); ?>" size="3" maxlength="3" />像素；<br/>左边留<input name="wpNyarukoTabloidMarginL" type="text" id="wpNyarukoTabloidMarginL" value="<?php echo(@$wpNyarukoTabloidOption['wpNyarukoTabloidMarginL']); ?>" size="3" maxlength="3" />像素，右边留<input name="wpNyarukoTabloidMarginR" type="text" id="wpNyarukoTabloidMarginR" value="<?php echo(@$wpNyarukoTabloidOption['wpNyarukoTabloidMarginR']); ?>" size="3" maxlength="3" />像素。</td>
    </tr>
    </tbody>
    </table>
    <hr>
    <p><input id="submitoption" type="submit" name="nyarukoTabloidOptions" value="应用这些设定" />&emsp;<a href="themes.php?page=nyarukotabloid-options.php&reset">恢复初始设定</a>&emsp;<?php } 
    //echo '<a title="开源是一种态度" target="_blank" href="https://github.com/kagurazakayashi/wpNyarukoTabloid" target="_blank">Github</a>';
    ?>
    </p></form><p><br/></p>
    </div>
    <?php
}
add_action('admin_menu', 'nyarukotabloidOptionsInit');
?>