<?php

$mod = @$_REQUEST['mod'];

switch ($mod) {
    case "home":
        require("home.php");
        break;
    case "input":
        require("input.php");
        break;
    default:
        require("home.php");
}
