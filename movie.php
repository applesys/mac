<?php
$background = file_get_contents('background');
$name = $_REQUEST['name'];
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>QuickTime Web</title>
<link rel="shortcut icon" href="sys.vid.png?rev=<?=time();?>" type="image/x-icon">
<style>
@font-face {
    font-family: "sfuitext";
    src: url("sfuitext.ttf");
}
body {
    background-color: #e4e4e4;
    background-image: url(<?=$background;?>);
    background-size: auto 100vh;
    background-repeat: no-repeat;
    color: #000;
    font-family: "sfuitext";
    font-size: 14pt;
}
</style>
</head>
<body>
<video style="width:100%;height:100%;" id="video" src="<?=$name;?>" controls autoplay="yes">
</body>
</html>
