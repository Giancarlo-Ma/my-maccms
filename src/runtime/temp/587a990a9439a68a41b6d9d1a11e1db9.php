<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:57:"/var/www/html/application/admin/view/database/export.html";i:1617440624;s:53:"/var/www/html/application/admin/view/public/head.html";i:1617440624;s:53:"/var/www/html/application/admin/view/public/foot.html";i:1617440624;}*/ ?>
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

    <div class="my-toolbar-box" >
        <ul class="layui-tab-title mb10">
            <li class="layui-this"><a href="<?php echo url('index'); ?>"><?php echo lang('admin/database/backup_db'); ?></a></li>
            <li><a href="<?php echo url('index'); ?>?group=import"><?php echo lang('admin/database/import_db'); ?></a></li>
        </ul>

        <div class="layui-btn-group">
            <a data-href="<?php echo url('export'); ?>" class="layui-btn layui-btn-primary j-page-btns"><i class="layui-icon">&#xe62d;</i><?php echo lang('admin/database/backup_db'); ?></a>
            <a data-href="<?php echo url('optimize'); ?>" class="layui-btn layui-btn-primary j-page-btns"><i class="layui-icon">&#xe631;</i><?php echo lang('admin/database/optimize_db'); ?></a>
            <a data-href="<?php echo url('repair'); ?>" class="layui-btn layui-btn-primary j-page-btns"><i class="layui-icon">&#xe60c;</i><?php echo lang('admin/database/repair_db'); ?></a>
        </div>
    </div>

    <form id="pageListForm" class="layui-form">
        <table class="layui-table mt10" lay-even="" lay-skin="row">
            <colgroup>
                <col width="50">
            </colgroup>
            <thead>
            <tr>
                <th><input type="checkbox" lay-skin="primary" lay-filter="allChoose"></th>
                <th><?php echo lang('admin/database/table'); ?></th>
                <th><?php echo lang('admin/database/count'); ?></th>
                <th><?php echo lang('admin/database/size'); ?></th>
                <th><?php echo lang('admin/database/redundancy'); ?></th>
                <th><?php echo lang('remarks'); ?></th>
                <th width="90"><?php echo lang('opt'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td><input type="checkbox" name="ids[]" class="layui-checkbox checkbox-ids" value="<?php echo $vo['Name']; ?>" lay-skin="primary"></td>
                <td><?php echo $vo['Name']; ?></td>
                <td><?php echo $vo['Rows']; ?></td>
                <td><?php echo round($vo['Data_length']/1024,2); ?> kb</td>
                <td><?php echo round($vo['Data_free']/1024,2); ?> kb</td>
                <td><?php echo $vo['Comment']; ?></td>
                <td>
                        <a data-href="<?php echo url('optimize?ids='.$vo['Name']); ?>" class="layui-badge-rim j-ajax"><?php echo lang('admin/database/optimize'); ?></a>
                        <a data-href="<?php echo url('repair?ids='.$vo['Name']); ?>" class="layui-badge-rim  j-ajax"><?php echo lang('admin/database/repair'); ?></a>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </form>

</div>
<script type="text/javascript" src="/static/js/admin_common.js"></script>


<script type="text/javascript">
    layui.use(['form', 'layer'], function () {
        // 操作对象
        var form = layui.form
                , layer = layui.layer
                , $ = layui.jquery;



    });
</script>
</body>
</html>