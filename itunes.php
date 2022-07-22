<?php
$dir = '.';
$background = file_get_contents('background');
include 'system.php';
$list = str_replace($dir.'/','',(glob($dir.'/*.pl')));
if ($_REQUEST['name']) {
    $playlistFile = $_REQUEST['name'];
    $playlistOpen = file_get_contents($playlistFile);
} else {
    $playlistFile = '';
    $playlistOpen = '';
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>iTunes</title>
<link rel="shortcut icon" href="sys.aud.png?rev=<?=time();?>" type="image/x-icon">
<?php include 'appstyle.php'; ?>
<?php include 'base.incl.php'; ?>
<?php include 'file.incl.php'; ?>
<script>
function openPlaylist(name)
{
    window.location.href = 'itunes.php?name=' + name;
}
</script>
</head>
<body>
<div class='top'>
<p align='center'>
<select id='musicPlaylist' onchange="openPlaylist(musicPlaylist.options[musicPlaylist.selectedIndex].id);">
<option>Current</option>
<?php
foreach ($list as $key=>$value) {
    $playlistID = basename($value, '.pl');
?>
<option id="<?=$value;?>"><?=ucfirst($playlistID);?></option>
<?php } ?>
</select>
<input type='button' class='actionButtonGreen' onmouseover="playAudio(soundPlayer, '<?=$soundlib[rand(0,$soundct)];?>?rev=<?=time();?>');" value="U" onclick="get('i','','from','deadbeef','','flossely',false);">
<input type='button' class='actionButtonRed' onmouseover="playAudio(soundPlayer, '<?=$soundlib[rand(0,$soundct)];?>?rev=<?=time();?>');" value="X" onclick="window.location.href = 'index.php';">
</p>
</div>
<div class='panel'>
<?php
if ($playlistOpen != '') {
    $playlistArr = explode('|[1]|', $playlistOpen);
    foreach ($playlistArr as $key=>$part) {
        $playlistDiv = explode('|[2]|', $part);
        $playlistElemTitle = $playlistDiv[0];
        $playlistElemURI = $playlistDiv[1];
?>
<p align='center'>
<input type='button' style="width:90%;position:relative;" onmouseover="playAudio(soundPlayer, '<?=$soundlib[rand(0,$soundct)];?>?rev=<?=time();?>');" value="<?=$playlistElemTitle;?>" onclick="playAudio(audioPlayer, '<?=$playlistElemURI;?>')">
</p>
<?php }} ?>
</div>
<audio id="audioPlayer">
<audio id="soundPlayer" <?php if (!$sounds) { ?>muted="muted"<?php } ?>>
</body>
</html>
