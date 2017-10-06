<?php
namespace app\home\controller;

class Repair extends Home{
    //在线报修

    public function repair($verify = ''){
        if(request()->isPost()){
            $Repari = model('repair');
            $post_data=\think\Request::instance()->post();
            /* 检测验证码 */

//            if(!captcha_check($verify)){
//                $this->error('验证码输入错误！');
//            }
            //自动验证
            $validate = validate('repair');
            if(!$validate->check($post_data)){
                return $this->error($validate->getError());
            }
            //var_dump($post_data);exit;
            $post_data['sn'] = rand(1000,9999);
            $data = $Repari->save($post_data);
            if($data){
                $this->success('新增成功', url('index'));
                //记录行为
                action_log('update_repair', 'repair', $data->id, UID);
            } else {
                $this->error($Repari->getError());
            }
        } else {
            $this->assign('info',null);
            $this->assign('meta_title', '添加报修');
            return $this->fetch('repair');
        }
    }
}