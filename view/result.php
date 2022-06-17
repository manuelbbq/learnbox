<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/resultcss.css">
    <title>Ergebnis</title>
</head>
<body>
<div class="head">
    <h1>Das Ergebnis</h1>
    <p class="head"><?php echo $learnbox->getPerzentig() ?>% richtig</p>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <input name="frageindex" value="0" hidden>
        <button name="action" value="retry" >Nochmal ?</button>
    </form>

    <p class="head"><a href="<?php echo $_SERVER['PHP_SELF'] ?>">Nochmal Versuchen</a></p>
    <div class="gotomenu">
        <?php
        $i = 1;
        foreach ($learnbox->getFlashcards() as $flashcard) {
            if ($flashcard->isUserInputCorrect()) {
                $isUserInput = '&#10003;';
                $backgroundColor = '#bdefa5';
                $show = 'hidden';
                $class = 'right';
            } else {
                $isUserInput = '&#10006;';
                $backgroundColor = '#f36e6e';
                $show = '';
                $class = 'wrong';
            }
            ?>
            <a class="gotoq" href="#result<?php echo $flashcard->getId() ?>"><?php echo $i ?><span
                        class="<?php echo $class ?>"><?php echo $isUserInput ?> </span></a>
            <?php
            if ($i % 5 === 0) {
                echo '<br>';
            }
            $i++;
        } ?>

    </div>


</div>
<div class="results">
    <?php


    foreach ($learnbox->getFlashcards() as $flashcard) {
        if ($flashcard->isUserInputCorrect()) {
            $isUserInput = '&#10003;';
            $backgroundColor = '#bdefa5';
            $show = 'hidden';
            $class = 'right';
        } else {
            $isUserInput = '&#10006;';
            $backgroundColor = '#f36e6e';
            $show = '';
            $class = 'wrong';
        }
//    $isUserInput= '§§§§';
        ?>
        <div i class="result" style="background-color: <?php echo $backgroundColor ?> "
             id="result<?php echo $flashcard->getId() ?>">
            <p class="losung"> Frage:</p>
            <span class="frage"> <?php echo $flashcard->getQuestion() ?></span>
            <br>
            <span class="losung"><span
                        class="<?php echo $class ?>"><?php echo $isUserInput ?> </span>Antwort: </span>
            <span class="frage"><?php echo $flashcard->getUserInput() ?></span>

            <?php if ($show !== 'hidden') { ?>

                <p class="losung" <?php echo $show ?>>Lösung:
                </p>
                <span class="richtigeantwort" onclick="showanswer(this)"><?php echo $flashcard->getAnswer() ?></span>
            <?php } ?>

        </div>

        <?php
    }


    ?>
</div>
<script>


    function showanswer(ele) {
        ele.style.backgroundColor = ele.parentElement.parentElement.style.backgroundColor;
        ele.style.color = 'black';
    }
</script>
</body>
</html>
<?php
