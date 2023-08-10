<?php
include 'inc/header.php';
Session::CheckLogin();
?>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
   $userLog = $users->userLoginAuthotication($_POST);
}
if (isset($userLog)) {
  echo $userLog;
}

$logout = Session::get('logout');
if (isset($logout)) {
  echo $logout;
}



 ?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Forma</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
</head>

<body>
    <style>
    body,
    html {
        margin: 0;
        height: 100%;
        width: 100%;
        font-family: Montserrat;

    }


    .ekran {
        background-color: initial;
        background: linear-gradient (90deg, rgb(186, 45, 186) 1.27389%, rgb(132, 38, 118) 58.2803%);
        background-image: linear-gradient(90deg, rgb(186, 45, 186) 1.27389%, rgb(132, 38, 118) 58.2803%);
        height: 100%;
        width: 100%;
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1;
    }

    .naslov {
        margin-top: 10%;
        margin-right: 10%;
        margin-left: 10%;
        margin-bottom: 5%;
        color: #93278f;
        text-align: center;
        font-size: 3.5vh;
        font-weight: bold;

    }

    .iza {
        width: 60%;
        height: 70%;
        max-width: 1920px;
        max-height: 1200px;
        background-image: url("assets/pics/slika.jpeg");
        background-position: center;
        background-size: cover;
        z-index: 2;
        position: relative !important;
        box-shadow: 0 0 30px 0 rgb(255, 255, 255, 0.5);
        border-radius: 5%;
        padding: none;
    }


    .login {
        background-color: white;
        box-shadow: 0 0 30px 0 hsl(200, 100%, 6%, 0.7);
        padding: none;
        width: 60%;
        height: 100%;
        max-width: 1200px;
        max-height: 1200px;
        border-radius: 5%;
        z-index: 3;
        position: absolute !important;
        left: 0;
        top: 0;
    }



    .form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        align-content: center;
        color: #93278f;

    }

    .polja {
        display: flex;
        flex-direction: column;
        column-gap: 10%;
        width: 70%;
    }

    .polja label {
        color: #93278f;
        font-weight: lighter;
        font-size: 2vh;
        margin-top: 10%;

    }

    .polja input {
        font-size: 2vh;
        padding: 0.02vh;
        background-color: rgb(255, 255, 255, 0.7);
        box-shadow: 0 0 20px 0 rgb(147, 39, 143, 0.5);
        outline: none;
        border: none;
        border-radius: 33px;
        color: #93278f;
        font-weight: lighter;
        width: 100%;
        line-height: 3vh;
        padding: 5px 12px;
    }



    .dugme {
        margin-top: 5%;
        padding: 15px 17px;
        font-size: 2.3vh;
        font-weight: lighter;
        color: white;
        background-color: #93278f;
        border: 1px solid rgb(147, 39, 143);
        border-radius: 33px;
        outline: none;
        cursor: pointer;
        width: 30%;

    }
    </style>
    <div class="ekran">

        <div class="iza">
            <img style="width: 20%; height: auto; position: absolute; bottom: 3%; right: 3%;"
                src="assets/pics/auralogobijeli.png">

            <div class="login">
                <h1 class="naslov">Dobrodošli</h1>
                <form class="form" action="" method="post">
                    <div class="polja">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email">
                        <!---<span class="msg">Ispravan email</span>--->
                    </div>

                    <div class="polja" style="margin-top: 20px;">
                        <label for="sifra">Šifra</label>
                        <input type="password" name="password" id="sifra">
                        <!---<span class="msg">Neispravna šifra</span>--->
                    </div>

                    <div
                        style="width: 100%; display: flex;justify-content: center;align-items: center; margin-top: 20px;">
                        <button type="submit" name="login" class="dugme">Prijavi se</button>
                    </div>



                </form>
            </div>
        </div>


    </div>

</body>

</html>

<?php
  include 'inc/footer.php';

  ?>