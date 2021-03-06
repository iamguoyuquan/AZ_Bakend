<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:104:"/Applications/XAMPP/xamppfiles/htdocs/az/ips/public/../application/admin/view/wechat/autoreply/edit.html";i:1597117848;s:87:"/Applications/XAMPP/xamppfiles/htdocs/az/ips/application/admin/view/layout/default.html";i:1588765312;s:84:"/Applications/XAMPP/xamppfiles/htdocs/az/ips/application/admin/view/common/meta.html";i:1588765312;s:86:"/Applications/XAMPP/xamppfiles/htdocs/az/ips/application/admin/view/common/script.html";i:1588765312;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !\think\Config::get('fastadmin.multiplenav')): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <link href="/assets/addons/wechat/css/menu.css?v=<?php echo $site['version']; ?>" rel="stylesheet">
<style>
    .clickbox {margin:0;text-align: left;}
    .create-click {
        margin-left:0;
    }
</style>
<form id="edit-form" class="form-horizontal form-ajax" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label for="c-title" class="control-label col-xs-12 col-sm-2"><?php echo __('Title'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input type="text" name="row[title]" value="<?php echo $row['title']; ?>"  id="c-title" class="form-control" data-rule="required" />
        </div>
    </div>
    <div class="form-group">
        <label for="c-text" class="control-label col-xs-12 col-sm-2"><?php echo __('Text'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input type="text" name="row[text]" value="<?php echo $row['text']; ?>"  id="c-text" class="form-control" data-rule="required; remote(wechat/autoreply/check_text_unique, except=<?php echo $row['text']; ?>)" />
        </div>
    </div>
    <div class="form-group">
        <label for="c-eventkey" class="control-label col-xs-12 col-sm-2"><?php echo __('Content'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="clickbox">
                <input type="hidden" name="row[eventkey]" id="c-eventkey" class="form-control" value="<?php echo $row['eventkey']; ?>" data-rule="required" readonly />
                <span class="create-click"><a href="wechat/response/select" id="select-resources"><i class="weixin-icon big-add-gray"></i><strong>选择现有资源</strong></a><div class="keytitle">资源名:<?php echo $response['title']; ?></div></span>
                <span class="create-click"><a href="wechat/response/add" id="add-resources"><i class="weixin-icon big-add-gray"></i><strong>添加新资源</strong></a></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="c-remark" class="control-label col-xs-12 col-sm-2"><?php echo __('Remark'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input type="text" name="row[remark]" value="<?php echo $row['remark']; ?>"  id="c-remark" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <?php echo build_radios('row[status]', ['normal'=>__('Normal'), 'hidden'=>__('Hidden')], $row['status']); ?>
        </div>
    </div>
    <div class="form-group hide layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>