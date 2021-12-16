<?php
$background = file_get_contents('background');
$name = $_REQUEST['name'];
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>QuickTime Web</title>
<link rel="shortcut icon" href="sys.vid.png?rev=<?=time();?>" type="image/x-icon">
<?php include 'appstyle.php'; ?>
</head>
<body>
<video style="width:100%;height:100%;" id="video" src="<?=$name;?>" controls autoplay="yes">
</body>
</html>
