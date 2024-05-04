<?php

error_reporting(false);
define("Webhook", false);

function curlJsonArgs($url, $jsonData, $contentType = false)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Teleram Api Request');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if($jsonData){
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
    }

    $result = curl_exec($ch);
    $err = curl_error($ch);
    if($err){
        curl_close($ch);
        return false;
    }
    if($contentType){
        $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        curl_close($ch);
        return [
            "result" => $result,
            "content-type" => $contentType,
        ];
    }
    return $result;
}

function telegramRequest($token, $method, $jsonData)
{
    return curlJsonArgs(
        "https://api.telegram.org/bot{$token}/{$method}",
        $jsonData
    );
}

function getActions()
{
    $path = trim($_SERVER['REQUEST_URI'],"/");
    $position = strpos($path, "?");
    if($position == false) return explode("/", $path);
    return explode("/", substr($path, 0, $position));
}

function getData()
{
    if(!empty($_REQUEST)) return json_encode($_REQUEST);
    $data = file_get_contents("php://input");
    if(!empty($data)) return $data;
    return false;
}

$actions = getActions();

if($actions[0] == "webhook" and Webhook){
    if(!isset($actions[1])) die("The url is invalid");
    $url = base64_decode($actions[1]);
    if(filter_var($url, FILTER_VALIDATE_URL)){
        curlJsonArgs($url, getData());
    }else{
        die("The url is invalid");
    }
}
elseif(substr($actions[0], 0, 3) == "bot"){
    $token = substr($actions[0], 3);
    if(strtolower($actions[1]) == "setwebhook" and Webhook){
        $url = json_decode(getData())->url;
        echo telegramRequest($token, "setwebhook", json_encode([
            "url" => "https://{$_SERVER["HTTP_HOST"]}/webhook/" . base64_encode($url)
        ]));
    }else{
        echo telegramRequest($token, $actions[1], getData());
    }
}
elseif($actions[0] == "file"){
    if(substr($actions[1], 0, 3) == "bot"){
        $req = curlJsonArgs(
            "https://api.telegram.org/file/{$actions[1]}/" . implode("/",array_slice($actions, 2)),
            false,
            true
        );
        
        if($req){
            if (strpos(strtolower($req["content-type"]), 'application/json') !== false) {
                echo $req["result"];
            } else {
                header('Content-Type: '. $req["content-type"]);
                header('Content-Disposition: attachment');
                echo $req["result"];
            }
        }
    }
}

?>