<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:52:"/var/www/html/application/admin/view/plog/index.html";i:1617440624;s:53:"/var/www/html/application/admin/view/public/head.html";i:1617440624;s:53:"/var/www/html/application/admin/view/public/foot.html";i:1617440624;}*/ ?>
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
        <div class="center mb10">
            <form class="layui-form " method="post" action="<?php echo url('index'); ?>">
                <div class="layui-input-inline w150">
                    <select name="type">
                        <option value=""><?php echo lang('select_genre'); ?></option>
                        <option value="1" <?php if($param['type'] == '1'): ?>selected <?php endif; ?>><?php echo lang('admin/plog/points_recharge'); ?></option>
                        <option value="2" <?php if($param['type'] == '2'): ?>selected <?php endif; ?>><?php echo lang('admin/plog/reg_promote'); ?></option>
                        <option value="3" <?php if($param['type'] == '3'): ?>selected <?php endif; ?>><?php echo lang('admin/plog/visit_promote'); ?></option>
                        <option value="4" <?php if($param['type'] == '4'): ?>selected <?php endif; ?>><?php echo lang('one_level_distribution'); ?></option>
                        <option value="5" <?php if($param['type'] == '5'): ?>selected <?php endif; ?>><?php echo lang('two_level_distribution'); ?></option>
                        <option value="6" <?php if($param['type'] == '6'): ?>selected <?php endif; ?>><?php echo lang('three_level_distribution'); ?></option>
                        <option value="7" <?php if($param['type'] == '7'): ?>selected <?php endif; ?>><?php echo lang('admin/plog/points_upgrade'); ?></option>
                        <option value="8" <?php if($param['type'] == '8'): ?>selected <?php endif; ?>><?php echo lang('admin/plog/points_buy'); ?></option>
                        <option value="9" <?php if($param['type'] == '9'): ?>selected <?php endif; ?>><?php echo lang('admin/plog/points_withdrawal'); ?></option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <input type="text" autocomplete="off" placeholder="<?php echo lang('wd'); ?>" class="layui-input" name="wd" value="<?php echo $param['wd']; ?>">
                </div>
                <button class="layui-btn mgl-20 j-search" ><?php echo lang('btn_search'); ?></button>
            </form>
        </div>

        <div class="layui-btn-group">
            <a data-href="<?php echo url('del'); ?>" class="layui-btn layui-btn-primary j-page-btns confirm"><i class="layui-icon">&#xe640;</i><?php echo lang('del'); ?></a>
            <a data-href="<?php echo url('del'); ?>?ids=1&all=1" class="layui-btn layui-btn-primary j-ajax" confirm="<?php echo lang('clear_confirm'); ?>"><i class="layui-icon">&#xe640;</i><?php echo lang('clear'); ?></a>
        </div>
    </div>

     <form class="layui-form " method="post" id="pageListForm">
         <table class="layui-table" lay-size="sm">
            <thead>
            <tr>
                <th width="25"><input type="checkbox" lay-skin="primary" lay-filter="allChoose"></th>
                <th width="80"><?php echo lang('id'); ?></th>
                <th width="100"><?php echo lang('user'); ?></th>
                <th width="50"><?php echo lang('genre'); ?></th>
                <th width="50"><?php echo lang('points'); ?></th>
                <th width="200"><?php echo lang('remarks'); ?></th>
                <th width="140"><?php echo lang('admin/plog/log_time'); ?></th>
                <th width="50"><?php echo lang('opt'); ?></th>
            </tr>
            </thead>

            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td><input type="checkbox" name="ids[]" value="<?php echo $vo['ulog_id']; ?>" class="layui-checkbox checkbox-ids" lay-skin="primary"></td>
                <td><?php echo $vo['plog_id']; ?></td>
                <td>[<?php echo $vo['user_id']; ?>]<?php echo $vo['user_name']; ?></td>
                <td><?php echo mac_get_plog_type_text($vo['plog_type']); ?></td>
                <td><?php if(in_array($vo['plog_type'],[1,2,3,4,5,6])): ?>+<?php else: ?>-<?php endif; ?><?php echo $vo['plog_points']; ?></td>
                <td><?php echo $vo['plog_remarks']; ?></td>
                <td><?php echo mac_day($vo['plog_time'],color); ?></td>
                <td>
                    <a class="layui-badge-rim j-tr-del" data-href="<?php echo url('del?ids='.$vo['plog_id']); ?>" href="javascript:;" title="<?php echo lang('del'); ?>"><?php echo lang('del'); ?></a>
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
    var curUrl="<?php echo url('plog/index',$param); ?>";
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