<?php
require_once 'resources/menus/applicationMenu.php';
if (isset($this->alert))
    if ($this->alert == "Sukces")
        echo '<div class="alert alert-dismissible alert-success col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->alert . '</strong> Wniosek został usunięty. <br></div>';
    else
        echo '<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->alert . '</strong> Nie udało się usunąć wniosku. <br></div>';
?>
<div class="col-lg-offset-4 col-lg-4">
    <div class="well bs-component">
        <fieldset>
            <?php
            foreach ($this->scholarship as $row) {
                echo '
                <legend>Stypendium</legend>
                <div class="form-group">
                    <label class="control-label">Stypendium podstawowe</label> ' . $row['amount'] . '
                </div>
                <div class="form-group">
                    <label class="control-label">Dodatki</label> ' . $row['addition'] . '
                </div>
                <div class="form-group">
                    <label class="control-label">Całkowita suma stypendium</label> ' . ($row['amount'] + $row['addition']) . '
                </div>
                <div class="form-group">
                    <label class="control-label">Okres przyznania</label> ' . $row['date_from'] . ' - ' . $row['date_to'] . '
                </div>';
            }
            echo '<legend>Wniosek</legend>';
            foreach ($this->application as $row) {
                echo '
                <div class="form-group">
                    <label class="control-label">Status</label> ' . $row['ap_status'] . '
                </div>
                <div class="form-group">
                    <label class="control-label">Data złożenia wniosku</label> ' . $row['app_date'] . '
                </div>
                <div class="form-group">
                    <label class="control-label">Data przyjęcia wniosku</label> ' . $row['accept_date'] . '
                </div>
                <div class="form-group">
                    <label class="control-label">Data rozpatrzenia wniosku</label> ' . $row['consider_date'] . '
                </div>';
                if ($row['ap_status'] == "Wysłano")
                    echo '
                <div class="form-group">
			        <a href="' . URL . 'UserPanel/deleteApplication/' . $row['id_application'] . '" class="btn btn-success">Usuń wniosek</a>
		        </div>
                ';
            }
            ?>
        </fieldset>
    </div>
</div>