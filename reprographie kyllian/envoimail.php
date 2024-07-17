<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="index.css">
  <link rel="icon" href="images/print2.jpg">
  <title>ProjetDuKyks - Envoi</title>
</head>
<body>
<center>

<?php
if(isset($_POST["to"]) && isset($_POST["subject"]) && isset($_POST["message"])) 
{
    // Récupérer les données du formulaire
    session_start();
    $nom = $_SESSION['username'];
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $photocopies = $_POST['photocopies'];
    $format = $_POST['format'];
    $agraphe = $_POST['agraphe'];
    $date = $_POST['date'];

    // Paramètres de l'email (c'est censé être l'expéditeur)
    $email = "soilihi.kyllian@gmail.com";

    // Récupérer la PJ
    $nom_piecejointe = $_FILES['piecejointe']['name'];
    $taille_piecejointe = $_FILES['piecejointe']['size'];
    $tmp_piecejointe = $_FILES['piecejointe']['tmp_name'];
    $type_piecejointe = $_FILES['piecejointe']['type'];

    if(isset($_FILES['piecejointe']) && $_FILES['piecejointe']['error'] == UPLOAD_ERR_OK)
    {
        $fp = fopen($tmp_piecejointe, 'r');
        $content = fread($fp, filesize($tmp_piecejointe));
        $content = chunk_split(base64_encode($content));
        fclose($fp);

        // Organisation du message envoyé
        $full_message = "<html><body><ul>";
        $full_message .= "<li> Nb Photocopies : $photocopies</li>";
        $full_message .= "<li> Format : $format</li>";
        $full_message .= "<li> Agraphe : $agraphe</li>";
        $full_message .= "<li> Date de récupération : $date</li>";
        $full_message .= "<p> Commentaires : </p>";
        $full_message .= "$message";
        $full_message .= "</ul></body></html>";

        // Infos de l'entête du mail
        $uid = md5(uniqid(time()));
        $headers = "From: $nom <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";

        // Adaptation du message au format MIME
        $MIME_message = "--$uid\r\n";
        $MIME_message .= "Content-type:text/html; charset=UTF-8\r\n";
        $MIME_message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $MIME_message .= "$full_message\r\n\r\n";
        $MIME_message .= "--$uid\r\n";
        $MIME_message .= "Content-Type: piecejointe/pdf; name=\"".$nom_piecejointe."\"\r\n";
        $MIME_message .= "Content-Transfer-Encoding: base64\r\n";
        $MIME_message .= "Content-Disposition: attachment; filename=\"".$nom_piecejointe."\"\r\n\r\n";
        $MIME_message .= "$content\r\n\r\n";
        $MIME_message .= "--$uid--";

        // Envoi du mail
        if(mail($to, $subject, $MIME_message, $headers)) 
        {
            echo '<h1 class="border-textright"><font size="6" color="green">';
            echo "<i>Le message a été envoyé avec succès. 1 pièce jointe envoyée.</i>";
            echo '</font></h1>';
            echo "<br>";
            echo "<button>";
            echo '<a href="accueil.php">Accueil</a>';
            echo "</button>";

            // Informations de connexion à la base de données
            $sqlserver1 = "localhost"; // Adresse du serveur MySQL
            $sqlusername1 = "kyky"; // Nom d'utilisateur MySQL
            $sqlpassword1 = "btssnir"; // Mot de passe MySQL
            $basededonnees1 = "reprographie"; // Nom de la base de données
            $hourmail = date('H:i:s'); // Heure ou ca a été envoyé
            $datemail = date('d-m-Y'); // Date ou ca a été envoyé

            // Connexion à la base de données
            $connexion = mysqli_connect($sqlserver1, $sqlusername1, $sqlpassword1, $basededonnees1);

            // Vérifier si la connexion a réussi
            if (!$connexion) 
            {
                die("La connexion à la base de données a échoué : " . mysqli_connect_error());
            }

            // Préparer la requête SQL d'insertion
            $requete = "INSERT INTO historique (name, subject, destination, datemail, hourmail) VALUES ('$nom', '$subject', '$to', '$datemail', '$hourmail');";
            
            mysqli_query($connexion, $requete);
            mysqli_close($connexion);
        } 
        else 
        {
            echo '<h1 class="border-textright"><font size="6" color="red">';
            echo "<i>Désolé $nom, Une erreur s'est produite lors de l'envoi de l'e-mail.</i>";
            echo '</font></h1>';
            echo "<br>";
            echo "<button>";
            echo '<a href="newmessage.php">Reessayer</a>';
            echo "</button>";
        }
    }
    else
    {
        $headers = "From: $nom <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

        // Envoi de l'e-mail
        if(mail($to, $subject, $message, $headers)) 
        {
            echo '<h1 class="border-textright"><font size="6" color="green">';
            echo "<i>Le message a été envoyé avec succès. Aucune pièce jointe envoyée.</i>";
            echo '</font></h1>';
            echo "<br>";
            echo "<button>";
            echo '<a href="accueil.php">Accueil</a>';
            echo "</button>";

            // Informations de connexion à la base de données
            $sqlserver1 = "localhost"; // Adresse du serveur MySQL
            $sqlusername1 = "kyky"; // Nom d'utilisateur MySQL
            $sqlpassword1 = "btssnir"; // Mot de passe MySQL
            $basededonnees1 = "reprographie"; // Nom de la base de données
            $hourmail = date('H:i:s'); // Heure ou ca a été envoyé
            $datemail = date('Y-m-d'); // Date ou ca a été envoyé

            // Connexion à la base de données
            $connexion = mysqli_connect($sqlserver1, $sqlusername1, $sqlpassword1, $basededonnees1);

            // Vérifier si la connexion a réussi
            if (!$connexion) 
            {
                die("La connexion à la base de données a échoué : " . mysqli_connect_error());
            }

            // Préparer la requête SQL d'insertion
            $requete = "INSERT INTO historique (name, subject, destination, datemail, hourmail) VALUES ('$nom', '$subject', '$to', '$datemail', '$hourmail');";

            mysqli_query($connexion, $requete);
            mysqli_close($connexion);
        } 
        else 
        {
            echo '<h1 class="border-textright"><font size="6" color="red">';
            echo "<i>Désolé $nom, Une erreur s'est produite lors de l'envoi de ton message.</i>";
            echo '</font></h1>';
            echo "<br>";
            echo "<button>";
            echo '<a href="newmessage.php">Reessayer</a>';
            echo "</button>";
        }
    }
}
?>


</center>
</body>
</html>