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

    <div id="quickhead" class="quick">
        <button class="menubutt">Schnellfragerunde</button>
        <div class="dropdown">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <input type="text" name="action" value="quick" hidden>
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
            <button class="menubutt" name="action" value="logout">Logout</button>
        </form>
    </div>


</div>



