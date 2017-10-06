<?php
namespace app\admin\controller;

class Sale extends Admin{


    /*
     *  小区租售列表
     */
    public function index(){
        $pid = input('get.pid', 0);
        /* 获取频道列表 */
        //$map  = array('status' => array('gt', -1), 'pid'=>$pid);
        $list = \think\Db::name('Sale')->order('id desc')->paginate(3);

        // 获取分页显示
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('pid', $pid);
        $this->assign('page', $page);
        $this->assign('meta_title' , '小区租售');
        return $this->fetch();
    }

    /*
     * 添加小区租售信息
     */
    public function add(){
        if(request()->isPost()){
            $Repari = model('sale');
            $post_data=\think\Request::instance()->post();
            //自动验证
            $validate = validate('sale');
            if(!$validate->check($post_data)){
                return $this->error($validate->getError());
            }
            $post_data['sn'] = rand(1000,9999);
            $data = $Repari->save($post_data);
            if($data){
                $this->success('新增成功', url('index'));
                //记录行为
                action_log('update_sale', 'sale', $data->id, UID);
            } else {
                $this->error($Repari->getError());
            }
        } else {
            $pid = input('pid', 0);
            //获取父导航
            if(!empty($pid)){
                $parent = \think\Db::name('Sale')->where(array('id'=>$pid))->field('title')->find();
                $this->assign('parent', $parent);
            }

            $this->assign('pid', $pid);
            $this->assign('info',null);
            $this->assign('meta_title', '新增小区租售信息');
            return $this->fetch('edit');
        }
    }
    /*
     * 修改
     */

    public function edit($id=0){
        if($this->request->isPost()){
            $postdata = \think\Request::instance()->post();
            $Repair = \think\Db::name("Repair");
            $postdata['update_time'] = time();
            $data = $Repair->update($postdata);
            if($data !== false){
                $this->success('修改成功', url('index'));
            } else {
                $this->error('修改失败');
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = \think\Db::name('Repair')->find($id);
            //var_dump($info);exit;
            if(false === $info){
                $this->error('获取配置信息错误');
            }

            $pid = input('get.pid', 0);
            //获取父导航
            if(!empty($pid)){
                $parent = \think\Db::name('Repair')->where(array('id'=>$pid))->field('title')->find();
                $this->assign('parent', $parent);
            }
            //var_dump($info);exit;
            $this->assign('pid', $pid);
            $this->assign('info', $info);
            $this->meta_title = '修改报表';
            return $this->fetch();
        }
    }


    /**
     * 删除报修数据
     * @author 艺品网络  <twothink.cn>
     */
    public function del(){
        $id = array_unique((array)input('id/a',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(\think\Db::name('repair')->where($map)->delete()){
            //记录行为
            action_log('update_channel', 'channel', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

}