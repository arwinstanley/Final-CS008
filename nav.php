<!-- ######################     Main Navigation   ########################## -->
<nav>
    <ol>
        <?php
        print '<li class="';
        if ($path_parts['filename'] == "index") {
            print ' activePage ';
        }
        print '">';
        print '<a href="index.php">Home</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "about") {
            print ' activePage ';
        }
        print '">';
        print '<a href="about.php">About</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "adopt") {
            print ' activePage ';
        }
        print '">';
        print '<a href="adopt.php">Adopt</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "donate") {
            print ' activePage ';
        }
        print '">';
        print '<a href="donate.php">Donate</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "gallery") {
            print ' activePage ';
        }
        print '">';
        print '<a href="gallery.php">Gallery</a>';
        print '</li>';
        
        print '<li class="';
        if ($path_parts['filename'] == "news") {
            print ' activePage ';
        }
        print '">';
        print '<a href="news.php">News</a>';
        print '</li>';
        ?>
    </ol>
</nav>