<?php
    session_start();
    unset ($_SESSION ["email"]);
    unset ($_SESSION ["us_nome"]);
    unset ($_SESSION ["tipo"]);
    session_destroy();

    header("Location: index.php");
    exit;

?>