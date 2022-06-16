<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/login.css">

    <title>Login</title>
</head>
<body>
<div class="login">
    <h1>Login</h1>
<form class="loginform" id="loginform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <label id="namelabel" for="name">Name</label>
    <input type="text" id="name" name="name" required><br>
    <label id="passwordlabel" for="password">Passwort</label>
    <input type="password" id="password" name="password" required><br>
    <input type="text" name="action" value="showfirst" hidden>

    <div id="loginerror"></div>
</form>
    <button onclick="login()" >Login</button>

<form class="newuser" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="name">Name</label>
    <input onkeyup="checkIfNameExist(this)" type="text" id="newname" name="newname" required><br>
    <label for="password">Passwort</label>
    <input type="password" id="newpassword" name="newpassword" onkeyup="checkpw()" required><br>
    <label for="password">Bestätige Passwort</label>
    <input type="password" id="bepassword" name="bepassword" onkeyup="checkpw()" required><br>
    <button id="newuserbut" name="action" value="newuser" disabled>Erstellen</button>
    <div id="newuser"></div>
    <div id="passok"></div>
</form>
</div>
</body>
<script>
    function checkIfNameExist(str) {
        str = str.value;
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                if(xhttp.response){
                    document.getElementById('newuser').innerHTML = 'Name vergeben';
                    document.getElementById('newuserbut').setAttribute('disabled','');
                } else {
                    document.getElementById('newuser').innerHTML = '';
                    document.getElementById('newuserbut').removeAttribute('disabled');


                }

            }
        }
        xhttp.open("Post", "ajax/ajaxrequest.php");
        xhttp.responseType = "json";
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("func=checkIfUserNameExist&name=" + str);
    }
    function checkpw() {
        passbox = document.getElementById('newpassword').value;
        contpassbox = document.getElementById('bepassword').value;
        if (passbox === contpassbox){
            document.getElementById('passok').innerHTML = '';
            document.getElementById('newuserbut').removeAttribute('disabled');
        } else {
            document.getElementById('passok').innerHTML = 'Passwort ist nicht gleich';
            document.getElementById('newuserbut').setAttribute('disabled','');


        }

    }

    function login() {

        let name = document.getElementById('name').value;
        let pw = document.getElementById('password').value;
        let str = `&name=${name}&password=${pw}`;
        console.log(str);
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                if(xhttp.response){
                    document.getElementById('loginform').submit();
                } else {
                    document.getElementById('loginerror').innerHTML = 'Fehler';


                }

            }
        }
        xhttp.open("Post", "ajax/ajaxrequest.php");
        xhttp.responseType = "json";
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("func=login&"+str);
    }



</script>
</html>

<?php
