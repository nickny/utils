<?php
namespace Nickny\Utils;


class TimeUtils {

    /*
     * 获取当前时间（格式化）
     */
    public static function currentStrTime ()
    {
        return date('Y-m-d H:i:s',time());
    }

    /*
     * 根据时间段封装时间，年内显示为 月-日，年前显示为 年-月
     */
    public static function packageTime( $createdTime )
    {
        $curYear = date("Y", time());
        $createdYear = date("Y", strtotime($createdTime) );
        if ( $curYear==$createdYear ) {
            return date("m-d", strtotime($createdTime) );
        } else {
            return date("Y-m", strtotime($createdTime) );
        }
    }

    /*
     * 本周开始时间戳（周一 0点）
     */
    public static function weekStartTime ()
    {
        $time = time();
        $w_day=date("w",$time);
        if($w_day=='1'){
            $cflag = '+0';
            $lflag = '-1';
        }else{
            $cflag = '-1';
            $lflag = '-2';
        }
        $weekstar = strtotime(date('Y-m-d',strtotime("$cflag week Monday", $time)));
    }
    
}
