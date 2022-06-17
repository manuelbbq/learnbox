<?php


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hallo</title>
    <link rel="stylesheet" href="css/welcome.css">

</head>
<body>
<div>
    Hallo <?php echo $user->getName() ?> du bist neu Deine Id ist <?php echo $user->getUserid() ?>.
</div>

<div class="sectiona">
    <div class="option">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="subjects">
                <p>Fächer</p>
                <?php
                $i = 0;
                foreach (Flashcard::getSubjects() as $subject) {
                    ?>
                    <input type="checkbox" id="<?php echo $subject['subject'] ?>" name="subject<?php echo $i ?>"
                           value="<?php echo $subject['subject'] ?>">
                    <label for="<?php echo $subject['subject'] ?>"><?php echo $subject['subject'] ?></label><br>
                    <?php
                    $i++;
                } ?>
            </div>

            <label for="quantity">Anzahl (between 1 and 5):</label>
            <input type="number" id="quantity" name="quantity" min="1" max="5">
            <input type="text" name="name" value="<?php echo $user->getName() ?>" hidden><br>
            <button name="action" value="showfirst">Start</button>
        </form>
    </div>
    <div class="history">
        <h1>History</h1>

        <?php foreach (LearnBox::getLearnBoxesbyUserId($_SESSION['userid']) as $learnbox) {
            ?>
            <div class="lernbox">
                <p><?php echo 'Datum: ' . $learnbox->getDate() . ' Prozent: ' . $learnbox->getPerzentig() ?></p>
                <p>Fächer: <?php foreach ($learnbox->getSubjects() as $subject){echo $subject['subject'].' ';} ?></p>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <input type="text" name="learnboxid" value="<?php echo $learnbox->getLearnboxId() ?>" hidden>
                    <button name="action" value="showlearnbox">Anzeigen</button>
                </form>

            </div>
            <?php
        } ?>

    </div>

</div>
</body>
</html>

