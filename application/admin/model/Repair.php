<?php
namespace app\admin\model;
use think\Model;

/*
 * 报修模型
 */
class Repair extends Model{
    protected $insert = ['create_time','status'=>0];
    protected $update = ['update_time'];


}