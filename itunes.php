<?php
$dir = '.';
$background = file_get_contents('background');
include 'syspkg.php';
$playlists = file_get_contents('https://github.com/wholemarket/playlist/blob/main/playlists?raw=true');
$playlistArr = explode('|[1]|', $playlists);
$playlistUri = ($_REQUEST['uri']) ? $_REQUEST['uri'] : '';
if ($playlistUri != '') {
    $playlistFile = file_get_contents($playlistUri.'/playlist.pl?raw=true');
    $currentPlaylist = explode(';', $playlistFile);
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>iTunes</title>
<link rel="shortcut icon" href="sys.back.png?rev=<?=time();?>" type="image/x-icon">
<?php include 'appstyle.php'; ?>
<?php include 'base.incl.php'; ?>
<?php include 'file.incl.php'; ?>
<script>
function openPlaylist(uri)
{
    window.location.href = 'deadbeef.php?uri=' + uri;
}
</script>
</head>
<body>
<div class='top'>
<p align='center'>
<select id='musicPlaylist' onchange="openPlaylist(musicPlaylist.options[musicPlaylist.selectedIndex].id);">
<option>Current</option>
<?php
foreach ($playlistArr as $key=>$item) {
    $itemArr = explode('|[2]|', $item);
    $itemTitle = $itemArr[0];
    $itemUri = $itemArr[1];
?>
<option id="<?=$itemUri;?>"><?=$itemTitle;?></option>
<?php } ?>
</select>
<input type='button' class='actionButtonGreen' onmouseover="playAudio(soundPlayer, '<?=$soundlib[rand(0,$soundct)];?>?rev=<?=time();?>');" value="U" onclick="get('i','','from','deadbeef','','flossely',false);">
<input type='button' class='actionButtonRed' onmouseover="playAudio(soundPlayer, '<?=$soundlib[rand(0,$soundct)];?>?rev=<?=time();?>');" value="X" onclick="window.location.href = 'index.php';">
</p>
</div>
<div class='panel'>
<?php
if ($playlistUri != '') {
foreach ($currentPlaylist as $key=>$value) {
    $fullAudioUri = $playlistUri . '/' . $value . '?raw=true';
?>
<p align='center'>
<input type='button' style="width:90%;position:relative;" onmouseover="playAudio(soundPlayer, '<?=$soundlib[rand(0,$soundct)];?>?rev=<?=time();?>');" value="<?=$value;?>" onclick="playAudio(audioPlayer, '<?=$fullAudioUri;?>')">
</p>
<?php }} ?>
</div>
<audio id="audioPlayer">
<audio id="soundPlayer" <?php if (!$sounds) { ?>muted="muted"<?php } ?>>
</body>
</html>
