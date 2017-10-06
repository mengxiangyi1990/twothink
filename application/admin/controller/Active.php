<?php
namespace app\admin\controller;


class Active extends Admin {

    public function index($cate_id = null, $model_id = null, $position = null,$group_id=null){
        //获取左边菜单
        $groups =[];
        $model = null;
        $this->getMenu();
        if($cate_id===null){
            $cate_id = $this->cate_id;
        }
        if(!empty($cate_id)){
            $pid = input('pid',0);
            // 获取列表绑定的模型
            if ($pid == 0) {
                $models     =   get_category($cate_id, 'model');
                // 获取分组定义
                $groups		=	get_category($cate_id, 'groups');
                if($groups){
                    $groups	=	parse_field_attr($groups);
                }
            }else{ // 子文档列表
                $models     =   get_category($cate_id, 'model_sub');
            }
            if(is_null($model_id) && !is_numeric($models)){
                // 绑定多个模型 取基础模型的列表定义
                $model = \think\Db::name('Model')->getById($models);
                $model = \think\Db::name('Model')->getById($model['extend']);
            }else{
                $model_id   =   $model_id ? : $models;
                //获取模型信息
                $model = \think\Db::name('Model')->getById($model_id);
                if (empty($model['list_grid']) && !$model['extend'] == 0) {
                    $model['list_grid'] = \think\Db::name('Model')->getFieldById($model['extend'],'list_grid');
                    empty($model['list_grid']) && $this->error('未定义列表定义');
                }
            }
            $this->assign('model', explode(',', $models));
        }else{
            // 获取基础模型信息
            $model = \think\Db::name('Model')->getByName('document');
            $model_id   =   null;
            $cate_id    =   0;
            $this->assign('model', null);
        }
        //解析列表规则
        $fields =	array();
        $grids  =	preg_split('/[;\r\n]+/s', trim($model['list_grid']));
        foreach ($grids as &$value) {
            // 字段:标题:链接
            $val      = explode(':', $value);
            // 支持多个字段显示
            $field   = explode(',', $val[0]);
            $value    = array('field' => $field, 'title' => $val[1]);
            if(isset($val[2])){
                // 链接信息
                $value['href']  =   $val[2];
                // 搜索链接信息中的字段信息
                preg_replace_callback('/\[([a-z_]+)\]/', function($match) use(&$fields){$fields[]=$match[1];}, $value['href']);
            }
            if(strpos($val[1],'|')){
                // 显示格式定义
                list($value['title'],$value['format'])    =   explode('|',$val[1]);
            }
            foreach($field as $val){
                $array  =   explode('|',$val);
                $fields[] = $array[0];
            }
        }
        // 文档模型列表始终要获取的数据字段 用于其他用途
        $fields[] = 'category_id';
        $fields[] = 'model_id';
        $fields[] = 'pid';
        // 过滤重复字段信息
        $fields =   array_unique($fields);
        // 列表查询
        $fields = array_filter($fields);
        $list   =   $this->getDocumentList($cate_id,$model_id,$position,$fields,$group_id);
        // 列表显示处理
        $list   =   $this->parseDocumentList($list,$model_id);
        $this->assign('model_id',$model_id);
        $this->assign('group_id',$group_id);
        $this->assign('position',$position);
        $this->assign('groups', $groups);
        $this->assign('list',   $list);
        $this->assign('list_grids', $grids);
        $this->assign('model_list', $model);

        $this->assign('meta_title','内容管理');
        // 记录当前列表页的cookie
        Cookie('__forward__',$_SERVER['REQUEST_URI']);
        return $this->fetch();
    }



}