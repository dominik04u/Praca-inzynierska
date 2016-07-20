<?php require_once 'resources/menus/adminMenu.php';

if (isset($this->alert))
    if ($this->alert == "Sukces") {
        echo '<div class="alert alert-dismissible alert-success col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->alert . '</strong> Komunikat został dodany <br></div>';
        header('refresh:3; url='.URL.'adminPanel');
    }
    else
        echo '<div class="alert alert-dismissible alert-danger col-lg-4 col-lg-offset-4" align="center">
	<strong>' . $this->alert . '</strong> Nie udało się dodać komunikatu. <br></div>';
?>
<br>
<div class="col-lg-offset-4 col-lg-4">
    <div class="well bs-component">
        <form class="form-group" method="post" action="<?php echo URL; ?>AdminPanel/postNews">
            <fieldset>
                <legend>Komunikat</legend>
                <div class="form-group">
                    <label for="title" class="control-label">Tytuł</label>
                    <input class="form-control" id="title" name="title" type="text" required="required">
                </div>
                <div class="form-group">
                    <label for="news_text" class="control-label">Treść</label>
                    <textarea class="form-control" id="news_text" name="news_text" rows="5" required="required"></textarea>
                </div>
                <div class="form-group">
                    <div class="control-label">
                        <button type="submit" class="btn btn-primary">Wyślij</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</div>
</body>
</html>