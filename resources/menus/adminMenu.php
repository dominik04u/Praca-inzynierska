<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Pasek nawigacji</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo URL; ?>adminPanel">Strona główna</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo URL; ?>adminPanel/newsWindow">Dodaj komunikat</a></li>
                <li><a href="<?php echo URL; ?>adminPanel/messageWindow">Wiadomość</a></li>
                <li><a href="<?php echo URL; ?>adminPanel/studentWindow"">Studenci</a></li>
                <li><a href="<?php echo URL; ?>adminPanel/applicationsWindow"">Wnioski</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo URL; ?>adminLogin/logout">Wyloguj <i><?php echo $_SESSION['name'].' '.$_SESSION['surname']; ?></i></a></li>
            </ul>
        </div>
    </div>
</nav>