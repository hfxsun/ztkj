<?php

require_once __DIR__ . '/vendor/autoload.php';

use Overtrue\EasySms\EasySms;

// 配置信息
$config = [
    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            'jpush'
        ],
    ],
    
    // 可用的网关配置
    'gateways' => [
        'jpush' => [
            'app_key' => 'your-app-key',           // 极光AppKey
            'master_secret' => 'your-master-secret', // 极光Master Secret
            'sign_id' => 'your-sign-id',           // 签名ID
        ],
        'aliyun' => [
            'access_key_id' => '',
            'access_key_secret' => '',
            'sign_name' => '',
        ],
        'qcloud' => [
            'sdk_app_id' => '',
            'secret_id' => '',
            'secret_key' => '',
            'sign_name' => '',
        ],
    ],
];

$easySms = new EasySms($config);

try {
    // 示例1：发送模板短信
    $result1 = $easySms->send('13800138000', [
        'template' => 'temp_123456',  // 模板ID
        'data' => [
            'code' => '1234',         // 验证码
            'product' => 'BuildAdmin' // 产品名称
        ],
    ]);
    
    echo "模板短信发送成功：\n";
    print_r($result1);
    
    // 示例2：发送纯文本短信
    $result2 = $easySms->send('13800138000', [
        'content' => '您的验证码是：5678，请在5分钟内使用。',
    ]);
    
    echo "文本短信发送成功：\n";
    print_r($result2);
    
    // 示例3：多网关发送（失败自动切换）
    $result3 = $easySms->send('13800138000', [
        'content' => '测试短信',
    ], ['jpush', 'aliyun', 'qcloud']); // 指定网关顺序
    
    echo "多网关发送成功：\n";
    print_r($result3);
    
} catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
    echo "发送失败，所有网关都不可用：\n";
    echo $exception->getLastException()->getMessage();
} catch (\Exception $exception) {
    echo "发送失败：" . $exception->getMessage();
} 