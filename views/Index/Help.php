<?php
if (isset($_SESSION) && $_SESSION['privilege'] == 'user')
    require_once 'resources/menus/loginMenu.php';
else
    require_once 'resources/menus/index.php';
?>
<legend>Pomoc</legend>
    <div class="panel panel-info col-lg-4 col-lg-offset-4">
        <div class="panel-heading ">
            <h3 class="panel-title">Pomoc</h3>
        </div>
        <div class="panel-body">
            To jest panel pomocy. Tu powinny znaleźć się niezbędne informacje nt. działania portalu i procedur przyznawania
            świadczeń.
        </div>
    </div>
</div>
