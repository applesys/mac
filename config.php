<?php
$background = file_get_contents('background');
if (file_exists('sounds')) {
    $sounds = boolval(file_get_contents('sounds'));
} else {
    $sounds = false;
}
