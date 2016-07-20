<?php
require_once 'resources/menus/applicationMenu.php';
if (isset($this->message))
    if($this->message=="Sukces")
        echo '<div class="alert alert-dismissible alert-success col-lg-4 col-lg-offset-4" align="center">
		<strong>' . $this->message. '</strong> Poprawnie dodano członka rodziny <br></div>';
    elseif($this->message=="Uwaga")
        echo '<div class="alert alert-dismissible alert-warning col-lg-4 col-lg-offset-4" align="center">
		<strong>' . $this->message. '</strong> Ta osoba nie spełnia kryteriów i nie jest liczona do gospodarstwa domowego <br></div>';
    else
        echo '<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
            <strong>' . $this->message . '</strong> Spróbuj jeszcze raz. <br></div>';
?>
<div class="col-lg-offset-4 col-lg-4">
    <div class="well bs-component">
        <form class="form-group" method="post">
            <fieldset>
                <legend>Dodaj członka rodziny</legend>
                <div class="form-group">
                    <label for="name" class="control-label">Imię</label>
                    <input class="form-control" id="name" name="name" type="text" required="required">
                </div>
                <div class="form-group">
                    <label for="surname" class="control-label">Nazwisko</label>
                    <input class="form-control" id="surname" name="surname" type="text" required="required">
                </div>
                <div class="form-group">
                    <label for="relationship" class="control-label">Stopień pokrewieństwa</label>
                    <select class="form-control" id="relationship" name="relationship" required="required" onchange="AddFamilyMemberJSFunction(this.value)">
                        <option value=""></option>
                        <option value="Matka">Matka</option>
                        <option value="Ojciec">Ojciec</option>
                        <option value="Opiekun prawny">Opiekun prawny</option>
                        <option value="Współmałżonek">Współmałżonek</option>
                        <option value="Brat">Brat</option>
                        <option value="Siostra">Siostra</option>
                        <option value="Dziecko">Dziecko/dziecko współmałżonka (do 26 lat)</option>
                        <option value="Dziecko niepełnosprawne">Niepełnosprawne dziecko/dziecko współmałżonka</option>
                        <option value="Dziecko opiekuna">Dziecko opiekuna</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="birth" class="control-label">Data urodzenia</label>
                    <input class="form-control" id="birth" name="birth" type="text" required="required" placeholder="rrrr-mm-dd">
                </div>
                <div class="form-group" style="display: none" id="querySchool">
                    <hr>
                    <label for="school" class="control-label">Czy uczy się/studiuje?</label>
                    <input type="radio" name="school" value="schoolYes" checked="checked"> TAK
                    <input type="radio" name="school" value="schoolNo"> NIE
                </div>
                <script type="text/javascript">
                    function AddFamilyMemberJSFunction(relation){
                        var list=['Brat','Siostra','Dziecko','Dziecko opiekuna'];
                        if(list.indexOf(relation)>=0){
                            document.getElementById("querySchool").style.display = 'block';
                        }
                        else {
                            document.getElementById("querySchool").style.display = 'none';
                        }
                    }
                </script>
                <div class="form-group">
                    <div class="control-label">
                        <button type="submit" class="btn btn-primary" value="addFamilyMember" name="submit">Dodaj</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</div>
