<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/cardcss.css">
    <title>Learnbox</title>
</head>
<body>

<?php
$learnbox = $_SESSION['learnbox'];
$question = $learnbox->getFlashcards()[$frageindex];
$leaenser = serialize($learnbox);
if ($frageindex + 1 != count($learnbox->getFlashcards())) {
    $buttontext = 'Antwort speichern';
} else {
    $buttontext = 'Antwort speichern und zum Ergebnis';
}
?>
<div class="main">
    <div class="question">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <p id="frage">Frage: <?php echo $question->getQuestion() ?></p>
            <input id="useranswer" type="text" name="userinput" value="<?php echo $question->getUserInput() ?>"><br>
            <input type="text" name="frageindex" value="<?php echo $frageindex + 1 ?>" hidden>
            <button class="safebut" name="action" value="answer"><?php echo $buttontext ?></button>


        </form>


    </div>
    <div class="qcatalog">
        <?php
        for ($i = 1; $i <= count($learnbox->getFlashcards()); $i++) {

            if ($learnbox->getFlashcards()[$i - 1]->getUserInput() == '') {
                $show = $i;

            } else {
                $show = "<s>$i</s>";
            }

            if ($i - 1 == $frageindex) {
                $backcolor = 'royalblue';
            } else {
                $backcolor = '';
            }
            ?>
            <form class="qcatalogform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="text" name="frageindex" value="<?php echo $i - 1 ?>" hidden>
                <button class="qcatalogbut" name="action" value="goto"
                        style="background-color: <?php echo $backcolor ?> "><?php echo $show ?></button>
            </form>
            <?php
            if ($i % 5 === 0) {
                echo '<br>';
            }
        } ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <button class="safebut" name="action" value="result" >Test abgeben</button>
        </form>
    </div>
</div>


<div class="foot">

    <?php
    if ($frageindex != 0) { ?>
        <form class="back" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="text" name="frageindex" value="<?php echo $frageindex - 1 ?>" hidden>
            <button class="backbut" name="action" value="goto">vorherige Frage</button>
        </form>
        <?php
    }


    if ($frageindex + 1 != count($learnbox->getFlashcards())) {
        ?>
        <form class="next" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="text" name="frageindex" value="<?php echo $frageindex + 1 ?>" hidden>
            <button class="nextbut" name="action" value="goto">nächste Frage</button>
        </form>
    <?php }
    ?>
</div>

<br>

</body>
<script>
    document.getElementsByTagName('input')[0].focus();
</script>

</html>

<?php


