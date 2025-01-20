<?php

// hapus sesion
session_start();
session_unset();
session_destroy();

// redirect ke login.php
header('Location: login.php');
