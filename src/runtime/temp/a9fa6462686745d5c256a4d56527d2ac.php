<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:53:"/var/www/html/application/admin/view/group/index.html";i:1617440624;s:53:"/var/www/html/application/admin/view/public/head.html";i:1617440624;s:53:"/var/www/html/application/admin/view/public/foot.html";i:1617440624;}*/ ?>
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
<div class="page-container p10">

    <div class="my-toolbar-box">

        <div class="layui-btn-group">
            <a data-href="<?php echo url('info'); ?>" class="layui-btn layui-btn-primary j-iframe"><i class="layui-icon">&#xe654;</i><?php echo lang('add'); ?></a>
            <a data-href="<?php echo url('del'); ?>" class="layui-btn layui-btn-primary j-page-btns confirm"><i class="layui-icon">&#xe640;</i><?php echo lang('del'); ?></a>
        </div>

    </div>

    <form class="layui-form " method="post" id="pageListForm">
        <table class="layui-table" lay-size="sm">
            <thead>
            <tr>
                <th width="25"><input type="checkbox" lay-skin="primary" lay-filter="allChoose"></th>
                <th width="100"><?php echo lang('id'); ?></th>
                <th ><?php echo lang('name'); ?></th>
                <th width="100"><?php echo lang('status'); ?></th>
                <th width="100"><?php echo lang('admin/group/pack_day'); ?></th>
                <th width="100"><?php echo lang('admin/group/pack_week'); ?></th>
                <th width="100"><?php echo lang('admin/group/pack_month'); ?></th>
                <th width="100"><?php echo lang('admin/group/pack_year'); ?></th>
                <th width="100"><?php echo lang('opt'); ?></th>
            </tr>
            </thead>

            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td>
                    <?php if($vo['group_id'] > 2): ?>
                    <input type="checkbox" name="ids[]" value="<?php echo $vo['group_id']; ?>" class="layui-checkbox checkbox-ids" lay-skin="primary">
                    <?php endif; ?>
                </td>
                <td><?php echo $vo['group_id']; ?></td>
                <td><?php echo htmlspecialchars($vo['group_name']); ?></td>
                <td>
                    <?php if($vo['group_id'] > 2): ?>
                    <input type="checkbox" name="status" <?php if($vo['group_status'] == 1): ?>checked<?php endif; ?> value="<?php echo $vo['group_status']; ?>" lay-skin="switch" lay-filter="switchStatus" lay-text="<?php echo lang('open'); ?>|<?php echo lang('close'); ?>" data-href="<?php echo url('field?col=group_status&ids='.$vo['group_id']); ?>">
                    <?php endif; ?>
                </td>
                <td><?php echo $vo['group_points_day']; ?></td>
                <td><?php echo $vo['group_points_week']; ?></td>
                <td><?php echo $vo['group_points_month']; ?></td>
                <td><?php echo $vo['group_points_year']; ?></td>
                <td>
                    <a class="layui-badge-rim j-iframe" data-href="<?php echo url('info?id='.$vo['group_id']); ?>" href="javascript:;" title="<?php echo lang('edit'); ?>"><?php echo lang('edit'); ?></a>
                    <?php if($vo['group_id'] > 2): ?>
                    <a class="layui-badge-rim j-tr-del" data-href="<?php echo url('del?ids='.$vo['group_id']); ?>" href="javascript:;" title="<?php echo lang('del'); ?>"><?php echo lang('del'); ?></a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>

    </form>

    <blockquote class="layui-elem-quote layui-quote-nm">
        <?php echo lang('admin/group/help_tip'); ?>
    </blockquote>
</div>

<script type="text/javascript" src="/static/js/admin_common.js"></script>

<script type="text/javascript">

    layui.use(['laypage', 'layer'], function() {
        var laypage = layui.laypage
                , layer = layui.layer;


    });
</script>
</body>
</html>