<?php

require_once 'resources/menus/adminMenu.php';

if (isset($this->news)) {

    foreach ($this->news as $row) {
        echo '<div class="well col-lg-6 col-lg-offset-3">';
        echo '
            <i><h6><p class="text-muted">' . $row['create_date'] . '</p></h6> </i>
            <b><h4>' . $row['title'] . '</h4></b>
            <p>' . $row['news_text'] . '</p>

            <a href="'.URL.'adminPanel/deleteNews/' . $row['id_news'] . '" class="btn btn-danger">Usuń</a>
            <a href="'.URL.'adminPanel/editNews/' . $row['id_news'] . '" class="btn btn-primary">Edytuj</a>

	        <br>';
        echo '</div>';
    }
}