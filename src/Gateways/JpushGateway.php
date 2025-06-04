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
        
        // 使用Guzzle的auth选项进行HTTP Basic认证
        $result = $this->request('POST', self::ENDPOINT_URL, [
            'auth' => [$config->get('app_key'), $config->get('master_secret')],
            'json' => $data,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'User-Agent' => 'JSMS-API-PHP-CLIENT'
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
        ];

        // 添加签名ID（如果有配置）
        $signId = $config->get('sign_id');
        if (!empty($signId)) {
            $data['sign_id'] = (int)$signId;
        }

        // 如果有模板ID，使用模板短信
        $template = $message->getTemplate($this);
        if (!empty($template)) {
            $data['temp_id'] = (int)$template;
            
            // 获取模板参数
            $templateData = $message->getData($this);
            if (!empty($templateData) && is_array($templateData)) {
                $data['temp_para'] = $templateData;
            } else {
                // 如果没有模板参数，抛出错误提示
                throw new GatewayErrorException('极光短信模板需要参数，但未提供模板参数', 50000, []);
            }
        } else {
            // 纯文本短信 - 注意：极光短信不支持纯文本短信，需要使用模板
            throw new GatewayErrorException('极光短信不支持纯文本短信，请使用模板短信', 50000, []);
        }

        return $data;
    }
}
