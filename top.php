<?php
$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

$path_parts = pathinfo($phpSelf);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Save the Sea Otters</title>

        <meta charset="utf-8">
        <meta name="author" content="Shauna Kimura, Alex Winstanley, Rachel Liston">
        <meta name="description" content="CS008 Final Project">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../cssfinalproject/custom.css?version=1.0" type="text/css" media="screen">
        
        <?php
    print '<body id="' . $path_parts['filename'] . '">' . PHP_EOL;

    include 'header.php';
    print PHP_EOL;

    include 'nav.php';
    print PHP_EOL;

    if ($debug) {
        print '<p>DEBUG MODE IS ON</p>';
    }

    print "<!-- End of top.php -->";
    ?>