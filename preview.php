<?php
include 'config.php';
$dir = '.';
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Background Preview</title>
<link rel="shortcut icon" href="sys.preview.png?rev=<?=time();?>" type="image/x-icon">
<?php include 'appstyle.php'; ?>
<script src="jquery.js?rev=<?=time();?>"></script>
<script src="base.js?rev=<?=time();?>"></script>
</head>
<body>
<div class='top'>
<p align="center">
Background Preview
<input type="button" class="actionButtonGreen" onmouseover="playAudio(soundPlayer, 'default.flac?rev=<?=time();?>');" name="<?=$background;?>" onclick="window.location.href = this.name;" value=">">
<input type="button" class="actionButtonRed" onmouseover="playAudio(soundPlayer, 'default.flac?rev=<?=time();?>');" onclick="window.location.href = 'index.php';" value="<">
</p>
</div>
<audio id="soundPlayer" <?php if (!$sounds) { ?>muted="muted"<?php } ?>>
</body>
</html>
