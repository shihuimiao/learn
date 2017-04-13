<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
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
    <title>用户管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">

    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a href="javascript:;" onclick="member_add('添加用户','member-add.html','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a></span> <span class="r">共有数据：<strong>88</strong> 条</span> </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <th ><input type="checkbox" name="" value=""></th>
            <th >ID</th>
            <th >Token</th>
            <th >公众号</th>
            <th >Appid</th>
            <th >Appsecret</th>
            <th >创建时间</th>
            <th >操作</th>
            </thead>

        </table>
    </div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/statics/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/statics/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/statics/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/statics/admin/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/statics/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/statics/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/statics/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    $(function(){
        $('.table-sort').dataTable({
            "bProcessing": true, //开启读取服务器数据时显示正在加载中……特别是大数据量的时候，开启此功能比较好
            "bServerSide": true, //开启服务器模式，使用服务器端处理配置datatable。注意：sAjaxSource参数也必须被给予为了给datatable源代码来获取所需的数据对于每个画。 这个翻译有点别扭。开启此模式后，你对datatables的每个操作 每页显示多少条记录、下一页、上一页、排序（表头）、搜索，这些都会传给服务器相应的值。
            "bFilter" : false,//是否启用内置搜索功能：可以跨列搜索。
            "bSort" : true,//否开启列排序功能，如果想禁用某一列排序，可以在每列设置使用bSortable参数
            "aaSorting": [[ 1, "desc" ]],//默认第几个排序
            "bStateSave": false,//状态保存
            "sServerMethod" : "POST",//数据获取方式   POST/GET，默认是GET
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                //{"orderable":false,"aTargets":[1,2,3]}// 制定列不参与排序
            ],
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
                "sTitle" : '<input type="checkbox" name="" value="0">',
                "bSortable" : false,
                "mRender" : function(data,type,row){
                    return '<input type="checkbox" name="" value="'+data+'">';
                }
            },
            {
                "mData" : 'id',
                //"sTitle" : "ID",
                "bSortable" : true
            },{
                "mData" : 'token',
                //"sTitle" : "Token",
                "bSortable" : false
            },{
                "mData" : 'wx_account',
                //"sTitle" : "公众号",
                "bSortable" : false,
                "mRender" : function(data, type, row) {
                    return data;
                }
            },{
                "mData" : 'appid',
               // "sTitle" : "Appid",
                "bSortable" : false
            },{
                "mData" : 'appsecret',
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
                    return '<a title="编辑" href="javascript:;" onclick="member_edit(\'编辑\',\'/admin/wxaccount/info?id=\','+data+')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,\'1\')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>';
                }
            }],
            "sAjaxSource": "/adminajax/wxaccount/wxaccountlist", //给服务器发请求的url

        });

    });
    /*用户-添加*/
    function member_add(title,url,w,h){
        layer_show(title,url,w,h);
    }
    /*用户-查看*/
    function member_show(title,url,id,w,h){
        layer_show(title,url,w,h);
    }

    /*用户-启用*/
    function member_start(obj,id){
        layer.confirm('确认要启用吗？',function(index){
            $.ajax({
                type: 'POST',
                url: '',
                dataType: 'json',
                success: function(data){
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                    $(obj).remove();
                    layer.msg('已启用!',{icon: 6,time:1000});
                },
                error:function(data) {
                    console.log(data.msg);
                },
            });
        });
    }
    /*用户-编辑*/
    function member_edit(title,url,id){
        url = url+id;
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*密码-修改*/
    function change_password(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                type: 'POST',
                url: '',
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
</body>
</html>