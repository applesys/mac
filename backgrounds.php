<?php
$background = file_get_contents('background');
$dir = '.';
$lock = ($_REQUEST['lock']) ? $_REQUEST['lock'] : 'true';
if ($lock == 'true') {
    $lockInv = 'false';
} elseif ($lock == 'false') {
    $lockInv = 'true';
}
$list = str_replace($dir.'/','',(glob($dir.'/back.*.png')));
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Backgrounds</title>
<link rel="shortcut icon" href="sys.back.png?rev=<?=time();?>" type="image/x-icon">
<?php include 'appstyle.php'; ?>
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
<select id='selectBack' onchange="set('background', selectBack.options[selectBack.selectedIndex].id);">
<?php
foreach ($list as $key=>$value) {
    $backNameBase = basename($value, '.png');
    $backNameDisp = str_replace('back.', '', $backNameBase);
?>
<option id="<?=$value;?>"><?=$backNameDisp;?></option>
<?php } ?>
</select>
<input type="button" class="actionButtonYellow" onclick="set('background', '<?=$list[0];?>');" value="<">
<input type="button" class="actionButtonGreen" onclick="window.location.href='backgrounds.php?lock=<?=$lockInv;?>';" value="!">
<input type="button" class="actionButtonRed" onclick="window.location.href = 'index.php';" value="X">
</p>
</div>
<div class='panel'>
<p align="center">
<?php
if ($lock == 'false') {
    foreach ($list as $key=>$value) {
?>
<img class="hover" style="height:15%;position:relative;" name="<?=$value;?>" title="<?=$value;?>" src="<?=$value;?>?rev=<?=time();?>" onclick="set('background', this.name);">
<?php }} ?>
</p>
</div>
</body>
</html>
