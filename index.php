<?php
include 'config.php';
$dir = '.';
$list = str_replace($dir.'/','',(glob($dir.'/*.{app,pkg}', GLOB_BRACE)));
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>macOS Web</title>
<link rel="shortcut icon" href="favicon.png?rev=<?=time();?>" type="image/x-icon">
<?php include 'appstyle.php'; ?>
<script src="jquery.js?rev=<?=time();?>"></script>
<script src="base.js?rev=<?=time();?>"></script>
<script>
window.onload = function() {
    document.getElementById('enterSeq').focus();
}
</script>
</head>
<body>
<div class='top'>
<p align="center">
<?php include 'getman.php'; ?>
</p>
</div>
<div class='panel'>
<p align="center">
<?php
foreach ($list as $key=>$value) {
    $fileExt = pathinfo($value, PATHINFO_EXTENSION);
    if ($fileExt == 'app') {
        $fileContent = file_get_contents($value);
        $fileExp = explode('=||=', $fileContent);
        $fileTitle = $fileExp[0];
        $fileIcon = (file_exists($fileExp[1])) ? $fileExp[1] : 'sys.app.png';
        $fileLink = $fileExp[2];
    } elseif ($fileExt == 'pkg') {
        $packageID = basename($value, '.pkg');
        $fileTitle = 'Remove: '.$packageID;
        $fileIcon = 'sys.pkg.png';
        $fileLink = "get('d', '', '".$packageID."', 'from', '', 'here');";
    }
    
?>
<img class="hover" style="height:15%;position:relative;" title="<?=$fileTitle;?>" src="<?=$fileIcon;?>?rev=<?=time();?>" onclick="<?=$fileLink;?>">
<?php } ?>
<img class="hover" style="height:15%;position:relative;" title="Exit" src="sys.exit.png?rev=<?=time();?>" onclick="window.location.href = '../';">
</p>
</div>
<audio id="soundPlayer" <?php if (!$sounds) { ?>muted="muted"<?php } ?>>
</body>
</html>
