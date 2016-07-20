<?php
if (isset($_SESSION) && $_SESSION['privilege'] == 'user')
    require_once 'resources/menus/loginMenu.php';
else
    require_once 'resources/menus/index.php';

if (isset($this->alert))
    if ($this->alert == "Sukces") {
        echo '<div class="alert alert-dismissible alert-success col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->alert . '</strong> Wiadomość została wysłana <br></div>';
    } else
        echo '<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->alert . '</strong> Nie udało się wysłać wiadomości <br></div>';
?>
<div class="col-lg-offset-4 col-lg-4">
    <div class="well bs-component">
        <form class="form-group" method="post">
            <fieldset>
                <legend>Formularz kontaktowy</legend>
                <div class="form-group">
                    <label for="sender" class="control-label">Nadawca</label>
                    <input class="form-control" id="sender" type="email" name="sender"
                           placeholder="twój_email@example.pl">
                </div>
                <div class="form-group">
                    <label for="receiver" class="control-label">Odbiorca</label>
                    <select class="form-control" id="receiver" name="receiver">
                        <option value=""></option>
                        <option value="main_contact@example.pl">Pomoc ogólna</option>
                        <option value="comments_contact@example.pl">Uwagi dot. działania</option>
                        <option value="faculty_a_contact@example.pl">Administracja Wydziału A</option>
                        <option value="faculty_b_contact@example.pl">Administracja Wydziału B</option>
                        <option value="faculty_c_contact@example.pl">Administracja Wydziału C</option>
                        <option value="faculty_d_contact@example.pl">Administracja Wydziału D</option>
                        <option value="faculty_e_contact@example.pl">Administracja Wydziału E</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="subject" class="control-label">Temat</label>
                    <input class="form-control" id="subject" type="text" name="subject">
                </div>
                <div class="form-group">
                    <label for="message" class="control-label">Wiadomość</label>
                    <textarea class="form-control" id="message" name="message" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <div class="control-label">
                        <button type="submit" class="btn btn-primary" value="sendEmail" name="submit">Wyślij</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</div>
</body>
</html>