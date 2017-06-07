<?php
/**
 * Created by PhpStorm.
 * User: djj
 * Date: 17-6-6
 * Time: 上午11:27
 */

namespace Nickny\Utils;


use App\Jobs\SendMail;

class LogHelper
{
    const ERROR_EMERGENT = 5;
    const ERROR_COMMON = 4;
    const WARNING = 3;

    public function log($content, $prefix = 'request', $suffixPath = "sdbl")
    {
        $date = date("Ymd");
        $fileName = $prefix . '_' . $date . ".log";
        $path = storage_path($suffixPath);
        $filePath = $path . DIRECTORY_SEPARATOR . $fileName;
        if (!file_exists($path)) {
            mkdir($path);
        }
        file_put_contents($filePath, $content . PHP_EOL, FILE_APPEND);
    }

    public function request($serverFlag = 'gateway')
    {
        $request = request();
        $serialNumber = StringUtils::uuid();
        $content = [
            'time' => date('Y-m-d H:i:s'),
            'serialNumber' => $serialNumber,
            'requestPath' => $request->path(),
            'requestParams' => $request->all(),
            'ip' => $request->ip(),
            'serviceFlag' => $serverFlag,
            'os' => $request->header('os', ''),
            'version' => $request->header('version', ''),
            'imei' => $request->header('imei', ''),
            'band' => $request->header('band', ''),
            'model' => $request->header('model', '')
        ];
        $request->serialNumber = $serialNumber;
        $this->log(json_encode($content));
    }

    public function error($level, $code, $message, $needMail = 0, $serverFlag = 'gateway')
    {
        $request = request();
        $content = [
            'time' => date('Y-m-d H:i:s'),
            'serialNumber' => isset($request->serialNumber) ? $request->serialNumber : '',
            'error_code' => $code,
            'error_message' => $message,
            'level' => $level,
            'serviceFlag' => $serverFlag,
            'needMail' => $needMail
        ];
        $this->log(json_encode($content), 'error');
        if ($needMail) {
            dispatch(new SendMail(json_encode($content)));
        }
    }

    public function response($response, $serverFlag = 'gateway')
    {
        $request = request();
        $content = [
            'time' => date('Y-m-d H:i:s'),
            'serialNumber' => isset($request->serialNumber) ? $request->serialNumber : '',
            'response' => $response,
            'serviceFlag' => $serverFlag,
        ];
        $this->log(json_encode($content), 'response');
    }

}