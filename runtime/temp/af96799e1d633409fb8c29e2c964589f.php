<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"D:\phpStudy\WWW\twothink\public/../application/home/view/default/repair\test.html";i:1506757382;}*/ ?>



<div class="main-title">
    <h2>
        <?php echo !empty($info['id'])?'编辑':'新增'; ?>导航
        <?php if(!(empty($pid) || (($pid instanceof \think\Collection || $pid instanceof \think\Paginator ) && $pid->isEmpty()))): ?>"><?php echo $parent['title']; ?></a>&nbsp;]
        <?php endif; ?>
    </h2>
</div>
<form action="<?php echo url(); ?>" method="post" class="form-horizontal">
    <!--<input type="hidden" name="pid" value="<?php echo $pid; ?>">-->
    <div class="form-item">
        <label class="item-label">姓名<span class="check-tips">(必填)</span></label>
        <div class="controls">
            <input type="text" class="text input-large" name="name" value="<?php echo (isset($info['name']) && ($info['name'] !== '')?$info['name']:''); ?>">
        </div>
    </div>
    <div class="form-item">
        <label class="item-label">电话<span class="check-tips">(必填)</span></label>
        <div class="controls">
            <input type="text" class="text input-large" name="tel" value="<?php echo (isset($info['tel']) && ($info['tel'] !== '')?$info['tel']:''); ?>">
        </div>
    </div>
    <div class="form-item">
        <label class="item-label">地址<span class="check-tips">(必填)</span></label>
        <div class="controls">
            <input type="text" class="text input-large" name="address" value="<?php echo (isset($info['address']) && ($info['address'] !== '')?$info['address']:''); ?>">
        </div>
    </div>
    <div class="form-item">
        <label class="item-label">标题<span class="check-tips">(简述报修问题)</span></label>
        <div class="controls">
            <input type="text" class="text input-large" name="title" value="<?php echo (isset($info['title']) && ($info['title'] !== '')?$info['title']:''); ?>">
        </div>
    </div>
    <div class="form-item">
        <label class="item-label">内容<span class="check-tips">(报修问题详情)</span></label>
        <div class="controls">
            <textarea  name="content" class="textarea input-large" rows="5"><?php echo $info['content']; ?></textarea>
        </div>
    </div>
    <div class="form-item">
        <input type="hidden" name="id" value="<?php echo (isset($info['id']) && ($info['id'] !== '')?$info['id']:''); ?>">
        <button class="btn submit-btn ajax-posts" id="submit" type="submit" target-form="form-horizontal">确 定</button>
        <button class="btn btn-return" onclick="javascript:history.back(-1);return false;">返 回</button>
    </div>
</form>


<script type="text/javascript" charset="utf-8">
    //导航高亮
    highlight_subnav('<?php echo url('index'); ?>');
</script>

