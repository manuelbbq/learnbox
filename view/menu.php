<link rel="stylesheet" href="css/menu.css">
<div id="menuhead">


    <div id="welcomehead">

        <form class="formmenu" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <button class="menubutt" name="action" value="welcome">Hauptmenu</button>
        </form>
    </div>

    <div id="historyhead">

        <form class="formmenu" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <button class="menubutt" name="action" value="history">History</button>
        </form>
    </div>

    <div id="logouthead">

        <form class="formmenu" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <button class="menubutt" name="action" value="logout">Logout</button>
        </form>
    </div>

</div>



