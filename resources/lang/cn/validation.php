<?php

return array(

    'custom' => [
        'username' => [
            'required' => '用户名不能为空',
        ],
        'password' => [
            'required' => '密码不能为空',
        ],
        'captcha'  => [
            'required' => '验证码不能为空',
            'captcha'  => '验证码错误',
        ],
    ],
);