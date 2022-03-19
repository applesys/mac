<?php if ($_REQUEST['seq'] == 'yes') { ?>
<input id="enterSeq" type="text" style="width:72%;" placeholder="List the GET command sequences" value="" onkeydown="if (event.keyCode == 13) {
    seq(enterSeq.value);
    window.location.href = 'index.php';
}">
<input type="button" class="actionButtonGreen" onmouseover="playAudio(soundPlayer, 'default.flac?rev=<?=time();?>');" onclick="seq(enterSeq.value); window.location.href = 'index.php';" value=">">
<input type="button" class="actionButtonRed" onmouseover="playAudio(soundPlayer, 'default.flac?rev=<?=time();?>');" onclick="window.location.href='?seq=no';" value="!">
<?php } else { ?>
<select id="enterKey" onchange="
var curSys = getButton.name;
var keyVal = enterKey.options[enterKey.selectedIndex].value;
if (keyVal == 'i') {
    enterPkg.value = 'from';
    enterRepo.value = '';
    enterUser.value = '';
} else if (keyVal == 'r') {
    enterPkg.value = curSys;
    enterRepo.value = '';
    enterUser.value = '';
} else if (keyVal == 'd') {
    enterPkg.value = '';
    enterRepo.value = 'from';
    enterUser.value = 'here';
}">
<option value='i'>Install</option>
<option value='r'>Replace</option>
<option value='d'>Remove</option>
</select>
<input type="text" id="enterPkg" style="width:20%;" placeholder="Package" value="from">
<input type="text" id="enterRepo" style="width:20%;" placeholder="Repo" value="">
<input type="text" id="enterUser" style="width:20%;" placeholder="User" value="">
<input id='getButton' name="<?=file_get_contents('system.info');?>" type="button" class="actionButtonGreen" onmouseover="playAudio(soundPlayer, 'default.flac?rev=<?=time();?>');" onclick="get(enterKey.options[enterKey.selectedIndex].value,'',enterPkg.value,enterRepo.value,'',enterUser.value); window.location.href = 'index.php';" value=">">
<input type="button" class="actionButtonRed" onmouseover="playAudio(soundPlayer, 'default.flac?rev=<?=time();?>');" onclick="window.location.href='?seq=yes';" value="!">
<?php } ?>
