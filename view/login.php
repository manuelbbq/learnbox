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
    <div class="loginform">
    <h1>Login</h1>
    <form class="loginforminput" id="loginform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label id="namelabel" for="name">Name</label>
        <input type="text" id="name" name="name" required><br>
        <label id="passwordlabel" for="password">Passwort</label>
        <input type="password" id="password" name="password" required><br>
        <input type="text" id="userid" name="userid" value="" hidden><br>
        <input type="text" name="action" value="welcome" hidden>


    </form>
        <button onclick="login()">Login</button>
        <div id="loginerror"></div>

    </div>
    <form class="newuser" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="name">Name</label>
        <input onkeyup="checkIfNameExist(this)" type="text" id="newname" name="newname" required><br>
        <label for="password">Passwort</label>
        <input type="password" id="newpassword" name="newpassword" onkeyup="checkpw()" required><br>
        <label for="password">Bestätige Passwort</label>
        <input type="password" id="bepassword" name="bepassword" onkeyup="checkpw()" required><br>
        <input type="text" name="newuser" value="true" hidden>
        <button id="newuserbut" name="action" value="welcome" disabled>Erstellen</button>
        <div id="newuser"></div>
        <div id="passok"></div>
    </form>
</div>
</body>
<script>
    let namecheck = false;

    function checkIfNameExist(str) {
        str = str.value;
        // document.getElementById('newuser').innerHTML = 'schreibe '+str;

        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {

                if (xhttp.response) {
                    document.getElementById('newuser').innerHTML = 'Name vergeben';
                    namecheck = false;
                    // document.getElementById('newuserbut').setAttribute('disabled','');
                } else {
                    document.getElementById('newuser').innerHTML = '';
                    namecheck = true;

                    // document.getElementById('newuserbut').removeAttribute('disabled');


                }

            }
        }
        xhttp.open("Post", "ajax/checkusername.php");
        xhttp.responseType = "json";
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("func=checkIfUserNameExist&name=" + str);
        checkpw();
    }

    function checkpw() {
        let passbox = document.getElementById('newpassword').value;
        let contpassbox = document.getElementById('bepassword').value;
        if (passbox === contpassbox && passbox.length >= 3 && namecheck)
        {
            document.getElementById('passok').innerHTML = '';
            document.getElementById('newuserbut').removeAttribute('disabled');
        }
    else if(passbox.length < 3){
            document.getElementById('passok').innerHTML = 'Passwort zu kurz';
            document.getElementById('newuserbut').setAttribute('disabled', '');
        }else if (passbox !== contpassbox)
        {
            document.getElementById('passok').innerHTML = 'Passwort ist nicht gleich';
            document.getElementById('newuserbut').setAttribute('disabled', '');
        }
        else {
            document.getElementById('passok').innerHTML = '';
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
                if (xhttp.response[0]) {
                    document.getElementById('userid').value = xhttp.response[1];
                    document.getElementById('loginform').submit();
                } else {
                    document.getElementById('loginerror').innerHTML = 'Fehler';
                }

            }
        }
        xhttp.open("Post", "ajax/loginrequest.php");
        xhttp.responseType = "json";
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("func=login&" + str);
    }


</script>
</html>

<?php
