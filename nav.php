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
        ?>
    </ol>
</nav>
