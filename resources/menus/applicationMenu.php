
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
            </button>
            <a class="navbar-brand" href="<?php echo URL; ?>">Strona główna</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo URL; ?>UserPanel/studentIncomeWindow">Dochód</a></li>
                <li><a href="<?php echo URL; ?>UserPanel/familyWindow">Rodzina</a></li>
                <li><a href="<?php echo URL; ?>UserPanel/scholarshipWindow">Stypendium</a></li>
                <li><a href="<?php echo URL; ?>UserPanel/applicationWindow">Wniosek</a></li>
                <li><a href="<?php echo URL; ?>UserPanel/documentsList">Lista dokumentów</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo URL; ?>login/logout">Wyloguj <i><?php echo $_SESSION['name'].' '.$_SESSION['surname']; ?></i></a></li>
            </ul>
        </div>
    </div>
</nav>