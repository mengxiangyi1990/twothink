<?php
namespace app\admin\validate;

use think\Validate;

class Repair extends Validate{

    protected $rule = [
        'name'  => 'require|max:25',
        'tel'   => 'require',
        'address' => 'require',
        'title' => 'require',
        'content' => 'require',
    ];

    protected $message = [
        'name' => '用户名不能为空且不能大于25个字符',
        'tel' => '请正确添加11位手机号码',
        'address' => '地址不能为空',
        'title' => '简述不能为空',
        'content' => '内容不能为空',
    ];
}