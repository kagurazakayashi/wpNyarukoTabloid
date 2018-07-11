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
define("NYARUKOTABLOID_ITEMC", "wpNyarukoTabloidItem");
define("NYARUKOTABLOID_RANDOM_CHAR", "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz");
function nyarukoTabloidShortcode($attr, $content) {
    $html = "<script>var wpNyarukoNotFormat = true;</script>";
    $lines = explode("\n", $content);
    //$imgpreg = "/<img (.*?) src=\"(.+?)\".*? >/";
    $imgpreg = "/!\[.*\]\((.+)\)/";
    $nowimg = "";
    $nowtxt = "";
    $total = count($lines);
    $items = array();
    // $j = 1;
    for($i = 1; $i < $total; $i++){
        $line = $lines[$i];
        $img = array();
        $text = "";
        $isimage = false;
        preg_match($imgpreg,$line,$img);
        if(!empty($img) || count($img) >= 2){
            $text = $img[1]; //取图片
            $isimage = true;
        } else {
            $text = strip_tags($line); //取文本
        }
        if (!empty($text) && $text != "") {
            if ($isimage) {
                $nowimg = $text;
            } else {
                $nowtxt = $text;
            }
            if ($nowimg != "" && $nowtxt != "") {
                array_push($items,array($nowimg,$nowtxt));
                $nowimg = "";
                $nowtxt = "";
            }
        }
    }
    $total = count($items);
    $html .= '<div class="wpNyarukoTabloid" id="wpNyarukoTabloid'.time().rand(10000,60000).'">';
    for($j = 1; $j < $total; $j++){
        $nowitem = $items[$j];
        $nowimg = $nowitem[0];
        $nowtxt = $nowitem[1];
        $html .= gTxtImgHtml($j,$total-1,$nowimg,$nowtxt);
    }
    $html .= '</div>';
    echo $html;
}
function gTxtImgHtml($i,$total,$nowimg,$nowtxt) {
    $html = [
    '<div class="'.NYARUKOTABLOID_ITEMC.'" id="'.NYARUKOTABLOID_ITEMC.$i.'">',
        '<div class="'.NYARUKOTABLOID_ITEMC.'ImgBox" id="'.NYARUKOTABLOID_ITEMC.'ImgBox'.$i.'">',
            '<img class="'.NYARUKOTABLOID_ITEMC.'Img" id="'.NYARUKOTABLOID_ITEMC.'Img'.$i.'" src="'.$nowimg.'" alt="'.$nowtxt.'" />',
        '</div>',
        '<div class="'.NYARUKOTABLOID_ITEMC.'TxtBox" id="'.NYARUKOTABLOID_ITEMC.'TxtBox'.$i.'">',
            '<span class="'.NYARUKOTABLOID_ITEMC.'NumBox" id="'.NYARUKOTABLOID_ITEMC.'NumBox'.$i.'">',
                '<span class="'.NYARUKOTABLOID_ITEMC.'NumI" id="'.NYARUKOTABLOID_ITEMC.'NumI'.$i.'">'.$i.'</span>',
                '<span class="'.NYARUKOTABLOID_ITEMC.'NumO" id="'.NYARUKOTABLOID_ITEMC.'NumO'.$i.'">/</span>',
                '<span class="'.NYARUKOTABLOID_ITEMC.'NumT" id="'.NYARUKOTABLOID_ITEMC.'NumT'.$i.'">'.$total.'</span>',
            '</span>',
            '<span class="'.NYARUKOTABLOID_ITEMC.'NumTxt" id="'.NYARUKOTABLOID_ITEMC.'NumTxt'.$i.'">'.$nowtxt.'</span>',
        '</div>',
    '</div>'
    ];
    return implode('', $html);
}
add_shortcode('nyarukotabloid', 'NyarukoTabloidShortcode');