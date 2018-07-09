<?php
/**
 * @package wpNyarukoTabloid
 * @version 0.1
 */
/*
Plugin Name: wpNyarukoTabloid
Plugin URI: https://github.com/kagurazakayashi/wpNyarukoTabloid
Description: wpNyaruko 图册插件
Version: 0.1
Author: 神楽坂雅詩
Author URI: https://github.com/kagurazakayashi
Text Domain: wpNyarukoTabloid
*/
define("NYARUKOTABLOID_PLUGIN_URL", plugin_dir_url( __FILE__ ));
define("NYARUKOTABLOID_FULL_DIR", plugin_dir_path( __FILE__ ));
define("NYARUKOTABLOID_TEXT_DOMAIN", "nyarukotabloid");
define("NYARUKOTABLOID_RANDOM_CHAR", "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz");
function nyarukoTabloidShortcode($attr, $content) {
    echo "<script>var wpNyarukoNotFormat = true;</script>";
    $lines = explode("\n", $content);
    //$imgpreg = "/<img (.*?) src=\"(.+?)\".*? >/";
    $imgpreg = "/!\[.*\]\((.+)\)/";
    for($i = 0; $i < count($lines); $i++){
        $line = $lines[$i];
        $img = array();
        $text = "";
        preg_match($imgpreg,$line,$img);
        if(!empty($img) || count($img) >= 2){
            $text = $img[1]; //取图片
        } else {
            $text = strip_tags($line); //取文本
        }
        if (!empty($text) && strlen($text) > 1) echo '<p>'.$i.'|'.$text.'|</p>';
    }
}
add_shortcode('nyarukotabloid', 'NyarukoTabloidShortcode');