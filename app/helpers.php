<?php
/**
 * 常用函数封装
 * User: 冯宁飞
 * Date: 2017/5/19
 * Time: 8:41
 */

/**
 * 获取富文本文章第一张图片
 *
 * @param $content
 * @return null
 */
if(!function_exists('getFirstImg')) {
    function getFirstImg($content)
    {
        $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png|\.jpeg]))[\'|\"].*?[\/]?>/";
        preg_match_all($pattern,$content,$matchContent);
        if(isset($matchContent[1][0])){
            return $matchContent[1][0];
        }else{
            return null;
        }
    }
}