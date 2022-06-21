<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/history.css">
</head>
<body>
<div class="history">
    <h1>History</h1>

    <?php

    foreach (LearnBox::getLearnBoxesbyUserId($_SESSION['userid']) as $learnbox) {
        ?>
        <div class="lernbox">
            <p><?php echo 'Datum: ' . $learnbox->getDate() . ' Prozent: ' . $learnbox->getPerzentig() ?></p>
            <p>Fächer: <?php echo implode(', ',$learnbox->getSubjects()) ?></p>
            <p>Fragen: <?php echo $learnbox->countFlashcard() ?></p>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="text" name="learnboxid" value="<?php echo $learnbox->getLearnboxId() ?>" hidden>
                <button name="action" value="showlearnbox">Anzeigen</button>
                <button name="action" value="retry">Nochmal</button>
                <button name="action" value="delete">Löschen</button>
            </form>

        </div>
        <?php
    } ?>
</div>
</body>
</html>