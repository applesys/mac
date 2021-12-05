<?php
$background = file_get_contents('background');
$dir = ($_REQUEST['dir']) ? $_REQUEST['dir'] : '.';
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
<style>
@font-face {
    font-family: "sfuitext";
    src: url("sfuitext.ttf");
}
@font-face {
    font-family: "libsans";
    src: url("libsans.ttf");
}
body {
    background-color: #e4e4e4;
    background-image: url(<?=$background;?>);
    background-size: auto 100vh;
    background-repeat: no-repeat;
    color: #000;
    font-family: "sfuitext";
    font-size: 14pt;
}
a, p, table, tr, td, th {
    background-color: #dcdad5;
    color: #000;
    font-family: "libsans";
    font-size: 14pt;
    text-align: center;
}
input {
    background-color: #fff;
    color: #000;
    border: none;
    border-radius: 5px;
    font-family: "sfuitext";
    font-size: 14pt;
}
.top {
    background-color: #e4e4e4;
    border: none;
    border-radius: 5px;
    opacity: 0.75;
    position: absolute;
    width: 92%;
    height: 13%;
    top: 4%;
    left: 4%;
}
.panel {
    background-color: #e4e4e4;
    border: none;
    border-radius: 5px;
    opacity: 0.75;
    position: absolute;
    width: 92%;
    height: 77%;
    top: 17%;
    left: 4%;
    overflow-y: scroll;
}
.hover:hover {
    opacity: 0.7;
    position: relative;
}
.actionButtonGreen {
    background: linear-gradient(to bottom, #28ce53 0%, #1dbd3a 100%);
    background-size: 100%;
    color: #fff;
    border: none;
    border-radius: 5px;
    width: 29px;
    height: 28px;
    font-family: "sfuitext";
    font-weight: bold;
    font-size: 14pt;
    position: relative;
}
.actionButtonRed {
    background: linear-gradient(to bottom, #f3123b 0%, #ed1157 100%);
    background-size: 100%;
    color: #fff;
    border: none;
    border-radius: 5px;
    width: 29px;
    height: 28px;
    font-family: "sfuitext";
    font-weight: bold;
    font-size: 14pt;
    position: relative;
}
</style>
<script src="jquery.js"></script>
<script src="base.js"></script>
<script src="sort.js"></script>
<script src="http://www.midijs.net/lib/midi.js"></script>
<script>
window.onload = function() {
    document.getElementById('search').focus();
}
function find() {
    var dir = search.name;
    var q = search.value;
    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            window.location.href = "finder.php?dir="+dir+"&q="+q;
        }
    }
    xmlhttp.open("GET","finder.php?dir="+dir+"&q="+q,false);
    xmlhttp.send();
}
function del(name) {
    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            document.location.reload();
        }
    }
    xmlhttp.open("POST","delete.php?name="+name,false);
    xmlhttp.send();
}
function playAudio(name) {
    audioPlayer.src = name;
    audioPlayer.play();
}
function pauseAudio() {
    audioPlayer.pause();
}
function playMIDI(id) {
    MIDIjs.play(id);
}
function pauseMIDI(id) {
    MIDIjs.pause(id);
}
function levelUp(dir) {
    if (dir.toString('').includes('/')) {
        var split = dir.toString('').split('/');
        var count = split.length;
        var last = count - 1;
        var link = dir.toString('').replace('/' + split[last], '');
    } else {
        var link = dir;
    }
    window.location.href = 'finder.php?dir=' + link;
}
</script>
</head>
<body onload="search.focus();">
<div class='top'>
<p align="center">
<input type="text" id="search" onkeydown="
if (event.keyCode == 13) {
    find();
}" style="width:60%;" name="<?=$dir;?>" placeholder="Enter the search query" value="">
<input type="button" class="actionButtonGreen" onclick="find();" value=">">
<input type="button" class="actionButtonRed" name="<?=$dir;?>" onclick="levelUp(this.name);" value="<">
<input type="button" class="actionButtonRed" onclick="window.location.href = 'index.php';" value="X">
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
            $link = "javascript:get('d', '".$basename."', 'from', 'here');";
            $type = 'Package';
        } elseif ($extension == 'app') {
            $appOpen = file_get_contents($value);
            $appDel = explode('=||=', $appOpen);
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
            $link = "javascript:playAudio('".$dir.'/'.$value."');";
            $type = 'Audio';
        } elseif ($extension == 'mp4' || $extension == 'mkv' || $extension == 'webm' || $extension == 'mpg' || $extension == 'mpeg' || $extension == 'avi' || $extension == 'wmv') {
            $icon = 'sys.vid.png';
            $link = "movie.php?name=".$dir.'/'.$value;
            $type = 'Video';
        } elseif ($extension == 'ttf' || $extension == 'otf' || $extension == 'ttc' || $extension == 'woff2') {
            $icon = 'sys.fon.png';
            $link = "fontbook.php?name=".$dir.'/'.$value;
            $type = 'Font';
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
<img width="80%" src="<?=$icon;?>?rev=<?=time();?>">
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
<img width="40%" src="sys.edit.png?rev=<?=time();?>" title="Edit" name="<?=$dir.'/'.$value;?>" onclick="window.location.href = 'textedit.php?name=' + this.name + '&lock=true';">
<img width="40%" src="sys.rm.png?rev=<?=time();?>" title="Delete" name="<?=$dir.'/'.$value;?>" onclick="del(this.name);">
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<audio id="audioPlayer">
</body>
</html>
