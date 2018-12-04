<?php
/*
 * this demo modifies the code from Uvm Web tools: 
 * http://www.uvm.edu/webguide/tools/?Page=photogallery.html
 * 
 * for this responsive slider the images must be large enough to fit on a full 
 * size screen mine are 1200px wide. smaller images get resized to fit the full
 * window. so a small 400px wide image woudl be stretched to 1200px wide or 
 * whatever the size of the monitor is.
 * 
 * 
 * Added to this sample is using php to get a list of images in a folder so all
 * you do to update the slide is change the images in the folder. to change the
 * order just change the file names as they will be abc order. Notice the source
 * code has the images in a different order than the first example
 */

// this function gets all the jpg and png images locaged in the $url
// It returns an array with the image names. folder must not have an index file
function getFileList($url, $extensions = array("jpg", "png")) {
    $outputBuffer = array();

    $dir = scandir($url);

    if (count($dir) > 0) {
        //Start at index 2, to ignore the ".." and "." folders
        for ($i = 2; $i < count($dir); $i++) {
            //Only add files to the image array that have the expected extension
            $ext = pathinfo($dir[$i], PATHINFO_EXTENSION);
            if (in_array($ext, $extensions)) {
                array_push($outputBuffer, $dir[$i]);
            }
        }
    }

    return $outputBuffer;
}

// folder that has the images. you can add a path if needed
$url = "images";

//This array has all our images in it
$images = getFileList($url);

include('top.php');
?>


<main id="main">

   
    <button class="openbtn" onclick="openNav()">&#9776; Menu</button> 
    <h2>Gallery</h2>

    <div class="flexslider">
        <ul class="slides">   
            <li><img src="images/slide_1.jpg" alt="" class="rotating-item"></li>
            <li><img src="images/slide_2.jpg" alt="" class="rotating-item"></li>
            <li><img src="images/slide_3.jpg" alt="" class="rotating-item"></li>
            <li><img src="images/slide_4.jpg" alt="" class="rotating-item"></li>
            <li><img src="images/slide_5.jpg" alt="" class="rotating-item"></li> 
            <li><img src="images/slide_6.jpg" alt="" class="rotating-item"></li>
        </ul>
    </div>
    <?php include 'footer.php'; ?>


</main>
</body>


</html>