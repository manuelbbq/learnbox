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
<body onload="getmaxquestions()">
<div>
    Hallo <?php echo $user->getName() ?> deine Id ist <?php echo $user->getUserid() ?>.
</div>

<div class="sectiona">
    <div class="option">
        <h1>Erstelle Zettelbox</h1>
        <form id="optionform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <div>Fächer</div>
            <div class="subjects">

                <?php
                $i = 1;
                foreach (Flashcard::getSubjects() as $subject) {
                    ?>
                    <label class="label" for="<?php echo $subject['subject'] ?>"><?php echo $subject['subject'] ?></label>
                    <input  type="checkbox" class="checkbox" id="<?php echo $subject['subject'] ?>" name="subjectarr[]"
                           value="<?php echo $subject['subject'] ?>" onchange="getmaxquestions()" checked>
                    <?php if ($i % 2 == 0) {
                        echo "<br>";
                    } ?>
                    <?php
                    $i++;
                } ?>
            </div>
            <label id="quantitylabel" for="quantity">max. Anzahl :</label>
            <input type="number" id="quantity" name="quantity" min="1" max="5" required>
            <input type="text" name="name" value="<?php echo $user->getName() ?>" hidden><br>
            <button id="start" name="action" value="showfirst">Start</button>
        </form>
        <p id="errormsg"></p>

    </div>
    <div class="history">
        <h1>Letzten Tests</h1>
        <?php
        $i = 1;
        foreach (LearnBox::getLearnBoxesbyUserId($_SESSION['userid']) as $learnbox) {
            ?>
            <div class="lernbox">
                <p><?php echo 'Datum: ' . $learnbox->getDate() . ' Prozent: ' . $learnbox->getPerzentig() ?></p>
                <p>Fächer: <?php echo implode(', ',$learnbox->getSubjects())?></p>
                <p>Fragen: <?php echo $learnbox->countFlashcard() ?></p>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <input type="text" name="learnboxid" value="<?php echo $learnbox->getLearnboxId() ?>" hidden>
                    <button name="action" value="showlearnbox">Anzeigen</button>
                    <button name="action" value="retry">Nochmal</button>
                </form>

            </div>
            <?php
            if ($i === 3) {
                break;
            } else {
                $i++;
            }
        } ?>
    </div>

</div>
<script>
    function getmaxquestions() {


        let quantity = document.getElementById('quantity');
        let label = document.getElementById('quantitylabel');
        let checkboxes = document.getElementsByClassName('checkbox');
        const checkedboxes = [];

        for (const checkbox of checkboxes) {
            if (checkbox.checked === true) {
                checkedboxes.push(checkbox.value)
            }
        }
        if (checkedboxes.length === 0) {
            document.getElementById('errormsg').innerHTML = 'min ein Fach auswählen';
            document.getElementById('start').setAttribute('disabled', '');
            label.innerHTML = 'keine Fragen ';
            return;
        }
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                label.innerHTML = 'max Anzahl ' + xhttp.response;
                quantity.setAttribute('max', xhttp.response);
                document.getElementById('start').removeAttribute('disabled');
                document.getElementById('errormsg').innerHTML = '';
            }
        }
        xhttp.open("Post", "ajax/requestmax.php");
        xhttp.responseType = "json";
        xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhttp.send(JSON.stringify(checkedboxes));

    }
</script>
</body>
</html>

