<?php
    session_start();
    session_destroy();
    header('Location: /LoginPage/login.php');
    exit;