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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
    <span class="c-gray en">&gt;</span>
    公众号管理
    <span class="c-gray en">&gt;</span>
    基本设置
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
    <form class="form form-horizontal" id="form-article-add">
        <div id="tab-system" class="HuiTab">
            <div class="tabBar cl">
                <span>基本设置</span>
                <span>自定义菜单</span>
                <span>邮件设置</span>
                <span>其他设置</span>
            </div>
            <div class="tabCon">
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2">
                        <span class="c-red">*</span>
                        网站名称：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" id="website-title" placeholder="控制在25个字、50个字节以内" value="<?php echo $account_info['wx_name'] ?>" class="input-text">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2">
                        <span class="c-red">*</span>
                        描述：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" id="website-description" placeholder="空制在80个汉字，160个字符以内" value="<?php echo $account_info['descript']; ?>" class="input-text">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2">
                        <span class="c-red">*</span>
                        Token：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" id="wx_token" placeholder="自定义的token" value="<?php echo $account_info['token']?>" class="input-text">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2">
                        <span class="c-red">*</span>
                        WxAccount：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" id="wx_accountnum" placeholder="公众号原始ID" value="<?php echo $account_info['wx_account']?>" class="input-text">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2">
                        <span class="c-red">*</span>
                        Appid：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" id="wx_appid" placeholder="Appid" value="<?php echo $account_info['appid']?>" class="input-text">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2">
                        <span class="c-red">*</span>
                        Appsecret：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" id="wx_appsecret" placeholder="Appsecret" value="<?php echo $account_info['appsecret']?>" class="input-text">
                    </div>
                </div>
                <div class="row cl">
                    <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                        <button id="account_info_submit" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
                        <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
                    </div>
                </div>
            </div>
            <div class="tabCon">
                <!--start 自定义菜单-->
                <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="wxmenu_add('新增菜单','wxmenuadd','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 新增菜单</a> <a href="javascript:;" onclick="wxmenu_load()" class="btn btn-success radius"><i class="Hui-iconfont">&#xe6a7;</i> 生成菜单</a></span></div>
                <div class="mt-20">
                    <table class="table table-border table-bordered table-hover table-bg table-sort">
                        <thead>
                        <th >ID</th>
                        <th >名称</th>
                        <th >菜单等级</th>
                        <th >菜单类型</th>
                        <th >内容</th>
                        <th >是否显示</th>
                        <th >创建时间</th>
                        <th >操作</th>
                        </thead>
                    </table>
                </div>
                <!--end 自定义菜单-->
            </div>
            <div class="tabCon">
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2">邮件发送模式：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text"  class="input-text" value="" id="" name="">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2">SMTP服务器：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" id="" value="" class="input-text">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2">SMTP 端口：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" class="input-text" value="25" id="" name="" >
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2">邮箱帐号：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" class="input-text" value="5" id="emailName" name="emailName" >
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2">邮箱密码：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="password" id="email-password" value="" class="input-text">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2">收件邮箱地址：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" id="email-address" value="" class="input-text">
                    </div>
                </div>
            </div>
            <div class="tabCon">
            </div>
        </div>

    </form>
</div>

<input type="text"  value="<?php echo $account_info['id'];?>" id="account_id" style="display:none" >

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
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });
        $.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");


        $("#account_info_submit").click(function(){
            var website_title = $("#website-title").val();
            var website_description = $("#website-description").val();
            var wx_token = $("#wx_token").val();
            var wx_appid = $("#wx_appid").val();
            var wx_appsecret = $("#wx_appsecret").val();
            var wx_accountnum = $("#wx_accountnum").val();
            var id = $('#account_id').val();

            $.ajax({
                url:'/adminajax/wxaccount/accountsubmit',// 跳转到 action
                data:{
                    website_title : website_title,
                    website_description : website_description,
                    wx_token : wx_token,
                    wx_appid : wx_appid,
                    wx_appsecret : wx_appsecret,
                    wx_accountnum : wx_accountnum,
                    id : id,
                },
                type:'post',
                cache:false,
                dataType:'json',
                success:function(data) {
                    if(data.errno == 0){
                        alert(data.data);
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

        $('.table-sort').dataTable({
            "bProcessing": true, //开启读取服务器数据时显示正在加载中……特别是大数据量的时候，开启此功能比较好
            "bServerSide": true, //开启服务器模式，使用服务器端处理配置datatable。注意：sAjaxSource参数也必须被给予为了给datatable源代码来获取所需的数据对于每个画。 这个翻译有点别扭。开启此模式后，你对datatables的每个操作 每页显示多少条记录、下一页、上一页、排序（表头）、搜索，这些都会传给服务器相应的值。
            "bFilter" : false,//是否启用内置搜索功能：可以跨列搜索。
            "bSort" : true,//否开启列排序功能，如果想禁用某一列排序，可以在每列设置使用bSortable参数
            "aaSorting": [[ 0, "asc" ]],//默认第几个排序
            "bStateSave": false,//状态保存
            "sServerMethod" : "POST",//数据获取方式   POST/GET，默认是GET
            "aLengthMenu" : [ [ 10, 20 ], [ "10", "20" ] ],  //允许用户选择每页显示多少条记录
            "oLanguage" : {
                "sLengthMenu" : "每页显示 _MENU_ 条记录",
                "sZeroRecords" : "对不起，没有匹配的数据",
                "sInfo" : "第 _START_ - _END_ 条 / 共 _TOTAL_ 条数据",
                "sInfoEmpty" : "没有匹配的数据",
                "sProcessing" : "正在加载中...",
                "oPaginate" : {
                    "sFirst" : "第一页",
                    "sPrevious" : " 上一页 ",
                    "sNext" : " 下一页 ",
                    "sLast" : " 最后一页 "
                }
            },
            "aoColumns" : [
                {
                    "mData" : 'id',
                    //"sTitle" : "ID",
                    "bSortable" : true
                },{
                    "mData" : 'name',
                    //"sTitle" : "Token",
                    "bSortable" : false
                },{
                    "mData" : 'level',
                    //"sTitle" : "公众号",
                    "bSortable" : false,
                    "mRender" : function(data, type, row) {
                        return data;
                    }
                },{
                    "mData" : 'menu_type',
                    // "sTitle" : "Appid",
                    "bSortable" : false
                },{
                    "mData" : 'content',
                    // "sTitle" : "Appid",
                    "bSortable" : false
                },{
                    "mData" : 'is_show',
                    // "sTitle" : "Appsecret",
                    "bSortable" : false
                },{
                    "mData" : 'create_time',
                    // "sTitle" : "创建时间",
                    "bSortable" : false
                },{
                    "mData" : 'id',
                    "bSortable" : false,
                    "mRender" : function (data,type,row){
                        return '<a title="编辑" href="javascript:;" onclick="member_edit(\'编辑\',\'/admin/wxaccount/info?id=\','+data+')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="wxmenu_del(this,'+data+')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>';
                    }
                }],
            "sAjaxSource": "/adminajax/wxaccount/wxmenulist", //给服务器发请求的url

        });


    });

    /*新增菜单*/
    function wxmenu_add(title,url,w,h){
        layer_show(title,url,w,h);

    }

    function wxmenu_load(){
        layer.confirm('确认要生成吗？',function(){
            var id = $('#account_id').val();
            $.ajax({
                type: 'POST',
                url: '/adminajax/wxaccount/wxmenuload',
                data : {id:id},
                dataType: 'json',
                success: function(data){
                    if(data.errno==0){
                        layer.msg('成功!',{icon:1,time:1000});
                    }else{
                        layer.msg('失败!',{icon:1,time:1000});
                    }
                },
                error:function(data) {
                    console.log(data);
                },
            });
        });
    }

    function wxmenu_del(obj,id){
        layer.confirm('确认要删除吗？',function(){
            $.ajax({
                type: 'POST',
                url: '/adminajax/wxaccount/wxmenudel',
                data : {id:id},
                dataType: 'json',
                success: function(data){
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                },
                error:function(data) {
                    console.log(data.msg);
                },
            });
        });
    }
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>