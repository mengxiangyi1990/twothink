<?php
namespace app\home\model;


class Repair extends \think\Model {
    protected $insert = ['create_time','status'=>0];
    protected $update = ['update_time'];
}