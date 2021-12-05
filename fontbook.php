<?php
$background = file_get_contents('background');
$name = $_REQUEST['name'];
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Font Book</title>
<link rel="shortcut icon" href="sys.fon.png?rev=<?=time();?>" type="image/x-icon">
<style>
@font-face {
    font-family: "userdefine";
    src: url("<?=$name;?>");
}
body {
    background-color: #e4e4e4;
    background-image: url(<?=$background;?>);
    background-size: auto 100vh;
    background-repeat: no-repeat;
    color: #000;
    font-family: "userdefine";
    font-size: 14pt;
}
.userDefine {
    font-family: "userdefine";
    font-size: 20pt;
}
.top {
    background-color: #e4e4e4;
    border: none;
    border-radius: 5px;
    opacity: 0.75;
    position: absolute;
    width: 92%;
    height: 13%;
    top: 4%;
    left: 4%;
}
.panel {
    background-color: #e4e4e4;
    border: none;
    border-radius: 5px;
    opacity: 0.75;
    position: absolute;
    width: 92%;
    height: 77%;
    top: 17%;
    left: 4%;
    overflow-y: scroll;
}
.actionButtonRed {
    background: linear-gradient(to bottom, #f3123b 0%, #ed1157 100%);
    background-size: 100%;
    color: #fff;
    border: none;
    border-radius: 5px;
    width: 29px;
    height: 28px;
    font-family: "userdefine";
    font-weight: bold;
    font-size: 14pt;
    position: relative;
}
</style>
</head>
<body>
<div class='top'>
<p align="center">
Font Preview: <?=$name;?> 
<input type="button" class="actionButtonRed" onclick="window.location.href = 'index.php';" value="<">
</p>
</div>
<div class='panel'>
<p class='userDefine'>
0 1 2 3 4 5 6 7 8 9 A B C D E F G H I J K L M N O P Q R S T U V W X Y Z a b c d e f g h i j k l m n o p q r s t u v w x y z
</p>
</div>
</body>
</html>
