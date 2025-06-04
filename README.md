# Enhanced SMS

[![Latest Stable Version](https://poser.pugx.org/buildadmin/enhanced-sms/v/stable)](https://packagist.org/packages/buildadmin/enhanced-sms)
[![Total Downloads](https://poser.pugx.org/buildadmin/enhanced-sms/downloads)](https://packagist.org/packages/buildadmin/enhanced-sms)
[![License](https://poser.pugx.org/buildadmin/enhanced-sms/license)](https://packagist.org/packages/buildadmin/enhanced-sms)

基于EasySms的增强版短信发送包，新增极光短信支持，完全兼容原有EasySms接口。

## 特性

- ✅ **完全兼容** - 100%兼容原有EasySms接口
- ✅ **极光短信** - 新增极光短信网关支持
- ✅ **多网关支持** - 支持40+短信网关
- ✅ **失败重试** - 自动切换网关重试
- ✅ **统一接口** - 统一的发送接口，简单易用

## 支持的短信网关

- 阿里云 (Aliyun)
- 腾讯云 (Qcloud) 
- 七牛云 (Qiniu)
- 云片 (Yunpian)
- **极光短信 (Jpush)** ⭐ 新增
- 华为云 (Huawei)
- 百度云 (Baidu)
- 融云 (Rongcloud)
- 网易云信 (Yunxin)
- 创蓝 (Chuanglan)
- 互亿无线 (Huyi)
- 螺丝帽 (Luosimao)
- 容联云通讯 (Yuntongxun)
- 火山引擎 (Volcengine)
- ... 等40+网关

## 安装

```bash
composer require buildadmin/enhanced-sms
```

## 快速开始

```php
<?php

use Overtrue\EasySms\EasySms;

$config = [
    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            'jpush', 'aliyun', 'qcloud'
        ],
    ],
    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => '/tmp/easy-sms.log',
        ],
        'jpush' => [
            'app_key' => 'your-app-key',
            'master_secret' => 'your-master-secret',
            'sign_id' => 'your-sign-id', // 签名ID
        ],
        'aliyun' => [
            'access_key_id' => '',
            'access_key_secret' => '',
            'sign_name' => '',
        ],
        'qcloud' => [
            'sdk_app_id' => '', // SDK APP ID
            'secret_id' => '', // SECRET ID
            'secret_key' => '', // SECRET KEY
            'sign_name' => '', // 短信签名
        ],
        //...
    ],
];

$easySms = new EasySms($config);

$easySms->send(13188888888, [
    'content'  => '您的验证码为: 6379',
    'template' => 'SMS_001',
    'data' => [
        'code' => 6379
    ],
]);
```

## 极光短信配置

### 获取配置信息

1. 登录 [极光推送控制台](https://www.jiguang.cn/)
2. 创建应用获取 `AppKey` 和 `Master Secret`
3. 在短信服务中获取签名ID

### 配置示例

```php
'jpush' => [
    'app_key' => 'your-app-key',
    'master_secret' => 'your-master-secret', 
    'sign_id' => 'your-sign-id', // 签名ID，在极光短信控制台获取
],
```

### 发送示例

```php
// 发送验证码
$easySms->send(13188888888, [
    'template' => 'temp_id', // 模板ID
    'data' => [
        'code' => '1234', // 模板变量
    ],
]);

// 发送纯文本短信
$easySms->send(13188888888, [
    'content' => '您的验证码是：1234',
]);
```

## 从EasySms迁移

本包完全兼容EasySms，无需修改任何代码：

1. 卸载原包：`composer remove overtrue/easy-sms`
2. 安装本包：`composer require buildadmin/enhanced-sms`
3. 配置文件中添加极光短信配置即可

## License

MIT

## 致谢

本项目基于 [overtrue/easy-sms](https://github.com/overtrue/easy-sms) 开发，感谢原作者的优秀工作。 