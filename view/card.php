<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/card.css">
    <title>Learnbox</title>
</head>
<body>
<div class="container">
    <?php
    $frageindex = $_SESSION['index'];
    $learnbox = LearnBox::getLearnboxbyId($_SESSION['learnboxid']);
    $question = $learnbox->getFlashcards()[$frageindex];
    //$leaenser = serialize($learnbox);
    if ($frageindex + 1 != count($learnbox->getFlashcards())) {
        $button = '<button class="safebut" name="action" value="answer">Antwort speichern</button>';
    } else {
        $button = '<button class="safebut" name="action" value="answer">Antwort speichern</button>';
        $button .= '<button class="safebut" name="action" value="result">Test Abgeben</button>';
    }
    ?>
    <!--<div>Hallo --><?php //echo User::getUserbyId($learnbox->getUserId())->getName() ?><!--</div>-->
    <!--<div class="main">-->
    <div class="question">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <p id="frage">Frage: <?php echo $question->getQuestion() ?></p>
            <input id="useranswer" type="text" name="userinput" value="<?php echo $question->getUserinput() ?>"><br>
            <input type="text" name="frageindex" value="<?php echo $frageindex + 1 ?>" hidden>
            <button class="safebut" name="action" value="answer">Antwort speichern</button>


        </form>


    </div>


    <div class="qcatalog">
        <?php
        for ($i = 1; $i <= count($learnbox->getFlashcards()); $i++) {

            if ($learnbox->getFlashcards()[$i - 1]->isanswer($learnbox->getLearnboxId())) {
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
        }
        foreach ($learnbox->getFlashcards() as $flash) {
            if ($flash->isanswer($learnbox->getLearnboxId())) {

                $checked =  '<span> Nicht alles Beantwortet </span>';
                break;
            } else {
                $checked = '<span> Alles Ok </span>';

            }
        }

        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <button class="safebut" name="action" value="result">Test abgeben</button>
            <?php echo $checked ?>
        </form>
    </div>


    <div class="leftbut">

        <?php



        if ($frageindex != 0) { ?>
            <form class="back" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="text" name="frageindex" value="<?php echo $frageindex - 1 ?>" hidden>
                <button class="backbut" name="action" value="goto">vorherige Frage</button>

            </form>
            <?php
        }

        ?>
    </div>
    <div class="rightbut">

        <?php


        if ($frageindex + 1 != count($learnbox->getFlashcards())) {
            ?>
            <form class="next" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="text" name="frageindex" value="<?php echo $frageindex + 1 ?>" hidden>
                <button class="nextbut" name="action" value="goto">n??chste Frage</button>
            </form>
        <?php }
        ?>
    </div>
</div>


</body>
<script>
    document.getElementsByTagName('input')[0].focus();
</script>

</html>

<?php


