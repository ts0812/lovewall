<?php
    session_start();
    if (isset($_SESSION['login']) && $_SESSION['login'] > 0) {
        # 如果存在登录记录则进入后台。注意：因为Cookie被微信禁用，导致$_SESSION，所以用微信登录是无法打开后台的。
        
    }else {
        # 使用脚本重定向回到登录界面
        $url="login.php";
        echo "<script language=\"javascript\">";
        echo "location.href=\"$url\"";
        echo "</script>";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>表白墙后台管理</title>
    <link rel="stylesheet" href="layui/css/layui.css">
</head>
<body>
    <table class="layui-table" lay-data="{height:'full-20', url:'/demo/table/user/', page:true, id:'test'}" lay-filter="test">
    <thead>
        <tr>
        <th lay-data="{field:'id', width:80, sort: true}">ID</th>
        <th lay-data="{field:'username', width:80}">用户名</th>
        <th lay-data="{field:'sex', width:80, sort: true}">性别</th>
        <th lay-data="{field:'city', width:80}">城市</th>
        <th lay-data="{field:'sign', width:177}">签名</th>
        <th lay-data="{field:'experience', width:80, sort: true}">积分</th>
        <th lay-data="{field:'score', width:80, sort: true}">评分</th>
        <th lay-data="{field:'classify', width:80}">职业</th>
        <th lay-data="{field:'wealth', width:135, sort: true}">财富</th>
        </tr>
    </thead>

    <script src="layui/layui.all.js"></script>
    <script>
        layui.use('table', function(){
            var table = layui.table;
        });
    </script>
    
</body>
</html>