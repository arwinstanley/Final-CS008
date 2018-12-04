<?php
$file = fopen("python/images.csv", "r");

if ($debug) {
    if ($file) {
        print '';
    } else {
        print '<p<File Open Failed.</p>';
    }
}

while (!feof($file)) {
    $images[] = fgetcsv($file);
}

$file = fopen("python/links.csv", "r");

if ($debug) {
    if ($file) {
        print '';
    } else {
        print '<p<File Open Failed.</p>';
    }
}

while (!feof($file)) {
    $links[] = fgetcsv($file);
}

$file = fopen("python/headlines.csv", "r");

if ($debug) {
    if ($file) {
        print '';
    } else {
        print '<p<File Open Failed.</p>';
    }
}

while (!feof($file)) {
    $headlines[] = fgetcsv($file);
}

$file = fopen("python/dates.csv", "r");

if ($debug) {
    if ($file) {
        print '';
    } else {
        print '<p<File Open Failed.</p>';
    }
}

while (!feof($file)) {
    $dates[] = fgetcsv($file);
}

fclose($file);
;
include ('top.php');
?>
<main id="main">
    <button class="openbtn" onclick="openNav()">&#9776; Menu </button>
    <h2>Climate</h2>
    <article>Climate change is harmful to Sea Otters and marine species. Increase in water temperature, increase in ocean acidity, and severe storms which can pollute coastal waters are all results of climate change. Extreme weather can cause damage to coral reefs, other costal systems, and coastal communities. As ocean temperatures rise, marine species migrate to cooler waters and lose their homes. Rising temperatures can directly disturb the metabolism, life cycle, and behavior of marine species. Check out New York Times articles below to learn how climate change not only affects the lives of Sea Otters and marine life.</article>
    <fieldset class='articles'>
        <legend>Latest</legend>
        <?php
        $i = 0;
        foreach ($images as $image) {
            print $dates[$i][0];
            print '<br>';
            print '<a href="' . $links[$i][0] . '">' . $headlines[$i + 1][0] . '</a>';
            print '<figure>';
            print '<a href="' . $links[$i][0] . '">';
            print '<img alt="" src="' . $image[0] . '">';
            print '</a>';
            print '</figure>' . PHP_EOL;
            $i++;
        }
        ?>
    </fieldset>
    <fieldset class='videos'>
        <legend>Videos</legend>
        <h3>Sweet Shell Smashers! | Amazing Animal Babies: Sea Otters | Earth Unplugged</h3>
        <iframe width="420" height="345" src="https://www.youtube.com/embed/8h_ifQndFCo">
        </iframe>
        <h3>Warming oceans and marine species migration: poleward bound</h3>
        <iframe width="420" height="345" src="https://www.youtube.com/embed/dUdd83_pzdE">
        </iframe>
    </fieldset>
    <?php include ('footer'); ?>
</main>

</body>
</html>