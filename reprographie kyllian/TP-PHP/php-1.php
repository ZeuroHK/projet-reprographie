<html>
<head>
	<title>resultat</title>
</head>
<body>

<?PHP
if(isset($_POST['quantite']))
{
	$prix = 9.99;
	$quantite = $_POST['quantite'];
	$total = $quantite * $prix;
	echo "quantité de pizzas : $quantite";
	echo '</br>';
	echo "prix total des pizzas : $total €";
	echo '</br>';
	echo "<i>bon appétit enculer</i>";
}
?>

</body>
</html>