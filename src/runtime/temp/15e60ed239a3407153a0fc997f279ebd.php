<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:52:"/var/www/html/application/admin/view/user/index.html";i:1617440624;s:53:"/var/www/html/application/admin/view/public/head.html";i:1617440624;s:53:"/var/www/html/application/admin/view/public/foot.html";i:1617440624;}*/ ?>
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

        <div class="center mb10">
            <form class="layui-form " method="post" action="<?php echo url('data'); ?>">
                <div class="layui-input-inline w150">
                    <select name="status">
                        <option value=""><?php echo lang('select_status'); ?></option>
                        <option value="0" <?php if($param['status'] == '0'): ?>selected <?php endif; ?>><?php echo lang('reviewed_not'); ?></option>
                        <option value="1" <?php if($param['status'] == '1'): ?>selected <?php endif; ?>><?php echo lang('reviewed'); ?></option>
                    </select>
                </div>
                <div class="layui-input-inline w150">
                    <select name="group">
                        <option value=""><?php echo lang('select_group'); ?></option>
                        <?php if(is_array($group_list) || $group_list instanceof \think\Collection || $group_list instanceof \think\Paginator): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['group_id']; ?>" <?php if($param['group'] == $vo['group_id']): ?>selected <?php endif; ?>><?php echo $vo['group_name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <input type="text" autocomplete="off" placeholder="<?php echo lang('wd'); ?>" class="layui-input" name="wd" value="<?php echo $param['wd']; ?>">
                </div>
                <button class="layui-btn mgl-20 j-search" ><?php echo lang('btn_search'); ?></button>
            </form>
        </div>

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
                <th width="100"><?php echo lang('group'); ?></th>
                <th width="80"><?php echo lang('status'); ?></th>
                <th width="80"><?php echo lang('points'); ?></th>
                <th width="130"><?php echo lang('last_login_time'); ?></th>
                <th width="130"><?php echo lang('last_login_ip'); ?></th>
                <th width="80"><?php echo lang('login_num'); ?></th>
                <th width="220"><?php echo lang('related_data'); ?></th>
                <th width="100"><?php echo lang('opt'); ?></th>
            </tr>
            </thead>

            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td><input type="checkbox" name="ids[]" value="<?php echo $vo['user_id']; ?>" class="layui-checkbox checkbox-ids" lay-skin="primary"></td>
                <td><?php echo $vo['user_id']; ?></td>
                <td><?php echo htmlspecialchars($vo['user_name']); ?></td>
                <td><?php echo htmlspecialchars($vo['group_name']); ?></td>
                <td>
                    <input type="checkbox" name="status" <?php if($vo['user_status'] == 1): ?>checked<?php endif; ?> value="<?php echo $vo['user_status']; ?>" lay-skin="switch" lay-filter="switchStatus" lay-text="<?php echo lang('open'); ?>|<?php echo lang('close'); ?>" data-href="<?php echo url('field?col=user_status&ids='.$vo['user_id']); ?>">
                </td>
                <td><?php echo $vo['user_points']; ?></td>
                <td><?php echo mac_day($vo['user_login_time'],color); ?></td>
                <td><?php echo long2ip($vo['user_login_ip']); ?></td>
                <td><?php echo $vo['user_login_num']; ?></td>
                <td>
                    <a class="layui-badge-rim j-iframe" data-full="1" data-href="<?php echo url('comment/data?uid='.$vo['user_id']); ?>" href="javascript:;" title="<?php echo lang('admin/user/comment_record'); ?>"><?php echo lang('admin/user/comment_record'); ?></a>
                    <a class="layui-badge-rim j-iframe" data-full="1" data-href="<?php echo url('order/index?uid='.$vo['user_id']); ?>" href="javascript:;" title="<?php echo lang('admin/user/order_record'); ?>"><?php echo lang('admin/user/order_record'); ?></a>
                    <a class="layui-badge-rim j-iframe" data-full="1" data-href="<?php echo url('ulog/index?uid='.$vo['user_id']); ?>" href="javascript:;" title="<?php echo lang('admin/user/visit_record'); ?>"><?php echo lang('admin/user/visit_record'); ?></a>
                    <a class="layui-badge-rim j-iframe" data-full="1" data-href="<?php echo url('plog/index?uid='.$vo['user_id']); ?>" href="javascript:;" title="<?php echo lang('admin/user/point_record'); ?>"><?php echo lang('admin/user/point_record'); ?></a>
                    <a class="layui-badge-rim j-iframe" data-full="1" data-href="<?php echo url('cash/index?uid='.$vo['user_id']); ?>" href="javascript:;" title="<?php echo lang('admin/user/withdrawals_record'); ?>"><?php echo lang('admin/user/withdrawals_record'); ?></a>
                    <a class="layui-badge-rim j-iframe" data-full="1" data-href="<?php echo url('user/reward?uid='.$vo['user_id']); ?>" href="javascript:;" title="<?php echo lang('admin/user/three_distribution'); ?>"><?php echo lang('admin/user/three_distribution'); ?></a>
                </td>
                <td>
                    <a class="layui-badge-rim j-iframe" data-href="<?php echo url('info?id='.$vo['user_id']); ?>" href="javascript:;" title="<?php echo lang('edit'); ?>"><?php echo lang('edit'); ?></a>
                    <a class="layui-badge-rim j-tr-del" data-href="<?php echo url('del?ids='.$vo['user_id']); ?>" href="javascript:;" title="<?php echo lang('del'); ?>"><?php echo lang('del'); ?></a>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <div id="pages" class="center"></div>
    </form>
</div>

<script type="text/javascript" src="/static/js/admin_common.js"></script>

<script type="text/javascript">
    var curUrl="<?php echo url('user/data',$param); ?>";
    layui.use(['laypage', 'layer'], function() {
        var laypage = layui.laypage
                , layer = layui.layer;

        laypage.render({
            elem: 'pages'
            ,count: <?php echo $total; ?>
            ,limit: <?php echo $limit; ?>
            ,curr: <?php echo $page; ?>
            ,layout: ['count', 'prev', 'page', 'next', 'limit', 'skip']
            ,jump: function(obj,first){
                if(!first){
                    location.href = curUrl.replace('%7Bpage%7D',obj.curr).replace('%7Blimit%7D',obj.limit);
                }
            }
        });
    });
</script>
</body>
</html>