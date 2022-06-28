<link rel="stylesheet" href="css/menu.css">
<div id="menuhead">


    <div id="welcomehead">
        <form class="formmenu" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="text" id="view" name="view" value="welcome" hidden><br>
            <button class="menubutt" name="action" value="Actionwelcome">Hauptmenu</button>
        </form>
    </div>

    <div id="historyhead">

        <form class="formmenu" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="text" id="view" name="view" value="history" hidden><br>
            <button class="menubutt" name="action" value="Actionhistory">History</button>
        </form>
    </div>

    <div id="quickhead" class="quick">
        <button class="menubutt">Schnellfragerunde</button>
        <div class="dropdown">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <input type="text" name="view" value="quick" hidden>
                <input type="text" name="action" value="Actionquick" hidden>
            <?php foreach (Flashcard::getSubjects() as $subject) {
                ?>
            <button class="dropbut" name="quick" value="<?php echo $subject['subject']?>"><?php echo $subject['subject']?></button>
                <br>
            <?php
                    } ?>
            </form>

        </div>

    </div>


    <div id="logouthead">

        <form class="formmenu" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="text" id="view" name="view" value="login" hidden><br>
            <button class="menubutt" name="action" value="Actionlogout">Logout</button>
        </form>
    </div>


</div>



