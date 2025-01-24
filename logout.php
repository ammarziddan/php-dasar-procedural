<?php

// hapus sesion
session_start();
session_unset();
session_destroy();

// hapus cookie remember
setcookie('id', '', time() - 3600);
setcookie('key', '', time() - 3600);

// redirect ke login.php
header('Location: login.php');
