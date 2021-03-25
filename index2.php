<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "aptx4869B";
$dbname = "atelier";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
/*
if(isset($_POST['submit'])){
	echo "sah valida";
}
else
	echo "non refricha";
*/

if ($_SESSION['number'] == 0 || $_SESSION['number'] == 2){
$_SESSION['number'] = 1;
    
} 
else  if(isset($_POST['submit2'])) {

	if (empty($_POST["email"])){
	$email = "<font color=\"red\">Il faut saisir le champ Email. </font>";
	unset($_SESSION["email"]) ;
		
	
	}
	if (empty($_POST["num"])){
	$num = "<font color=\"red\">Il faut saisir le champ Numéro de téléphone. </font>";
	unset($_SESSION["num"]) ;
		
	}
	if(empty($_POST["adr"])){
	$adr = "<font color=\"red\">Il faut saisir le champ Adresse. </font>";
	unset($_SESSION["adr"]) ;
		
	}

	if (!(isset($email) || isset($num) || isset($adr))) {
		$_SESSION["email"] =$_POST["email"];
		$_SESSION["num"] =$_POST["num"];
		$_SESSION["adr"] =$_POST["adr"];
		$_SESSION["commune"] =$_POST["commune"];
		$_SESSION["wilaya"] =$_POST["wilaya"];
		$newURL = "index3.php";
		header('Location: '.$newURL);
		die();
		}
}



?>
<!DOCTYPE html>
<html>
	<head>
		<title>Page d’Information – Walid BENCHABEKH</title>
		<meta charset="UTF-8">

</head>
<!--Bleu nuit comme couleur par défaut -->
<body text="#000066" style="background-color:grey;">

<form action="index2.php" method="post">
<!-- Afin d'écrire tout en noir -->
<font color="Black" > 
	<!-- Création d'un tableau afin d'encadrer le contenu de la page avec un cadre rouge de 3 pixels avec fond blanc --> 
<table border="3px" bordercolor="red" bgcolor="white"  width="100%"   height="100%" cellspacing="15px" cellpadding="15px" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0;"> 
<tr> 
<!-- Afin d'encadrer chaque section de la page avec un cadre orange de 2 pixels avec fond gris clair --> 
<td style="border: 2px solid orange" bgcolor="#C0C0C0">
	<br /><h1 align="center" id="idc"><font  color="red" >Informations de Contact</font></h1><!-- Titre de niveau 1 centrés -->
	<font  face = "Verdana"> <!--Formatage du texte -->
	<!-- Création d'un tableau afin d'encadrer les informations de chaque section de la page avec un cadre noir de 1 pixel avec fond gris étain -->
	<table border="1px" bordercolor="black" bgcolor="#DCDCDC"  align="center" style="border-collapse:collapse;" cellspacing="0px" cellpadding="5px" width="100%">
		<tr><td>
		<!--l'Utilisation des tableaux sans bordures afin d'assurer l’alignement vertical-->
		<table align="center" cellspacing="10px">
			<!-- L'ajout du lien vers un service de messagerie -->
		<tr ><td align="right"><b>Email <td>:<td> </b><input type="text" name="email" placeholder="votre_email@serveur_mail.extension" <?php if (isset($_SESSION["email"])) echo 'value = "'.$_SESSION["email"].'"'; else echo 'value = "'.$_POST["email"].'"'; ?>>
			<?php echo "<br />".$email; ?>
		<tr><td  align="right"><b>Numéro de téléphone <td>:<td> </b><input type="text" name="num" placeholder="+213 NNN NN NN NN" <?php if (isset($_SESSION["num"])) echo 'value = "'.$_SESSION["num"].'"'; else echo 'value = "'.$_POST["num"].'"'; ?>>
			<?php echo "<br />".$num; ?>
		<tr ><td align="right"><b>Adresse <td>:<td> </b><textarea name="adr" placeholder="votre_adresse" ><?php if (isset($_SESSION["adr"])) echo $_SESSION["adr"]; else echo $_POST["adr"]; ?></textarea>
			<?php echo "<br />".$adr; ?>
		<tr ><td align="right"><b>Commune <td>:<td> </b><select name = "commune">
				<?php
				$sql = "SELECT * FROM Commune";          
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
  					while($row = mysqli_fetch_assoc($result)) {

   						 echo '<option value="'.$row["nom_commune"];
   						 if($row["nom_commune"]==$_POST["commune"])
   						 echo '" selected >'.$row["nom_commune"].'</option>';
   						elseif($row["nom_commune"]==$_SESSION["commune"])
   						 echo '" selected >'.$row["nom_commune"].'</option>';
   						 else
   						 echo '" >'.$row["nom_commune"].'</option>';
  					}
				}
				?>
					</select>
		<tr ><td align="right"><b>Wilaya <td>:<td> </b> <select name = "wilaya">
				<?php
				$sql = "SELECT * FROM Wilaya";          
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
  					while($row = mysqli_fetch_assoc($result)) {
 
   						 echo '<option value="'.$row["nom_wilaya"];
   						 if($row["nom_wilaya"]==$_POST["wilaya"])
   						 echo '" selected >'.$row["nom_wilaya"].'</option>';
   						elseif($row["nom_wilaya"]==$_SESSION["wilaya"])
   						 echo '" selected >'.$row["nom_wilaya"].'</option>';
   						 else
   						 echo '" >'.$row["nom_wilaya"].'</option>';


  					}
				}
				?>
					</select>

		</table>
	</table>
	</font>
	<br />
<br />
<br />
<div style="text-align:center;  width: 100%">
<input type="submit" value="Suivant" name="submit2"  >
</div>

<a href="index.php" >Précédent </a>
</form>
</font>
</body>
</html>