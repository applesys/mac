<?php
$background = file_get_contents('background');
$dir = '.';
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>macOS Control Center</title>
<link rel="shortcut icon" href="sys.settings.png?rev=<?=time();?>" type="image/x-icon">
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
macOS Control Center 
<input type="button" class="actionButtonGreen" onclick="set('background', setBackField.value);" value=">">
<input type="button" class="actionButtonRed" onclick="window.location.href = 'index.php';" value="X">
</p>
</div>
<div class='panel'>
<p align="center">
<label>Background host: </label>
<input type='text' id='setBackFieldHost' style="width:25%;position:relative;" placeholder="Filename or URL" value="<?=explode('/', $background)[2];?>">
<input type='text' id='setBackFieldUser' style="width:25%;position:relative;" placeholder="Filename or URL" value="<?=explode('/', $background)[3];?>"><br>
<label>Background image: </label>
<input type='text' id='setBackFieldRepo' style="width:25%;position:relative;" placeholder="Filename or URL" value="<?=explode('/', $background)[4];?>">
<input type='text' id='setBackField' style="width:25%;position:relative;" placeholder="Filename or URL" value="<?=str_replace('back.', '', str_replace('.png?raw=true', '', explode('/', $background)[7]));?>">
</p>
</div>
</body>
</html>
