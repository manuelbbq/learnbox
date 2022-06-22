<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/quick.css">
    <title>Document</title>
</head>
<body onload="get_new()">
<div id="card" onclick="showanswer()">
    <p id="frage"></p>
    <p id="antwort"></p>

</div>




<script>
    let question = '';
    let answer = '';

    function showanswer() {
        let answerele = document.getElementById('antwort');
        if (answerele.style.opacity == 0) {
            answerele.setAttribute('style', 'opacity:1');
        } else {
            get_new();
        }

    }

    function get_new() {
        let subject = <?php echo "'" . $_REQUEST['quick'] . "'"; ?>;
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                document.getElementById('frage').innerHTML = xhttp.response[0];
                document.getElementById('antwort').innerHTML = xhttp.response[1];
                document.getElementById('antwort').setAttribute('style', 'opacity:0')
            }
        }
        xhttp.open("Post", "ajax/quickrequest.php");
        xhttp.responseType = "json";
        xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhttp.send(JSON.stringify(subject));

    }

</script>
</body>
</html>