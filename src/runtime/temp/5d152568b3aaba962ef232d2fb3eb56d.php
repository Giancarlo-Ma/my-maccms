<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:54:"/var/www/html/application/admin/view/database/rep.html";i:1617440624;s:53:"/var/www/html/application/admin/view/public/head.html";i:1617440624;s:53:"/var/www/html/application/admin/view/public/foot.html";i:1617440624;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $title; ?> - <?php echo lang('admin/public/head/title'); ?></title>
    <link rel="stylesheet" href="/static/layui/css/layui.css?v=1024">
    <link rel="stylesheet" href="/static/css/admin_style.css?v=1024">
    <script type="text/javascript" src="/static/js/jquery.js?v=1024"></script>
    <script type="text/javascript" src="/static/layui/layui.js?v=1024"></script>
    <script>
        var ROOT_PATH="",ADMIN_PATH="<?php echo $_SERVER['SCRIPT_NAME']; ?>", MAC_VERSION="v10";
    </script>
</head>
<body>
<style>
    .layui-form-select ul {max-height:200px}
    .layui-btn+.layui-btn{margin-left:0px; }
</style>
<div class="page-container">
    <form class="layui-form layui-form-pane" action="">
        <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />
        <div class="layui-tab">
            <ul class="layui-tab-title">
                <li class="layui-this"><?php echo lang('admin/database/batch_replace'); ?></li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/database/select_table'); ?>：</label>
                    <div class="layui-input-inline w400" >
                        <select name="table" lay-filter="table" lay-verify="table">
                            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo $vo['Name']; ?>"><?php echo $vo['Name']; ?>【<?php echo $vo['Comment']; ?>】</option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item row-fields">
                    <label class="layui-form-label"><?php echo lang('admin/database/select_col'); ?>：</label>
                    <div class="layui-input-block fields" >

                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/database/field'); ?>：</label>
                    <div class="layui-input-block" >
                        <input type="text" id="field" name="field" placeholder="" lay-verify="field" class="layui-input">
                    </div>
                </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/database/findstr'); ?>：</label>
                        <div class="layui-input-block" >
                            <textarea name="findstr" placeholder="" lay-verify="findstr" class="layui-textarea"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/database/tostr'); ?>：</label>
                        <div class="layui-input-block" >
                            <textarea name="tostr" placeholder="" lay-verify="tostr" class="layui-textarea"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/database/where'); ?>：</label>
                        <div class="layui-input-block" >
                            <input type="text" name="where" placeholder="" value="" class="layui-input">
                        </div>
                    </div>

                <div class="layui-form-item">

                </div>
            </div>
            </div>
        </div>
        <div class="layui-form-item center">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="formSubmit"><?php echo lang('btn_save'); ?></button>
                <button class="layui-btn layui-btn-warm" type="reset"><?php echo lang('btn_reset'); ?></button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript" src="/static/js/admin_common.js"></script>
<script type="text/javascript">
    layui.use(['form', 'layer'], function(){
        // 操作对象
        var form = layui.form
                , layer = layui.layer,
                $ = layui.jquery;

        form.on('select(table)', function(data){
            $('.fields').html('');
            if(data.value !=''){
                $.post("<?php echo url('columns'); ?>", {table:data.value}, function(res) {
                    if (res.code == 1) {
                        $.each(res.data,function(index,row){
                            $(".fields").append('<a class="layui-btn layui-btn-xs w80" href="javascript:setfield(\''+row.Field+'\')">'+row.Field+'</a>&nbsp;&nbsp;');
                            if(index>0 && index%5==0){
                                //$(".fields").append('<br>');
                            }

                        });
                    }
                    layer.msg(res.msg);
                });
            }
        });


        // 验证
        form.verify({
            table: function (value) {
                if (value == "") {
                    return "<?php echo lang('admin/database/select_table'); ?>";
                }
            },
            field: function (value) {
                if (value == "") {
                    return "<?php echo lang('admin/database/select_col'); ?>";
                }
            },
            findstr: function (value) {
                if (value == "") {
                    return "<?php echo lang('admin/database/findstr'); ?>";
                }
            },
            tostr: function (value) {
                if (value == "") {
                    return "<?php echo lang('admin/database/tostr'); ?>";
                }
            }
        });

    });

    function setfield(v){
        $('#field').val(v);
    }

</script>

</body>
</html>