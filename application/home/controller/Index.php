<?php
// +----------------------------------------------------------------------
// | TwoThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.twothink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace app\home\controller;
use app\home\model\Document;
use OT\DataDictionary;
use think\Config;
use think\Db;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class Index extends Home{

	//系统首页
    public function index(){
        $category = model('Category')->getTree();
        $document = new Document();
        $lists    = $document->lists(null);
        $this->assign('category',$category);//栏目
        $this->assign('lists',$lists);//列表
        $this->assign('page',model('Document')->page);//分页

        return $this->fetch();
    }
    //小区通知
    public function notice(){

        $notice = Db::name('document')->where('status'>-1)->whereOr('category_id','=', 45)->order('id desc')->paginate(3);

        // 获取分页显示
        $page = $notice->render();
        $this->assign('list', $notice);
        $this->assign('page', $page);
        $this->assign('meta_title' , '小区通知');
        return  $this->fetch('notice');
    }
    //通知详情
    public function detail($id){
        $content = Db::name('document_article')->where('id','=',$id)->order('id desc')->paginate(3);
        // 获取分页显示
        $page = $content->render();
        $this->assign('list', $content);
        $this->assign('page', $page);
        $this->assign('meta_title' , '通知详情');
        return  $this->fetch('detail');

    }
    public function service(){
        $content = Db::name('document')->where('status'>-1)->whereOr('category_id','=', 44)->order('id desc')->paginate(3);
        // 获取分页显示
        $page = $content->render();
        $this->assign('list', $content);
        $this->assign('page', $page);
        $this->assign('meta_title' , '通知详情');
        return  $this->fetch('service');
    }
    public function shop(){
        $content = Db::name('document')->where('status'>-1)->whereOr('category_id','=', 46)->order('id desc')->paginate(3);
        // 获取分页显示
        $page = $content->render();
        $this->assign('list', $content);
        $this->assign('page', $page);
        $this->assign('meta_title' , '通知详情');
        return  $this->fetch('shop');
    }
}
