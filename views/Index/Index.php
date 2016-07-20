<?php

if(isset($_SESSION) && $_SESSION['privilege']=='user')
    require_once 'resources/menus/loginMenu.php';
elseif ($_SESSION['privilege']=='admin')
    require_once 'resources/menus/adminMenu.php';
else
    require_once 'resources/menus/index.php';

if (isset($this->news)) {

    foreach ($this->news as $row) {
        echo '<div class="well col-lg-6 col-lg-offset-3">';
        echo '
            <i><h6><p class="text-muted">' . $row['create_date'] . '</p></h6> </i>
            <b><h4>' . $row['title'] . '</h4></b>
            <p>' . $row['news_text'] . '</p>
	        <br><br>';
        echo '</div>';
    }
}

?>
