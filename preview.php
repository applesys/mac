<?php
$background = file_get_contents('background');
$dir = '.';
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Background Preview</title>
<link rel="shortcut icon" href="sys.img.png?rev=<?=time();?>" type="image/x-icon">
<style>
@font-face {
    font-family: "sfuitext";
    src: url("sfuitext.ttf");
}
@font-face {
    font-family: "libsans";
    src: url("libsans.ttf");
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
input {
    background-color: #fff;
    color: #000;
    border: none;
    border-radius: 5px;
    font-family: "sfuitext";
    font-size: 14pt;
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
.actionButtonGreen {
    background: linear-gradient(to bottom, #28ce53 0%, #1dbd3a 100%);
    background-size: 100%;
    color: #fff;
    border: none;
    border-radius: 5px;
    width: 29px;
    height: 28px;
    font-family: "sfuitext";
    font-weight: bold;
    font-size: 14pt;
    position: relative;
}
.actionButtonRed {
    background: linear-gradient(to bottom, #f3123b 0%, #ed1157 100%);
    background-size: 100%;
    color: #fff;
    border: none;
    border-radius: 5px;
    width: 29px;
    height: 28px;
    font-family: "sfuitext";
    font-weight: bold;
    font-size: 14pt;
    position: relative;
}
</style>
</head>
<body>
<div class='top'>
<p align="center">
Background Preview
<input type="button" class="actionButtonGreen" name="<?=$background;?>" onclick="window.location.href = this.name;" value=">">
<input type="button" class="actionButtonRed" onclick="window.location.href = 'index.php';" value="<">
</p>
</div>
</body>
</html>
