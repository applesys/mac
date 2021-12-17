<?php
$background = file_get_contents('background');
$name = $_REQUEST['name'];
$lock = $_REQUEST['lock'];
if ($lock != 'true') {
    $content = file_get_contents($name);
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Text Editor</title>
<link rel="shortcut icon" href="sys.edit.png?rev=<?=time();?>" type="image/x-icon">
<?php include 'appstyle.php'; ?>
<script src="jquery.js"></script>
<script src="base.js"></script>
<script src="edit.js"></script>
</head>
<body onload="countText();">
<div class='top'>
<img class="actionIcon" src="sys.cl.png" title="New File" id="newButton" onclick="var name = 'file'; window.location.href = 'textedit.php?name=' + name + '&lock=false';">
<img class="actionIcon" src="sys.rd.png" title="Open File" id="openButton" onclick="var name = filename.value; window.location.href = 'textedit.php?name=' + name;">
<img class="actionIcon" src="sys.wr.png" title="Save File" id="saveButton" onclick="save();">
<img class="actionIcon" src="sys.md.png" title="Create Directory" id="mkdirButton" onclick="var name = filename.value; mkdir(name);">
<img class="actionIcon" src="sys.mv.png" title="Move/Rename File" id="moveButton" onclick="var name = filename.value; var to = doto.value; move(name, to);">
<img class="actionIcon" src="sys.cp.png" title="Copy File" id="copyButton" onclick="var name = filename.value; var to = doto.value; copy(name, to);">
<img class="actionIcon" src="sys.rm.png" title="Delete File" id="deleteButton" onclick="var name = filename.value; del(name);">
<img class="actionIcon" src="sys.home.png" title="Go Home" id="homeButton" onclick="window.location.href = 'index.php';"><br>
</div>
<div class='panel'>
<label>Filename: </label>
<input class="text" size=30 id="filename" style="width:38%;" type="text" value="<?=$name;?>">
<input class="text" size=30 id="doto" style="width:38%;" type="text" value="">
<textarea class="text" id="content" style="width:100%;height:70%;" oninput="countText();"><?=$content;?></textarea><br>
<input class="text" size=30 id="findbox" style="width:36%;" type="text" value="">
<label> to </label>
<input class="text" size=30 id="replacebox" style="width:36%;" type="text" value="">
<input class="actionButtonGreen" type="button" value=">" id="replaceButton" onclick="replaceText(findbox.value); countText();">
<br>
<label id="statusBar" style="width:98%;"></label>
</div>
</body>
</html>
