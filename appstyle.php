<style>
@font-face {
    font-family: "sfuitext";
    src: url("sfuitext.ttf");
}
@font-face {
    font-family: "userdefine";
    src: url("<?=$name;?>");
}
body {
    background-color: #e4e4e4;
    background-image: url(<?=$background;?>);
    background-size: cover;
    background-repeat: no-repeat;
    color: #000;
    font-family: "sfuitext";
    font-size: 14pt;
}
font, a, p, b, i, strong, em, li {
    color: #000;
    font-family: "sfuitext";
    font-size: 14pt;
}
table, tr, td, th {
    background-color: #dcdad5;
    color: #000;
    font-family: "sfuitext";
    font-size: 14pt;
    text-align: center;
}
input, select, textarea {
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
.actionButton {
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
.actionButtonYellow {
    background: linear-gradient(to bottom, #f9d54c 0%, #ebbe14 100%);
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
.userDefine {
    font-family: "userdefine";
    font-size: 20pt;
}
.actionIcon {
    height: 86%;
    position: relative;
}
.actionIcon:hover {
    opacity: 0.7;
}
</style>
