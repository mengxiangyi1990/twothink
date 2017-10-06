<?php
namespace app\admin\model;

use think\Model;

/*
 *  小区租售模型
 */
class Sale extends Model {
    protected $insert = ['create_time','status'=>1];
    protected $update = ['end_time'];
}