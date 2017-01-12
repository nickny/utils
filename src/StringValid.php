<?php
namespace Sammy\Utils;

class Validate_utils
{

    public function __construct()
    {

    }

    /*
     * -----------------------------------------------------------
     * 函数名称：isNumber
     * 简要描述：检查输入的是否为数字
     * 输入：string
     * 输出：boolean
     * 修改日志：------
     * -----------------------------------------------------------
     */
    public static function isNumber($val)
    {
        if (preg_match("/^[0-9]+$/", $val))
            return true;
        return false;
    }

    /*
     * -----------------------------------------------------------
     * 函数名称：isPhone
     * 简要描述：检查输入的是否为电话
     * 输入：string
     * 输出：boolean
     * 修改日志：------
     * -----------------------------------------------------------
     */
    public static function isPhone($val)
    {
        // eg: xxx-xxxxxxxx-xxx | xxxx-xxxxxxx-xxx ...
        if (preg_match("/^((0\\d{2,3})-)(\\d{7,8})(-(\\d{3,}))?$/", $val))
            return true;
        return false;
    }

    /*
     * -----------------------------------------------------------
     * 函数名称：isMobile
     * 简要描述：检查输入的是否为手机号
     * 输入：string
     * 输出：boolean
     * 修改日志：------
     * -----------------------------------------------------------
     */
    public static function isMobile($val)
    {
        // 该表达式可以验证那些不小心把连接符“-”写出“－”的或者下划线“_”的等等
        if (preg_match("/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/", $val))
            return true;
        return false;
    }

    /*
     * -----------------------------------------------------------
     * 函数名称：isPostcode
     * 简要描述：检查输入的是否为邮编
     * 输入：string
     * 输出：boolean
     * 修改日志：------
     * -----------------------------------------------------------
     */
    public static function isPostcode($val)
    {
        if (preg_match("/^[0-9]{4,6}$/", $val))
            return true;
        return false;
    }

    /*
     * -----------------------------------------------------------
     * 函数名称：isEmail
     * 简要描述：邮箱地址合法性检查
     * 输入：string
     * 输出：boolean
     * 修改日志：------
     * -----------------------------------------------------------
     */
    public static function isEmail($val, $domain = "")
    {
        if (! $domain) {
            if (preg_match("//^[a-z0-9-_.]+@[\\da-z][\\.\\w-]+\\.[a-z]{2,4}$/i/", $val)) {
                return true;
            } else
                return false;
        } else {
            if (preg_match("//^[a-z0-9-_.]+@" . $domain . "$/i/", $val)) {
                return true;
            } else
                return false;
        }
    }
    // end func
    
    /*
     * -----------------------------------------------------------
     * 函数名称：isName
     * 简要描述：姓名昵称合法性检查，只能输入中文英文
     * 输入：string
     * 输出：boolean
     * 修改日志：------
     * -----------------------------------------------------------
     */
    public static function isName($val)
    {
        if (preg_match("/^[\x80-\xffa-zA-Z0-9]{3,60}$/", $val)) {// 2008-7-24
            return true;
        }
        return false;
    }
    // end func
    
    /*
     * -----------------------------------------------------------
     * 函数名称:isDomain($Domain)
     * 简要描述:检查一个（英文）域名是否合法
     * 输入:string 域名
     * 输出:boolean
     * 修改日志:------
     * -----------------------------------------------------------
     */
    public static function isDomain($Domain)
    {
        if (! preg_match("/^[0-9a-z]+[0-9a-z\\.-]+[0-9a-z]+$/", $Domain)) {
            return false;
        }
        if (! preg_match("\\.", $Domain)) {
            return false;
        }
        
        if (preg_match("\\-\\.", $Domain) or preg_match("\\-\\-", $Domain) or preg_match("\\.\\.", $Domain) or preg_match("\\.\\-", $Domain)) {
            return false;
        }
        
        $aDomain = explode(".", $Domain);
        if (! preg_match("[a-zA-Z]", $aDomain[count($aDomain) - 1])) {
            return false;
        }
        
        if (strlen($aDomain[0]) > 63 || strlen($aDomain[0]) < 1) {
            return false;
        }
        return true;
    }

    /*
     * -----------------------------------------------------------
     * 函数名称:isNumberLength($theelement, $min, $max)
     * 简要描述:检查字符串长度是否符合要求
     * 输入:mixed (字符串，最小长度，最大长度)
     * 输出:boolean
     * 修改日志:------
     * -----------------------------------------------------------
     */
    public static function isNumLength($val, $min, $max)
    {
        $theelement = trim($val);
        if (preg_match("/^[0-9]{" . $min . "," . $max . "}$/", $val))
            return true;
        return false;
    }

    /*
     * -----------------------------------------------------------
     * 函数名称:isNumberLength($theelement, $min, $max)
     * 简要描述:检查字符串长度是否符合要求
     * 输入:mixed (字符串，最小长度，最大长度)
     * 输出:boolean
     * 修改日志:------
     * -----------------------------------------------------------
     */
    public static function isEngLength($val, $min, $max)
    {
        $theelement = trim($val);
        if (preg_match("/^[a-zA-Z]{" . $min . "," . $max . "}$/", $val))
            return true;
        return false;
    }

    /*
     * -----------------------------------------------------------
     * 函数名称：isEnglish
     * 简要描述：检查输入是否为英文
     * 输入：string
     * 输出：boolean
     * 作者：------
     * 修改日志：------
     * -----------------------------------------------------------
     */
    public static function isEnglish($theelement)
    {
        if (preg_match("/[\x80-\xff]./", $theelement)) {
            return false;
        }
        return true;
    }

    /*
     * -----------------------------------------------------------
     * 函数名称：isChinese
     * 简要描述：检查是否输入为汉字
     * 输入：string
     * 输出：boolean
     * 修改日志：------
     * -----------------------------------------------------------
     */
    public static function isChinese($sInBuf)
    {
        $iLen = strlen($sInBuf);
        for ($i = 0; $i < $iLen; $i ++) {
            if (ord($sInBuf{$i}) >= 0x80) {
                if ((ord($sInBuf{$i}) >= 0x81 && ord($sInBuf{$i}) <= 0xFE) && ((ord($sInBuf{$i + 1}) >= 0x40 && ord($sInBuf{$i + 1}) < 0x7E) || (ord($sInBuf{$i + 1}) > 0x7E && ord($sInBuf{$i + 1}) <= 0xFE))) {
                    if (ord($sInBuf{$i}) > 0xA0 && ord($sInBuf{$i}) < 0xAA) {
                        // 有中文标点
                        return false;
                    }
                } else {
                    // 有日文或其它文字
                    return false;
                }
                $i ++;
            } else {
                return false;
            }
        }
        return true;
    }

    /*
     * -----------------------------------------------------------
     * 函数名称：isDate
     * 简要描述：检查日期是否符合0000-00-00
     * 输入：string
     * 输出：boolean
     * 修改日志：------
     * -----------------------------------------------------------
     */
    public static function isDate($sDate)
    {
        if (preg_match("/^[0-9]{4}\\-[][0-9]{2}\\-[0-9]{2}$/", $sDate)) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * -----------------------------------------------------------
     * 函数名称：isTime
     * 简要描述：检查日期是否符合0000-00-00 00:00:00
     * 输入：string
     * 输出：boolean
     * 修改日志：------
     * -----------------------------------------------------------
     */
    public static function isTime($sTime)
    {
        if (preg_match("/^[0-9]{4}\\-[][0-9]{2}\\-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/", $sTime)) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * -----------------------------------------------------------
     * 函数名称:isMoney($val)
     * 简要描述:检查输入值是否为合法人民币格式
     * 输入:string
     * 输出:boolean
     * 修改日志:------
     * -----------------------------------------------------------
     */
    public static function isMoney($val)
    {
        if (preg_match("/^[0-9]{1,}$/", $val))
            return true;
        if (preg_match("/^[0-9]{1,}\\.[0-9]{1,2}$/", $val))
            return true;
        return false;
    }

    /*
     * -----------------------------------------------------------
     * 函数名称:isIp($val)
     * 简要描述:检查输入IP是否符合要求
     * 输入:string
     * 输出:boolean
     * 修改日志:------
     * -----------------------------------------------------------
     */
    public static function isIp($val)
    {
        return (bool) ip2long($val);
    }
    // -----------------------------------------------------------------------------

    public static function idcard_checksum18($idcard){
        if (strlen($idcard) != 18){ return false; }
        $idcard_base = substr($idcard, 0, 17);
        if (StringHelper::idcard_verify_number($idcard_base) != strtoupper(substr($idcard, 17, 1))){
            return false;
        }else{
            return true;
        }
    }

    public static function validatePlateNumber ($plate) {
        if (preg_match_all('/[\x80-\xff][A-Z][0-9a-zA-Z]{5}/i', $plate)) {
            return true;
        } else {
            return false;
        }
    }
}