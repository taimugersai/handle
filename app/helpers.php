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

/**
 * 判断数组最大维度是多少
 * @param $arr
 * @return int
 */
if(!function_exists('getMaxDimension')) {
    function getMaxDimension($arr)
    {
        if (!is_array($arr)) {
            return 0;
        } else {
            $max = 0;
            foreach ($arr as $item) {
                $t = getMaxDimension($item);
                if ($t > $max) $max = $t;
            }
            return $max + 1;
        }
    }
}