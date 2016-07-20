<?php
require_once 'resources/menus/loginMenu.php';
if (isset($this->news)) {
    foreach ($this->news as $row) {
        echo '<div class="well col-lg-6 col-lg-offset-3">';
        echo '
            <i><h6><p class="text-muted">' . $row['send_date'] . '</p></h6> </i>

            <p>' . $row['msg_text'] . '</p>
	        <br><br>';
        echo '</div>';
    }
}
?>