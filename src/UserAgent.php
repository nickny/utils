<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/26
 * Time: 15:35
 */

namespace Nickny\Utils;


class UserAgent
{
    public static function getType(){
        $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $useragent_commentsblock=preg_match('|.∗?|',$useragent,$matches)>0?$matches[0]:'';

        $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
        $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');

        $found_mobile=self::CheckSubstrs($mobile_os_list,$useragent_commentsblock) || self::CheckSubstrs($mobile_token_list,$useragent);

        if ($found_mobile) {
            if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')) {
                return 'iphone';
            } else if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')) {
                return 'ipad';
            }else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Android')){
                return 'android';
            }else{
                return 'others';
            }
        }else{
            return 'PC';
        }
    }

    private static function CheckSubstrs($substrs,$text)
    {
        foreach($substrs as $substr){
            if(false!==strpos($text,$substr)){
                return true;
            }else{
                return false;
            }
        }
    }
}
