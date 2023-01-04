<?php
session_start();
require("PDO.php");

if (isset($_POST['sign'])) {
    $nom = $_POST["name"];
    $email = $_POST["email2"];
    $pass1 = $_POST["password2"];
    $pass2 = $_POST["password3"];
    if($pass1 == $pass2){

       $sql = "INSERT INTO `connexion`(`username`, `mdp`, `mail`) VALUES ('$nom', '$pass1', '$email')";
        $stmt = $db->prepare($sql);
        $stmt->execute();
    }else{
        echo "Les mots de passe ne sont pas identique";
    }
}

if (isset($_POST['bout'])) {
    $pseudo = $_POST["username"];
    $pass = $_POST["mdp"];
    $requete = "SELECT * FROM `connexion` WHERE username='$pseudo'and mdp='$pass'";
    $execute = $db->prepare($requete);

    $execute->execute();


    
    if ($execute->rowCount() > 0) {  
        $resultat = $execute->fetchAll();
        var_dump($resultat);    
            echo "connexion";   
            $_SESSION['username'] = $pseudo; 
            $_SESSION['id_user'] = $resultat[0][0];
            header('Location: index.php');
    }else{
        $erreur = " Mot de passe Oublié !!😒";
       // header('Location: connexion.php');
       var_dump($resultat);    

    }
   
    

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>Connexion QCM JOKAST</title>
</head>
<body>
   
    <h1 id="login" style="text-align:center; " >Formulaire de connexion</h1><br><br>
    <div class="formu">
    <form class="loform" action="" method="post" >
        <input class="log" type="text" name="username" placeholder="Entrez votre pseudo " required><br><br>
        <input class="log password" type="password" name="mdp" placeholder="Mot de passe " required><br><br>
        <?php if(isset($erreur))echo "<b>$erreur</b>";?><br><br>
        <input class="send" type="submit" value="Connexion" name="bout"><br>

    </form>

    <div class="loform signup">
                <div class="loform-content">
                    <header>Signup</header><br><br>
                    <form action="" method="post">
                       
                    <div class="field input-field">
                            <input class="log" type="text" name="name" placeholder="Name" class="input">
                        </div>
                        <div class="field input-field">
                            <input class="log" type="email" name="email2" placeholder="Email" class="input">
                        </div>

                        <div class="field input-field">
                            <input type="password" name="password2"  placeholder="Create password" class="password log">
                        </div>

                        <div class="field input-field">
                            <input type="password" name="password3" placeholder="Confirm password" class="password log">
                            <i class='bx bx-hide eye-icon'></i>
                        </div>

                        <div class="field button-field">
                            <button class="send" name="sign" style="margin-top: 35px;">Signup</button>
                        </div>
                    </form>

                    <div class="form-link" style="margin-top: 35px;">
                        <span>Already have an account? <a href="#" class="link login-link">Login</a></span>
                    </div>
                </div>

                <div class="line"></div>

            </div>
        </section>

    </div>
        <!-- JavaScript -->
        <script src="script.js"></script>
</body>

</html>