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
            <p>Fächer: <?php echo implode(', ', $learnbox->getSubjects()) ?></p>
            <p>Fragen: <?php echo $learnbox->countFlashcard() ?></p>

            <button onclick="setview(this, <?php echo $learnbox->getLearnboxId() ?>)" >Anzeigen</button>
            <button onclick="setview(this, <?php echo $learnbox->getLearnboxId() ?>)"  >Nochmal</button>
            <button onclick="setview(this, <?php echo $learnbox->getLearnboxId() ?>)"  >Löschen</button>

        </div>
        <?php
    } ?>

    <form id="hisform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="text" id="action" name="action" value="" hidden>
        <input type="text" id="formlid" name="learnboxid" value="" hidden>
        <input type="text" id="formview" name="view" value="" hidden><br>
    </form>
    <script>
        function setview(ele,id) {
            let view = 'test';
            let action = '';


            if (ele.innerHTML === 'Anzeigen') {
                view = 'result';
                action = 'Actionshowlearnbox';
            } else if (ele.innerHTML === 'Nochmal') {
                view = 'card';
                action = "Actionretry";
            } else if (ele.innerHTML === 'Löschen') {
                view = 'history';
                action = 'Actiondelete';
            }
            console.log(id);
            console.log(view);
            document.getElementById('formview').setAttribute('value',view);
            document.getElementById(('formlid')).setAttribute('value',id);
            document.getElementById(('action')).setAttribute('value',action);
            document.getElementById('hisform').submit();

        }
    </script>

</div>
</body>
</html>