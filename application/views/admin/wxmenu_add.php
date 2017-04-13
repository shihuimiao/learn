<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="/favicon.ico" >
    <link rel="Shortcut Icon" href="/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/statics/admin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/statics/admin/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/statics/admin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/statics/admin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/statics/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/statics/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/statics/admin/static/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="/statics/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <!--/meta 作为公共模版分离出去-->

    <title>基本设置</title>
</head>
<body>

<div class="page-container">
    <form class="form form-horizontal" id="form-article-add">

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">菜单级别：</label>
            <div class="formControls col-xs-8 col-sm-5"> <span class="select-box">
				<select name="menu_level" class="select" id="menu_leval">
					<option value="0">一级菜单</option>
                    <?php foreach($level_arr as $level_val){ ?>
                        <option value="<?php echo $level_val['id'] ?>">【<?php echo $level_val['name']?>】二级菜单</option>
                    <?php }?>
				</select>
				</span> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">菜单名称：</label>
            <div class="formControls col-xs-8 col-sm-5">
                <input type="text" class="input-text" value="" placeholder="" id="menu_name" name="menu_name">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">菜单类型：</label>
            <div class="formControls col-xs-8 col-sm-5"> <span class="select-box">
				<select name="menu_type" class="select" id="menu_type" onchange="change_type()">
					<option value="0">展开二级菜单</option>
                    <option value="1">跳转url</option>
                    <option value="2">点击推事件</option>
				</select>
				</span> </div>
        </div>
        <div class="row cl" style = "display:none" id="change_url">
            <label class="form-label col-xs-4 col-sm-2">请输入内容</label>
            <div class="formControls col-xs-8 col-sm-8">
                <input type="text" class="input-text" value="" placeholder="" id="content" name="content">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">排序：</label>
            <div class="formControls col-xs-8 col-sm-5">
                <input type="text" class="input-text" value="" placeholder="" id="menu_sort" name="menu_sort">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">是否隐藏：</label>
            <div class="formControls col-xs-8 col-sm-5"> <span class="select-box">
				<select name="menu_isshow" class="select" id="menu_isshow">
					<option value="0">显示</option>
                    <option value="1">隐藏</option>
				</select>
				</span> </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button class="btn btn-primary radius" type="submit" id="wxmenu_add"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
                <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>


    </form>
</div>


<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/statics/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/statics/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/statics/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/statics/admin/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/statics/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/statics/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/statics/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/statics/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/statics/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(function(){
        $("#wxmenu_add").click(function(){
            var menu_type = $("#menu_type").val();
            var content = '';
            if(menu_type != 0){
                content = $("#content").val();
            }
            $.ajax({
                url:'/adminajax/wxaccount/wxmenuadd',// 跳转到 action
                data:{
                    menu_level : $("#menu_leval").val(),
                    menu_name : $("#menu_name").val(),
                    menu_type : $("#menu_type").val(),
                    menu_sort : $("#menu_sort").val(),
                    menu_isshow : $("#menu_isshow").val(),
                    content : content,
                },
                type:'post',
                cache:false,
                dataType:'json',
                success:function(data) {
                    if(data.errno == 0){
                        alert(data.data);
                        location.replace(location.href);
                    }else{
                        alert(data.data);
                    }
                },
                error : function() {
                    alert("异常！");
                }
            });

            return false;
        });

    });

    function change_type(){
        console.log($("#menu_type").val());
        if($("#menu_type").val() !=0 ){
            $("#change_url").css('display','block');
        }else{
            $("#change_url").css('display','none');
        }
    }

</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>