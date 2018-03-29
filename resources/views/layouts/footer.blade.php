<footer><span class="fa fa-copyright"></span> <?php
    //An script to generate the copyright date using the server's year
    $fromYear = 2018;
    $thisYear = (int)date('Y');
    echo $fromYear . (($fromYear != $thisYear) ? '-' . $thisYear : '');?> <a href="https://github.com/daveroverts/Sweatbox-Calendar/">Sweatbox Calendar</a>, created by <a href="https://github.com/daveroverts/">Dave Roverts</a>.
</footer>