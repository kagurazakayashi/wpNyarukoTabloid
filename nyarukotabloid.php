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
define("NYARUKOTABLOID_TRIANGLE_MODE", 1); //左右翻页按钮: 0外置网页两侧 1嵌入图片两侧
function nyarukoTabloidShortcode($attr, $content) {
    $html = '<script>var wpNyarukoNotFormat = true;</script><link href="'.NYARUKOTABLOID_PLUGIN_URL.'/nyarukotabloid.css" rel="stylesheet">';
    $lines = explode("\n", $content);
    $imgpreg = "/<img [^>]*src=\"(.+?)\"/";
    // $imgpreg = "/!\[.*\]\((.+)\)/"; //用于配合 Markdown 语法插件
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
            if ($nowimg != "" && strlen($nowtxt) > 1) {
                array_push($items,array($nowimg,$nowtxt));
                $nowimg = "";
                $nowtxt = "";
            }
        }
    }
    $total = count($items);
    $html .= '<div class="wpNyarukoTabloid" id="wpNyarukoTabloid'.time().rand(10000,60000).'" onKeyUp="return wpNyarukoTabloidKey(event)">';
    if (NYARUKOTABLOID_TRIANGLE_MODE == 0) {
        $html .= gTriangleHtml();
    }
    $html .= '<div class="wpNyarukoTabloidPaper" id="wpNyarukoTabloidPaper" style="width:'.(($total-1) * 100).'%;">';
    for($j = 1; $j < $total; $j++){
        $nowitem = $items[$j];
        $nowimg2 = $nowitem[0];
        $nowtxt2 = $nowitem[1];
        $html .= gTxtImgHtml($j,$total-1,$nowimg2,$nowtxt2);
    }
    $html .= '</div></div><script type="text/javascript">var wpNyarukoTabloidTotal = '.$total.';var wpNyarukoTriangleMode = '.NYARUKOTABLOID_TRIANGLE_MODE.';</script>
    <script type="text/javascript" src="'.NYARUKOTABLOID_PLUGIN_URL.'/nyarukotabloid.js" charset="UTF-8"></script>';
    echo $html;
}
function gTriangleHtml($riangleid=0,$total=PHP_INT_MAX) {
    $triangleHtml = "";
    $showL = false;
    $showR = false;
    if ($total == PHP_INT_MAX) {
        $showL = true;
        $showR = true;
    }
    if ($riangleid > 1) {
        $showL = true;
    }
    if ($riangleid < $total) {
        $showR = true;
    }
    if ($showL) {
        $triangleHtml .= '<div class="wpNyarukoTabloidTriangleBox wpNyarukoTabloidTriangleBox'.NYARUKOTABLOID_TRIANGLE_MODE.' wpNyarukoTabloidTriangleBoxLeft" id="wpNyarukoTabloidTriangleBox_L_'.$riangleid.'" onclick="wpNyarukoTabloidTriangleStyle(false,'.$riangleid.',false);wpNyarukoTabloidTriangleClick(false);" onmouseover="wpNyarukoTabloidTriangleStyle(false,'.$riangleid.',true);" onmouseout="wpNyarukoTabloidTriangleStyle(false,'.$riangleid.',false);">
            <div class="wpNyarukoTabloidTriangle wpNyarukoTabloidTriangle'.NYARUKOTABLOID_TRIANGLE_MODE.' wpNyarukoTabloidTriangleLeft" id="wpNyarukoTabloidTriangle_L_'.$riangleid.'"></div>
        </div>';
    }
    if ($showR) {
        $triangleHtml .= '<div class="wpNyarukoTabloidTriangleBox wpNyarukoTabloidTriangleBox'.NYARUKOTABLOID_TRIANGLE_MODE.' wpNyarukoTabloidTriangleBoxRight" id="wpNyarukoTabloidTriangleBox_R_'.$riangleid.'" id="" onclick="wpNyarukoTabloidTriangleStyle(true,'.$riangleid.',false);wpNyarukoTabloidTriangleClick(true);" onmouseover="wpNyarukoTabloidTriangleStyle(true,'.$riangleid.',true);" onmouseout="wpNyarukoTabloidTriangleStyle(true,'.$riangleid.',false);">
            <div class="wpNyarukoTabloidTriangle wpNyarukoTabloidTriangle'.NYARUKOTABLOID_TRIANGLE_MODE.' wpNyarukoTabloidTriangleRight" id="wpNyarukoTabloidTriangle_R_'.$riangleid.'"></div>
        </div>';
    }
    return $triangleHtml;
}
function gTxtImgHtml($i,$total,$nowimg,$nowtxt) {
    $imgnav = "";
    // if ($i > 1) {
    //     $imgnav .= '<div class="wpNyarukoTabloidTriangle wpNyarukoTabloidTriangleLeft" id="wpNyarukoTabloidTriangleLeft'.$i.'" onclick="wpNyarukoTabloidTriangleClick('.($i-2).','.$i.')"></div>';
    // }
    // if ($i < $total) {
    //     $imgnav .= '<div class="wpNyarukoTabloidTriangle wpNyarukoTabloidTriangleRight" id="wpNyarukoTabloidTriangleRight'.$i.'" onclick="wpNyarukoTabloidTriangleClick('.$i.','.$i.')"></div>';
    // }
    $itemwidth = 100 / $total;
    $html = [
    '<div class="'.NYARUKOTABLOID_ITEMC.'" id="'.NYARUKOTABLOID_ITEMC.'-'.$i.'" style="left:calc('.$itemwidth.'% * '.($i-1).');width:'.$itemwidth.'%">',
        '<div class="'.NYARUKOTABLOID_ITEMC.'ImgBox" id="'.NYARUKOTABLOID_ITEMC.'ImgBox'.$i.'">',
            '<img class="'.NYARUKOTABLOID_ITEMC.'Img" id="'.NYARUKOTABLOID_ITEMC.'Img'.$i.'" src="'.$nowimg.'" alt="'.$nowtxt.'" />',
            $imgnav,
            gTriangleHtml($i,$total),
        '</div>',
        '<div class="'.NYARUKOTABLOID_ITEMC.'TxtBox" id="'.NYARUKOTABLOID_ITEMC.'TxtBox'.$i.'">',
            '<span class="'.NYARUKOTABLOID_ITEMC.'NumBox" id="'.NYARUKOTABLOID_ITEMC.'NumBox'.$i.'">',
                '<span class="'.NYARUKOTABLOID_ITEMC.'NumS '.NYARUKOTABLOID_ITEMC.'NumI" id="'.NYARUKOTABLOID_ITEMC.'NumI'.$i.'">'.$i.'</span>',
                '<span class="'.NYARUKOTABLOID_ITEMC.'NumS '.NYARUKOTABLOID_ITEMC.'NumO" id="'.NYARUKOTABLOID_ITEMC.'NumO'.$i.'"> / </span>',
                '<span class="'.NYARUKOTABLOID_ITEMC.'NumS '.NYARUKOTABLOID_ITEMC.'NumT" id="'.NYARUKOTABLOID_ITEMC.'NumT'.$i.'">'.$total.'</span>',
            '</span>',
            '<span class="'.NYARUKOTABLOID_ITEMC.'Txt" id="'.NYARUKOTABLOID_ITEMC.'Txt'.$i.'">&emsp;&emsp;'.$nowtxt.'</span>',
        '</div>',
    '</div>'
    ];
    return implode('', $html);
}
add_shortcode('nyarukotabloid', 'NyarukoTabloidShortcode');