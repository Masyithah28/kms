<?php

$file = $_GET['url'];

    header('Content-type: application/pdf');
    header('Content-Disposition: inline; file = "'.$file.'"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    @readfile($file);
    exit;


?>