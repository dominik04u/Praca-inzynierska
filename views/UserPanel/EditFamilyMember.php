<?php
require_once 'resources/menus/applicationMenu.php';
if (isset($this->message))
    if($this->message=="Sukces")
        echo '<div class="alert alert-dismissible alert-success col-lg-4 col-lg-offset-4" align="center">
		<strong>' . $this->message. '</strong> Poprawnie dodano członka rodziny <br></div>';
    elseif($this->message=="Uwaga")
        echo '<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
		<strong>' . $this->message. '</strong> Podane opcje nie spełniają kryteriów. Dane nie zostaną zmienione <br></div>';
    else
        echo '<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
            <strong>' . $this->message . '</strong> Spróbuj jeszcze raz. <br></div>';
?>
<div class="col-lg-offset-4 col-lg-4">
    <div class="well bs-component">
        <form class="form-group" method="post">
            <fieldset>
                <legend>Dodaj członka rodziny</legend>
                <?php foreach ($this->news as $row) {
                    echo '
                <div class="form-group">
                    <label for="name" class="control-label">Imię</label>
                    <input class="form-control" id="name" name="name" type="text" required="required" value="' . $row['name'] . '">
                </div>
                <div class="form-group">
                    <label for="surname" class="control-label">Nazwisko</label>
                    <input class="form-control" id="surname" name="surname" type="text" required="required" value="' . $row['surname'] . '">
                </div>
                <div class="form-group">
                    <label for="relationship" class="control-label">Stopień pokrewieństwa</label>
                    <select class="form-control" id="relationship" name="relationship" required="required" onchange="EditFamilyMemberJSFunction(this.value)">
                        <option value=""></option>
                        <option value="Matka"'; if($row['relationship']=="Matka") {echo 'selected="selected"';} echo '>Matka</option>
                        <option value="Ojciec"'; if($row['relationship']=="Ojciec") {echo 'selected="selected"';} echo '>Ojciec</option>
                        <option value="Opiekun prawny"'; if($row['relationship']=="Opiekun prawny") {echo 'selected="selected"';} echo '>Opiekun prawny</option>
                        <option value="Współmałżonek"'; if($row['relationship']=="Współmałżonek") {echo 'selected="selected"';} echo '>Współmałżonek</option>
                        <option value="Brat"'; if($row['relationship']=="Brat") {echo 'selected="selected"';} echo '>Brat</option>
                        <option value="Siostra"'; if($row['relationship']=="Siostra") {echo 'selected="selected"';} echo '>Siostra</option>
                        <option value="Dziecko"'; if($row['relationship']=="Dziecko") {echo 'selected="selected"';} echo '>Dziecko/dziecko współmałżonka (do 26 lat)</option>
                        <option value="Dziecko niepełnosprawne"'; if($row['relationship']=="Dziecko niepełnosprawne") {echo 'selected="selected"';} echo '>Niepełnosprawne dziecko/dziecko współmałżonka</option>
                        <option value="Dziecko opiekuna"'; if($row['relationship']=="Dziecko opiekuna") {echo 'selected="selected"';} echo '>Dziecko opiekuna</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="birth" class="control-label">Data urodzenia</label>
                    <input class="form-control" id="birth" name="birth" type="text" required="required" value="' . $row['date_of_birth'] . '">
                </div>
                 <div class="form-group" style="display: none" id="querySchool">
                    <hr>
                    <label for="school" class="control-label">Czy uczy się/studiuje?</label>
                    <input type="radio" name="school" value="schoolYes" checked="checked"> TAK
                    <input type="radio" name="school" value="schoolNo"> NIE
                </div>
                <script type="text/javascript">
                    function EditFamilyMemberJSFunction(relation){
                        var list=["Brat","Siostra","Dziecko","Dziecko opiekuna"];
                        if(list.indexOf(relation)>=0){
                            document.getElementById("querySchool").style.display = "block";
                        }
                        else {
                            document.getElementById("querySchool").style.display = "none";
                        }
                    }
                </script>
                	';
                } ?>
                <div class="form-group">
                    <div class="control-label">
                        <button type="submit" class="btn btn-primary" value="editFamilyMember" name="submit">Zatwierdź
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
