<?php
require_once "../../conf/env.php";

session_start();
session_unset();
session_destroy();

header('Location: '.URL_VISTAS.'login.php');