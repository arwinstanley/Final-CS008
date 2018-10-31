<?php
$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

$path_parts = pathinfo($phpSelf);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Save the Blue Whales</title>

        <meta charset="utf-8">
        <meta name="author" content="Shauna Kimura, Alex Winstanley, Rachel Liston">
        <meta name="description" content="Save the Blue Whales Final Project">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../css/custom.css?version=1.0" type="text/css" media="screen">
        <?php
        include 'header.php';
        ?>