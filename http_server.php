<?php
/**
 * Created by PhpStorm.
 * User: MaShuNing
 * Date: 19/2/28
 * Time: 上午1:39
 */
$http = new swoole_http_server("0.0.0.0", 80);

$http->set(
    [
        'enable_static_handler' => true,
        'document_root' => "/msn/public/static",
        'worker_num'=>5
    ]
);

$http->on('WorkerStart',function (swoole_server $server,  $worker_id){

    // 定义应用目录
    define('APP_PATH', __DIR__ . '/../app/');

    // 加载基础文件
    require __DIR__ . '/../app/index.php';

});


$http->on('request', function($request, $response) use ($http) {

    $_SERVER  =  [];

    if(isset($request->server)) {
        foreach($request->server as $k => $v) {
            $_SERVER[strtoupper($k)] = $v;
        }
    }

    if(isset($request->header)) {
        foreach($request->header as $k => $v) {
            $_SERVER[strtoupper($k)] = $v;
        }
    }

    $_GET = [];
    if(isset($request->get)) {
        foreach($request->get as $k => $v) {
            $_GET[$k] = $v;
        }
    }
    $_POST = [];
    if(isset($request->post)) {
        foreach($request->post as $k => $v) {
            $_POST[$k] = $v;
        }
    }

    ob_start();
    // 执行应用并响应
    try {
        \core\msn::run(); //在框架中这样代码需要注释掉，并且把\core\msn.php include到入口文件中
    }catch (\Exception $e) {
        // todo
    }


    $res = ob_get_contents();
    ob_end_clean();
    $response->end($res);
//    $http->close();
});

$http->start();




function p($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}