<html>
<head>
  <title>ProjetDuKyks - Accueil</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="index.css">
  <link rel="icon" href="images/print2.jpg">
        <style>
         .left {
            float: left;
            width: 30%;
         }
         .right {
            float: right;
            width: 70%;
         }
         .clear {
            clear: both;
         }
      </style>
</head>

<body>

  <center>
    <h1 class="border-title"><font size=7 color=red><i>PROJET DU KYK'S : REPROGRAPHIE - ACCUEIL</i></font></h1>
  </center>
  
  <div class="left">

    <font color="white">
    <center>
    <h3 class="border-textleft">
      <center>
      Informez vous
      </center>
    </h3>

    <p class="border-textleft">
      <font size=3>
      <i>
        <b>FACILITEZ L'IMPRESSION AVEC "PROJET DU KYK'S" !</b>
        </br>
        </br>
        </br>
        Envoyez les pièces jointes que vous souhaitez imprimer en toute simplicité !
        </br>
        </br>
        </br>
        <b>Envoyez vos documents à l'adresse mail du lycée Jean PERRIN</b>
        </br>
        </br>
        À vous de jouer ! 
      </i>
      </font>
    </p>
    </center> 
  <footer class="border-textleft">
    <center>
    <p>Copyright © 2023 - ProjetDuKyks | Contact : soilihi.kyllian@gmail.com</p>
    </center>
  </footer>
  </font>

  </div>

<div class="right">
    
  <?PHP
      session_start();
      $username = $_SESSION['username'];
      echo '<h1 class="border-textright">';
      echo '<center><font color="white">';
      echo "Bienvennue, $username !";
      echo "</font></center>";
      echo "</h1>"; 
  ?>

    <h3 class="border-textright">
      <center>
      <button><a href="newmessage.html">Nouveau Message</a></button>
      <button><a href="index.html">Deconnexion</a></button>
      </center>
    </h3>

  <div class="border-scroll">
  <h3>
  <center>
  <font color=white size=5>
  <i>Historique :</i>
  <br><br>
  </font>
  <font color=white size=2>

  <?php

      session_start();
      $nom = $_SESSION['username'];
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
      $requete = "SELECT * FROM historique WHERE name = '$nom';";
      $resultat = mysqli_query($connexion, $requete);

      if(!$resultat)
      {
        die("Erreur lors de l'exécution de la requête :" .mysqli_error($connexion));
      }
      else
      {
        while ($ligne = mysqli_fetch_assoc($resultat))
        {
          echo "| ";
          echo "Objet : " . $ligne['subject'] ." | ";
          echo "Destinataire : " . $ligne['destination'] ." | ";
          echo "Date d'envoi : " . $ligne['datemail'] ." | ";
          echo "Heure d'envoi : " . $ligne['hourmail'] ." | ";
          echo "<br>";
          echo "<br>";
        }
      }
      mysqli_free_result($resultat);
      mysqli_close($connexion);

  ?>

  </font>
  </center>
  </h3>
  </div>

</div>

</body>
</html>