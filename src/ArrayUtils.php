<?php
/**
 * User: Sammy Lee
 * Date: 2016/9/6
 * Time: 11:43
 */
namespace Sammy\Utils;

class ArrayUtils {
    
    public function __construct(){
    
    
    }
    
    /*
     * 多维数据排序
     */
    public static function sort ( $arr, $condition=array() )
    {
        $sort = [];
        foreach ($condition as $key => $value) {
            $sort[] = array();
        }

        $keys = array_keys($condition);
        $orders = array_values($condition);
    
        foreach ( $arr as $k=>$record ) {
            foreach ($keys as $key => $value) {
                $sort[$key][] = $record[$value];
            }
        }
        $sort_str = "array_multisort(";
        foreach ($sort as $key => $s_arr) {
            $sort_str .= "\$sort[".$key."],"."\$orders[".$key."],";
        }
        $sort_str .= "\$arr);";
        eval($sort_str);
        return $arr;
    }

    /*
     * 多维数据分组
     */
    public static function group ( $arr, $key ) 
    {
        $items = array();
        foreach($arr as $item) {
            $value = $item[$key];
            unset($item[$key]);
        
            if(!isset($items[$value])) {
                $items[$value] = array($key=>$value, 'items'=>array());
            }
        
            $items[$value]['items'][] = $item;
        }
        return array_values( $items );
    }

    /*
     * 二位数组排序
     */
    public static function Sort_by_key ($arr, $key, $sort) 
    {
    
        usort($arr, function($a, $b) use ($key, $sort) {
            $al = $a[$key];
            $bl = $b[$key];
            if ($al == $bl)
                return 0;
            if ( $sort == SORT_ASC ) {
                return ($al > $bl) ? 1 : -1;
            } elseif ($sort == SORT_DESC) {
                return ($al > $bl) ? -1 : 1;
            }
        });
        return $arr;
    }

    /*
     * 数组分页
     */
    public static function pagination ($page, $arr, $page_size)
    {
        if ( count($arr) != 0 ) {
            return array_slice($arr, ($page-1)*$page_size, $page_size);
        }
        return [];
    }

    /*
     * 多维数组，移除某列数据
     */
    public static function array_unset($arr,$key)
    {
       
        $res = array();
        foreach ($arr as $value) {
            if(isset($res[$value[$key]])){
                unset($value[$key]);
            }
            else{
                $res[$value[$key]] = $value;
            }
        }
        return array_values($res);
    }
    
}
