<?php
$dir = '.';
$lock = ($_REQUEST['lock']) ? $_REQUEST['lock'] : 'true';
$background = file_get_contents('background');
include 'syspkg.php';
if ($lock == 'true') {
    $lockInv = 'false';
} elseif ($lock == 'false') {
    $lockInv = 'true';
}
$bgfile = file_get_contents('https://github.com/applesys/wmac/blob/main/backgrounds?raw=true');
$list = explode(';', $bgfile);
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>macOS Wallpapers</title>
<link rel="shortcut icon" href="sys.back.png?rev=<?=time();?>" type="image/x-icon">
<?php include 'appstyle.php'; ?>
<?php include 'include.php'; ?>
</head>
<body>
<div class='top'>
<p align="center">
<select id='selectBack' onchange="set('background', selectBack.options[selectBack.selectedIndex].id);">
<?php
foreach ($list as $key=>$value) {
    $bguri = 'https://github.com/applesys/wmac/blob/main/back.'.$value.'.png?raw=true';
?>
<option id="<?=$bguri;?>"><?=$value;?></option>
<?php } ?>
</select>
<input type="button" class="actionButtonYellow" onmouseover="playAudio(soundPlayer, '<?=$soundlib[rand(0,$soundct)];?>?rev=<?=time();?>');" onclick="set('background', '<?=$list[0];?>');" value="<">
<input type="button" class="actionButtonGreen" onmouseover="playAudio(soundPlayer, '<?=$soundlib[rand(0,$soundct)];?>?rev=<?=time();?>');" onclick="window.location.href='backgrounds.php?lock=<?=$lockInv;?>';" value="!">
<input type="button" class="actionButtonRed" onmouseover="playAudio(soundPlayer, '<?=$soundlib[rand(0,$soundct)];?>?rev=<?=time();?>');" onclick="window.location.href = 'index.php';" value="X">
</p>
</div>
<?php if ($lock == 'false') { ?>
<div class='panel'>
<p align="center">
<?php
foreach ($list as $key=>$value) {
    $bguri = 'https://github.com/applesys/wmac/blob/main/back.'.$value.'.png?raw=true';
?>
<img class="hover" style="height:15%;position:relative;" name="<?=$value;?>" title="<?=$value;?>" src="<?=$bguri;?>" onclick="set('background', this.name);">
<?php } ?>
</p>
</div>
<?php } ?>
<audio id="soundPlayer" <?php if (!$sounds) { ?>muted="muted"<?php } ?>>
</body>
</html>
