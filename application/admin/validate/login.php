<?php
namespace app\admin\validate;

use think\Validate;

class login extends Validate{

    protected $rule = [
        'username' => 'require',
        'password' => 'require',
    ];

    protected $message = [
        'username' => '用户名不能为空',
        'password' => '密码不能为空',
    ];


}