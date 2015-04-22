<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title><?php
    if (isset($title)) {
            echo $title;
        } else{
            echo "CoffeeBreak";
    }
    ?></title>
    <link href="/static/dist/css/materialize.min.css" rel="stylesheet" type="text/css" >
    <link href="/static/dist/css/sweet-alert.css" rel="stylesheet" type="text/css" >
<?php
if (isset($cssArray)) {
    foreach ($cssArray as $key => $value) {
        echo '<link href="'.$value.'"" rel="stylesheet" type="text/css" >'; 
    }
}
?></head>
<body>