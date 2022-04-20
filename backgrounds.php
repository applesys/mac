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
$list = str_replace($dir.'/','',(glob($dir.'/back.*.png')));
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Backgrounds</title>
<link rel="shortcut icon" href="sys.back.png?rev=<?=time();?>" type="image/x-icon">
<?php include 'appstyle.php'; ?>
<script src="jquery.js?rev=<?=time();?>"></script>
<script src="base.js?rev=<?=time();?>"></script>
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
<input type="button" class="actionButtonYellow" onmouseover="playAudio(soundPlayer, '<?=$soundlib[rand(0,$soundct)];?>?rev=<?=time();?>');" onclick="set('background', '<?=$list[0];?>');" value="<">
<input type="button" class="actionButtonGreen" onmouseover="playAudio(soundPlayer, '<?=$soundlib[rand(0,$soundct)];?>?rev=<?=time();?>');" onclick="window.location.href='backgrounds.php?lock=<?=$lockInv;?>';" value="!">
<input type="button" class="actionButtonRed" onmouseover="playAudio(soundPlayer, '<?=$soundlib[rand(0,$soundct)];?>?rev=<?=time();?>');" onclick="window.location.href = 'index.php';" value="X">
</p>
</div>
<?php if ($lock == 'false') { ?>
<div class='panel'>
<p align="center">
<?php foreach ($list as $key=>$value) { ?>
<img class="hover" style="height:15%;position:relative;" name="<?=$value;?>" title="<?=$value;?>" src="<?=$value;?>?rev=<?=time();?>" onclick="set('background', this.name);">
<?php } ?>
</p>
</div>
<?php } ?>
<audio id="soundPlayer" <?php if (!$sounds) { ?>muted="muted"<?php } ?>>
</body>
</html>
