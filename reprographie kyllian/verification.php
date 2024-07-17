<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="index.css">
  <link rel="icon" href="images/print2.jpg">
  <title>ProjetDuKyks - Connexion</title>
</head>
<body>
<center>

<?php

if (isset($_POST['username']) && isset($_POST['password'])) 
{
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sqlserver = "localhost"; // Adresse du serveur MySQL
  $sqlusername = "kyky"; // Nom d'utilisateur MySQL
  $sqlpassword = "btssnir"; // Mot de passe MySQL
  $basededonnees = "reprographie"; // Nom de la base de données

  // Établir la connexion à la base de données
  $connexion = mysqli_connect($sqlserver, $sqlusername, $sqlpassword, $basededonnees);

  // Vérifier si la connexion a réussi
  if (!$connexion) 
  {
      die("La connexion à la base de données a échoué : " . mysqli_connect_error());
  }

  // Exécuter une requête SQL pour récupérer les données de la table
  $table = "utilisateurs"; // Remplacez par le nom réel de votre table
  $sql = "SELECT * FROM " . $table;
  $resultat = mysqli_query($connexion, $sql);

  // Vérifier si la requête a réussi
  if ($resultat) 
  {
      // Parcourir les résultats
      while ($row = mysqli_fetch_assoc($resultat)) 
      {
          // Accéder aux valeurs de chaque ligne
          $colusername = $row['username'];
          $colpassword = $row['password'];
          // ...
          
          // Faire quelque chose avec les données récupérées
          if($username == $colusername && $password == $colpassword)
          {
            header("Location: accueil.php?username=".$username);
            session_start();
            $_SESSION['username'] = $username;
          }
          /* else
          {
            echo '<h1 class="border-textright"><font size="7.5" color="red">';
            echo "<i>L'identifiant ou le mot de passe est incorrect.</i>";
            echo '</font></h1>';
            echo "<br>";
            echo "<button>";
            echo '<a href="index.html">Retour a la page de connexion</a>';
            echo "</button>"; LE COPIER ICI RISQUE DE SORTIR LES ECHO CHAQUE PUTAIN DE MILLISECONDE TANT QUE LE WHILE N'EST PAS FINI
          } */
      }
      echo '<h1 class="border-textright"><font size="7.5" color="red">';
      echo "<i>L'identifiant ou le mot de passe est incorrect.</i>";
      echo '</font></h1>';
      echo "<br>";
      echo "<button>";
      echo '<a href="index.html">Retour a la page de connexion</a>';
      echo "</button>";
  } 
  else 
  {
      echo "Erreur lors de l'exécution de la requête : " . mysqli_error($connexion);
  }

  // Fermer la connexion à la base de données
  mysqli_close($connexion);
} 

else if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $monlogin2 = $_POST['newusername'];
    $motdepasse2 = $_POST['newpassword'];
    $email2 = $_POST['newemail'];

    // Informations de connexion à la base de données
    $sqlserveur1 = "localhost"; // Adresse du serveur MySQL
    $sqlusername1 = "kyky"; // Nom d'utilisateur MySQL
    $sqlpassword1 = "btssnir"; // Mot de passe MySQL
    $basededonnees1 = "reprographie"; // Nom de la base de données

    // Connexion à la base de données
    $connexion = mysqli_connect($sqlserver1, $sqlusername1, $sqlpassword1, $basededonnees1);

    // Vérifier si la connexion a réussi
    if (!$connexion) 
    {
        die("La connexion à la base de données a échoué : " . mysqli_connect_error());
    }

    // Préparer la requête SQL d'insertion
    $requete = "INSERT INTO utilisateurs (username, email, password) VALUES ('$monlogin2',    '$email2', '$motdepasse2');";

    // Exécuter la requête SQL
    if (mysqli_query($connexion, $requete))
    {
        echo '<h1 class="border-textright"><font size="7" color="green">';
        echo "Le compte $monlogin2 a bien été crée.";
        echo "</font></h1>";
        echo "<br>";
        echo "<button>";
        echo '<a href="index.html">Retour a la page de connexion</a>';
        echo "</button>";
    } 
    else 
    {
        echo '<h1 class="border-textright"><font size="7" color="red">';
        echo "Erreur lors de l'insertion des données : " . mysqli_error($connexion);
        echo "</font></h1>";
        echo "<br>";
        echo "<button>";
        echo '<a href="index.html">Retour a la page de connexion</a>';
        echo "</button>";
    }
    // Fermer la connexion à la base de données
    mysqli_close($connexion);
}

?>
</center>
</body>
</html>
