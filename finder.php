<?php
$dir = ($_REQUEST['dir']) ? $_REQUEST['dir'] : '.';
$background = file_get_contents('background');
include 'syspkg.php';
if ($_REQUEST) {
    $q = $_REQUEST['q'];
    if ($q != '') {
        if ($q == '/') {
            $glob = glob($dir.'/*', GLOB_ONLYDIR);
        } elseif ($q == '*') {
            $glob = glob($dir.'/*');
        } else {
            $glob = glob($dir.'/*{'.$q.'}*', GLOB_BRACE);
        }
    } else {
        $glob = glob($dir.'/*');
    }
} else {
    $glob = glob($dir.'/*');
}
$list = str_replace($dir.'/','',($glob));
usort($list, function ($a, $b) {
    $aDirMod = $GLOBALS['dir'].'/'.$a;
    $bDirMod = $GLOBALS['dir'].'/'.$b;
    $aIsDir = is_dir($aDirMod);
    $bIsDir = is_dir($bDirMod);
    if ($aIsDir === $bIsDir)
        return strnatcasecmp($aDirMod, $bDirMod);
    elseif ($aIsDir && !$bIsDir)
        return -1;
    elseif (!$aIsDir && $bIsDir)
        return 1;
});
function cutString($value, $piece) {
    return (strlen($value) > $piece) ? mb_strimwidth($value, 0, $piece, '...', 'UTF-8') : $value;
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Finder</title>
<link rel="shortcut icon" href="sys.files.png?rev=<?=time();?>" type="image/x-icon">
<?php include 'appstyle.php'; ?>
<?php include 'include.php'; ?>
<script>
window.onload = function() {
    document.getElementById('search').focus();
}
</script>
</head>
<body onload="search.focus();">
<div class='top'>
<p align="center">
<input type="text" id="search" onkeydown="
if (event.keyCode == 13) {
    fileSearch();
}" style="width:60%;" name="<?=$dir;?>" placeholder="Enter the search query" value="">
<input type="button" class="actionButtonGreen" onmouseover="playAudio(soundPlayer, '<?=$soundlib[rand(0,$soundct)];?>?rev=<?=time();?>');" onclick="fileSearch();" value=">">
<input type="button" class="actionButtonYellow" onmouseover="playAudio(soundPlayer, '<?=$soundlib[rand(0,$soundct)];?>?rev=<?=time();?>');" name="<?=$dir;?>" onclick="levelUp(this.name);" value="<">
<input type="button" class="actionButtonRed" onmouseover="playAudio(soundPlayer, '<?=$soundlib[rand(0,$soundct)];?>?rev=<?=time();?>');" onclick="window.location.href = 'index.php';" value="X">
</p>
</div>
<div class='panel'>
<table id="table" width="100%">
<thead>
<tr>
<th width="8%">Icon</th>
<th width="20%">
<a href="javascript:SortTable(1,'T');">Name</a></th>
<th width="10%">
<a href="javascript:SortTable(2,'T');">Type</a></th>
<th width="5%">
<a href="javascript:SortTable(3,'N');">Mode</a></th>
<th width="15%">Actions</th>
</tr>
</thead>
<tbody>
<?php
foreach ($list as $key=>$value) {
    $extension = pathinfo($value, PATHINFO_EXTENSION);
    $basename = basename($value, '.'.$extension);
    $size = filesize($dir.'/'.$value);
    $perms = substr(sprintf('%o', fileperms($dir.'/'.$value)), -4);
    $dispName = cutString($value, 15);
    if (is_dir($dir.'/'.$value)) {
        $icon = 'sys.dir.png';
        $link = 'finder.php?dir='.$dir.'/'.$value;
        $type = 'Directory';
    } else {
        if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'gif' || $extension == 'webp') {
            $icon = $dir.'/'.$value;
            $link = $dir.'/'.$value;
            $type = 'Image';
        } elseif ($extension == 'pkg') {
            $icon = 'sys.pkg.png';
            $link = "javascript:get('d', '', '".$basename."', 'from', '', 'here');";
            $type = 'Package';
        } elseif ($extension == 'app') {
            $appOpen = file_get_contents($value);
            $appDel = explode('|[1]|', $appOpen);
            $appTitle = $appDel[0];
            $appIcon = $appDel[1];
            $appLink = $appDel[2];
            $icon = (file_exists($appIcon)) ? $appIcon : 'sys.app.png';
            $link = "javascript:".$appLink.";";
            $type = 'App Link';
        } elseif ($extension == 'mid' || $extension == 'midi' || $extension == 'rmi') {
            $icon = 'sys.mid.png';
            $link = "javascript:playMIDI('".$dir.'/'.$value."');";
            $type = 'MIDI';
        } elseif ($extension == 'mp3' || $extension == 'aac' || $extension == 'flac' || $extension == 'mka' || $extension == 'ogg' || $extension == 'wav' || $extension == 'm4a' || $extension == 'wma') {
            $icon = 'sys.aud.png';
            $link = "javascript:playAudio(audioPlayer, '".$dir.'/'.$value."');";
            $type = 'Audio';
        } elseif ($extension == 'mp4' || $extension == 'mkv' || $extension == 'webm' || $extension == 'mpg' || $extension == 'mpeg' || $extension == 'avi' || $extension == 'wmv') {
            $icon = 'sys.vid.png';
            $link = "movie.php?name=".$dir.'/'.$value;
            $type = 'Video';
        } elseif ($extension == 'ttf' || $extension == 'otf' || $extension == 'ttc' || $extension == 'woff2') {
            $icon = 'sys.fon.png';
            $link = "fontbook.php?name=".$dir.'/'.$value;
            $type = 'Font';
        } elseif ($extension == 'hfc' || $extension == 'hash') {
            $icon = 'sys.wr.png';
            $link = "javascript:hash('out', '".$dir.'/'.$value."');";
            $type = 'Hash';
        } elseif ($extension == 'b64' || $extension == 'base64') {
            $icon = 'sys.console.png';
            $link = "javascript:base64('out', '".$dir.'/'.$value."', '".$dir.'/'.$basename.".png');";
            $type = 'Base64';
        } elseif ($extension == 'txt' || $extension == 'csv' || $extension == 'md' || $extension == 'css' || $extension == 'js') {
            $icon = 'sys.txt.png';
            $link = "textedit.php?name=".$dir.'/'.$value."&lock=true";
            $type = 'Text';
        } else {
            $icon = 'sys.exe.png';
            $link = $dir.'/'.$value;
            $type = 'Executable';
        }
    }
?>
<tr>
<td>
<a href="<?=$icon;?>">
<img width="80%" onmouseover="playAudio(soundPlayer, '<?=$soundlib[rand(0,$soundct)];?>?rev=<?=time();?>');" src="<?=$icon;?>?rev=<?=time();?>">
</a>
</td>
<td>
<a href="<?=$link;?>"><?=$dispName;?></a>
</td>
<td>
<?=$type;?>
</td>
<td>
<?=$perms;?>
</td>
<td>
<img width="40%" src="sys.edit.png?rev=<?=time();?>" onmouseover="playAudio(soundPlayer, '<?=$soundlib[rand(0,$soundct)];?>?rev=<?=time();?>');" onmouseover="playAudio(soundPlayer, 'take.flac');" title="Edit" name="<?=$dir.'/'.$value;?>"  onclick="window.location.href = 'textedit.php?name=' + this.name + '&lock=true';">
<img width="40%" src="sys.rm.png?rev=<?=time();?>" onmouseover="playAudio(soundPlayer, '<?=$soundlib[rand(0,$soundct)];?>?rev=<?=time();?>');" onmouseover="playAudio(soundPlayer, 'alert.flac');" title="Delete" name="<?=$dir.'/'.$value;?>" onclick="del(this.name);">
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<audio id="audioPlayer">
<audio id="soundPlayer" <?php if (!$sounds) { ?>muted="muted"<?php } ?>>
</body>
</html>
