<?php
require_once 'resources/menus/profileMenu.php';
if (isset($this->message))
    if ($this->message == "Sukces")
        echo '<div class="alert alert-dismissible alert-success col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->message . '</strong> Dane zostały zmienione. <br></div>';
    else
        echo '<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->message . '</strong> Nie udało się zmienić danych. <br></div>';
?>
<div class="col-lg-offset-4 col-lg-4">
    <div class="well bs-component">
        <form class="form-group" method="post">
            <fieldset>
                <legend>Edytuj dane osobowe</legend>
                <?php
                foreach ($this->data as $row) {
                    echo '
                <div class="form-group">
                    <label for="name" class="control-label">Imię</label>
                    <input class="form-control" id="name" name="name" type="text" autocomplete="on" required="required" value="' . $row['name'] . '">
                </div>
                <div class="form-group">
                    <label for="surname" class="control-label">Nazwisko</label>
                    <input class="form-control" id="surname" name="surname" type="text" autocomplete="on"
                           required="required" value="' . $row['surname'] . '">
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input class="form-control" id="email" name="email" type="email" autocomplete="on" required="required"  value="' . $row['email'] . '">
                </div>
                <div class="form-group">
                    <label for="phone" class="control-label">Numer telefonu</label>
                    <input class="form-control" id="phone" name="phone" type="text" autocomplete="on" minlength="9" maxlength="9"  value="' . $row['phone'] . '">
                </div>
                <div>
                    <div class="form-group">
                        <label for="birth" class="control-label">Data urodzenia</label>
                        <input class="form-control" id="birth" name="birth" type="text" autocomplete="on"
                                required="required" value="' . $row['birth'] . '" placeholder="rrrr-mm-dd">
                    </div>
                </div>
                <legend>Studia</legend>
                <div class="form-group">
                  <label for="subject" class="control-label">Kierunek</label>
                   <select class="form-control" id="subject" name="subject" required="required">
                        <option value=""></option>
                        <option value="Kierunek AA"'; if($row['subject_name']=="Kierunek AA") {echo 'selected="selected"';} echo '>Kierunek AA</option>
                        <option value="Kierunek AB"'; if($row['subject_name']=="Kierunek AB") {echo 'selected="selected"';} echo '>Kierunek AB</option>
                        <option value="Kierunek AC"'; if($row['subject_name']=="Kierunek AC") {echo 'selected="selected"';} echo '>Kierunek AC</option>
                        <option value="Kierunek BA"'; if($row['subject_name']=="Kierunek BA") {echo 'selected="selected"';} echo '>Kierunek BA</option>
                        <option value="Kierunek BB"'; if($row['subject_name']=="Kierunek BB") {echo 'selected="selected"';} echo '>Kierunek BB</option>
                        <option value="Kierunek BC"'; if($row['subject_name']=="Kierunek BC") {echo 'selected="selected"';} echo '>Kierunek BC</option>
                        <option value="Kierunek CA"'; if($row['subject_name']=="Kierunek CA") {echo 'selected="selected"';} echo '>Kierunek CA</option>
                        <option value="Kierunek CB"'; if($row['subject_name']=="Kierunek CB") {echo 'selected="selected"';} echo '>Kierunek CB</option>
                        <option value="Kierunek CC"'; if($row['subject_name']=="Kierunek CC") {echo 'selected="selected"';} echo '>Kierunek CC</option>
                        <option value="Kierunek DA"'; if($row['subject_name']=="Kierunek DA") {echo 'selected="selected"';} echo '>Kierunek DA</option>
                        <option value="Kierunek DB"'; if($row['subject_name']=="Kierunek DB") {echo 'selected="selected"';} echo '>Kierunek DB</option>
                        <option value="Kierunek DC"'; if($row['subject_name']=="Kierunek DC") {echo 'selected="selected"';} echo '>Kierunek DC</option>
                        <option value="Kierunek EA"'; if($row['subject_name']=="Kierunek EA") {echo 'selected="selected"';} echo '>Kierunek EA</option>
                        <option value="Kierunek EB"'; if($row['subject_name']=="Kierunek EB") {echo 'selected="selected"';} echo '>Kierunek EB</option>
                        <option value="Kierunek EC"'; if($row['subject_name']=="Kierunek EC") {echo 'selected="selected"';} echo '>Kierunek EC</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="system" class="control-label">System</label>
                    <select class="form-control" id="system" name="system" required="required">
                        <option value="st"'; if($row['system']=="st") {echo 'selected="selected"';} echo '>Stacjonarne</option>
                        <option value="nst"'; if($row['system']=="nst") {echo 'selected="selected"';} echo '>Niestacjonarne</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="degree" class="control-label">Stopień</label>
                    <select class="form-control" id="degree" name="degree" required="required">
                        <option value="I"'; if($row['degree']=="I") {echo 'selected="selected"';} echo '>1. stopień (inżynierskie/licencjat)</option>
                        <option value="II"'; if($row['degree']=="II") {echo 'selected="selected"';} echo '>2. stopień (magisterskie)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester" class="control-label">Semestr</label>
                    <select class="form-control" id="semester" name="semester" required="required">
                        <option value="1"'; if($row['semester']==1) {echo 'selected="selected"';} echo '>1</option>
                        <option value="2"'; if($row['semester']==2) {echo 'selected="selected"';} echo '>2</option>
                        <option value="3"'; if($row['semester']==3) {echo 'selected="selected"';} echo '>3</option>
                        <option value="4"'; if($row['semester']==4) {echo 'selected="selected"';} echo '>4</option>
                        <option value="5"'; if($row['semester']==5) {echo 'selected="selected"';} echo '>5</option>
                        <option value="6"'; if($row['semester']==6) {echo 'selected="selected"';} echo '>6</option>
                        <option value="7"'; if($row['semester']==7) {echo 'selected="selected"';} echo '>7</option>
                        <option value="8"'; if($row['semester']==8) {echo 'selected="selected"';} echo '>8</option>
                    </select>
                </div>';
                } ?>
                <div class="form-group">
                    <div class="control-label">
                        <button type="submit" class="btn btn-primary" value="changeData" name="submit">Zatwierdź
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>