<?php
require_once 'resources/menus/index.php';
if (isset($this->message))
    echo '<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
		<strong>' . $this->message . '</strong> Spróbuj jeszcze raz. <br>
</div>'
?>
<div class="col-lg-offset-4 col-lg-4">
    <div class="well bs-component">
        <form class="form-group" method="post" action="<?php echo URL; ?>register/register"><!-1. kontroler 2.metoda -->
            <fieldset>
                <legend>Dane osobowe</legend>
                <div class="form-group">
                    <label for="name" class="control-label">Imię</label>
                    <input class="form-control" id="name" name="name" type="text" autocomplete="on" required="required">
                </div>
                <div class="form-group">
                    <label for="surname" class="control-label">Nazwisko</label>
                    <input class="form-control" id="surname" name="surname" type="text" autocomplete="on"
                           required="required">
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input class="form-control" id="email" name="email" type="email" autocomplete="on"
                           required="required" placeholder="example@example.com">
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Hasło</label>
                    <input class="form-control" id="password" name="password" type="password" required="required"
                           minlength=8 placeholder="min. 8 characters">
                </div>
                <div class="form-group">
                    <label for="index" class="control-label">Indeks</label>
                    <input class="form-control" id="index" name="index" type="text" autocomplete="on"
                           required="required" minlength="6" maxlength="6">
                </div>
                <div class="form-group">
                    <label for="phone" class="control-label">Numer telefonu</label>
                    <input class="form-control" id="phone" name="phone" type="text" autocomplete="on" minlength="9"
                           maxlength="9">
                </div>
                <div>
                    <div class="form-group">
                        <label for="birth" class="control-label">Data urodzenia</label>
                        <input class="form-control" id="birth" name="birth" type="text" autocomplete="on"
                               placeholder="rrrr-mm-dd" required="required">
                    </div>
                </div>
                <legend>Studia</legend>
                <div class="form-group">
                    <label for="subject" class="control-label">Kierunek</label>
                    <select class="form-control" id="subject" name="subject" required="required">
                        <option value=""></option>
                        <option value="Kierunek AA">Kierunek AA</option>
                        <option value="Kierunek AB">Kierunek AB</option>
                        <option value="Kierunek AC">Kierunek AC</option>
                        <option value="Kierunek BA">Kierunek BA</option>
                        <option value="Kierunek BB">Kierunek BB</option>
                        <option value="Kierunek BC">Kierunek BC</option>
                        <option value="Kierunek CA">Kierunek CA</option>
                        <option value="Kierunek CB">Kierunek CB</option>
                        <option value="Kierunek CC">Kierunek CC</option>
                        <option value="Kierunek DA">Kierunek DA</option>
                        <option value="Kierunek DB">Kierunek DB</option>
                        <option value="Kierunek DC">Kierunek DC</option>
                        <option value="Kierunek EA">Kierunek EA</option>
                        <option value="Kierunek EB">Kierunek EB</option>
                        <option value="Kierunek EC">Kierunek EC</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="system" class="control-label">System</label>
                    <select class="form-control" id="system" name="system" required="required">
                        <option value=""></option>
                        <option value="st">Stacjonarne</option>
                        <option value="nst">Niestacjonarne</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="degree" class="control-label">Stopień</label>
                    <select class="form-control" id="degree" name="degree" required="required">
                        <option value=""></option>
                        <option value="I">1. stopień (inżynierskie/licencjat)</option>
                        <option value="II">2. stopień (magisterskie)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester" class="control-label">Semestr</label>
                    <select class="form-control" id="semester" name="semester" required="required">
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="control-label">
                        <button type="submit" class="btn btn-primary" value="register" name="submit">Zarejestruj
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
