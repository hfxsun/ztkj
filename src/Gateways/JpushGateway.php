<?php

namespace Overtrue\EasySms\Gateways;

use Overtrue\EasySms\Contracts\MessageInterface;
use Overtrue\EasySms\Contracts\PhoneNumberInterface;
use Overtrue\EasySms\Exceptions\GatewayErrorException;
use Overtrue\EasySms\Support\Config;
use Overtrue\EasySms\Traits\HasHttpRequest;

/**
 * 极光短信网关
 */
class JpushGateway extends Gateway
{
    use HasHttpRequest;

    const ENDPOINT_URL = 'https://api.sms.jpush.cn/v1/messages';

    /**
     * 发送短信
     */
    public function send(PhoneNumberInterface $to, MessageInterface $message, Config $config)
    {
        $data = $this->buildParams($to, $message, $config);
        
        $result = $this->postJson(self::ENDPOINT_URL, $data, [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($config->get('app_key') . ':' . $config->get('master_secret')),
                'Content-Type' => 'application/json',
            ],
        ]);

        if (!empty($result['error'])) {
            throw new GatewayErrorException($result['error']['message'], $result['error']['code'], $result);
        }

        return $result;
    }

    /**
     * 构建请求参数
     */
    protected function buildParams(PhoneNumberInterface $to, MessageInterface $message, Config $config)
    {
        $data = [
            'mobile' => $to->getNumber(),
            'sign_id' => $config->get('sign_id'),
        ];

        // 如果有模板ID，使用模板短信
        $template = $message->getTemplate($this);
        if (!empty($template)) {
            $data['temp_id'] = $template;
            $data['temp_para'] = $message->getData($this) ?: new \stdClass();
        } else {
            // 纯文本短信
            $data['text'] = $message->getContent($this);
        }

        return $data;
    }
} 