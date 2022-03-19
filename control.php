<?php
include 'config.php';
$dir = '.';
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>macOS Control Center</title>
<link rel="shortcut icon" href="sys.settings.png?rev=<?=time();?>" type="image/x-icon">
<?php include 'appstyle.php'; ?>
<script src="jquery.js?rev=<?=time();?>"></script>
<script src="base.js?rev=<?=time();?>"></script>
</head>
<body>
<div class='top'>
<p align="center">
macOS Control Center 
<input type="button" class="actionButtonGreen" onmouseover="playAudio(soundPlayer, 'default.flac?rev=<?=time();?>');" onclick="set('background', setBackField.value);" value=">">
<input type="button" class="actionButtonRed" onmouseover="playAudio(soundPlayer, 'default.flac?rev=<?=time();?>');" onclick="window.location.href = 'index.php';" value="X">
</p>
</div>
<div class='panel'>
<p align="center">
<label>Background image: </label><br>
<textarea id='setBackField' style="width:82%;height:32%;" placeholder="Filename or URL" onkeydown="if (event.keyCode == 13) {
    set('background', setBackField.value);
}"><?=$background;?></textarea>
</p>
</div>
</body>
</html>
