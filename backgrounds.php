<?php
$background = file_get_contents('background');
$dir = '.';
$list = str_replace($dir.'/','',(glob($dir.'/back.*.png')));
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Backgrounds</title>
<link rel="shortcut icon" href="sys.back.png?rev=<?=time();?>" type="image/x-icon">
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
.hover:hover {
    opacity: 0.7;
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
<script src="jquery.js"></script>
<script src="base.js"></script>
<script>
function set(name, content) {
    var dataString = 'name=' + name + '&content=' + content;
    $.ajax({
        type: "POST",
        url: "write.php",
        data: dataString,
        cache: false,
        success: function(html) {
            window.location.reload();
        }
    });
    return false;
}
</script>
</head>
<body>
<div class='top'>
<p align="center">
Choose the background and click on it to set it
<input type="button" class="actionButtonRed" onclick="window.location.href = 'index.php';" value="<">
</p>
</div>
<div class='panel'>
<p align="center">
<?php
foreach ($list as $key=>$value) {
?>
<img class="hover" style="height:15%;position:relative;" name="<?=$value;?>" title="<?=$value;?>" src="<?=$value;?>?rev=<?=time();?>" onclick="set('background', this.name);">
<?php } ?>
</p>
</div>
</body>
</html>
