<?php
/**
 * Copyright (c) 2020. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace App\Repositories\ConfigSettings;


class StatusCodeSettings
{
    const STATUS_BAB_REQUEST = 400; //错误请求：服务器不理解请求的语法
    const STATUS_UNAUTHORIZED = 401; //未授权： 请求要求用户的身份演验证
    const STATUS_PAYMENT_REQUIRED = 402;//
    const STATUS_FORBIDDEN = 403; //禁止：服务器拒绝请求
    const STATUS_NOT_FOUND = 404; //找不到请求地址
    const STATUS_METHOD_NOT_ALLOWED = 405; //方法禁用


    const STATUS_INTERNAL_ERROR = 500; //服务器内部出错
    const STATUS_NOT_IMPLEMENTED = 501; //不可执行
    const STATUS_BAD_GATEWAY = 502; //错误网关；无效网关
    const STATUS_SERVICE_UNAVAILABLE = 503; //服务无效；无法提供服务；找不到服务器
    const STATUS_GATEWAY_TIMEOUT = 504; //服务网关 超时
}
