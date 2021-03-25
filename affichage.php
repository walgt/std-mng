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

$sql =   "SELECT id_commune FROM Commune WHERE  nom_commune='".$_SESSION['commune']."'";        
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  					while($row = mysqli_fetch_assoc($result)) {
   						 $id_commune = $row["id_commune"];
  					}
				}

$sql =   "SELECT id_wilaya FROM Wilaya WHERE  nom_wilaya='".$_SESSION['wilaya']."'";        
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  					while($row = mysqli_fetch_assoc($result)) {
   						 $id_wilaya = $row["id_wilaya"];
  					}
				}

$sql =   "SELECT id_mention_bac FROM Mention WHERE  nom_mention='".$_SESSION['mention']."'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  					while($row = mysqli_fetch_assoc($result)) {
   						 $id_mention = $row["id_mention_bac"];
  					}
				}

$sql =   "SELECT id_serie_bac FROM Serie WHERE  nom_serie='".$_SESSION['serie']."'";        
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  					while($row = mysqli_fetch_assoc($result)) {
   						 $id_serie = $row["id_serie_bac"];
  					}
				}









$var = $_SESSION['date'];
$date = str_replace('/', '-', $var);
$date = date('Y-m-d', strtotime($date));


$nom=addslashes($_SESSION['nom']);
$prenom=addslashes($_SESSION['prenom']);
$email=addslashes($_SESSION['email']);
$num=addslashes($_SESSION['num']);
$adr=addslashes($_SESSION['adr']);
$lycee=addslashes($_SESSION['lycee']);
$deb_s= addslashes($_SESSION['annd']);
$fin_s= addslashes($_SESSION['annf']);
$moy = addslashes($_SESSION['moy']); 
$deb_u=addslashes($_SESSION['anndf']); 
$pfe=addslashes($_SESSION['pfe']);
$lieu=addslashes($_SESSION['lieuden']);






$sql =   "SELECT *  FROM Utilisateur ";        
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {

		 $sql = "ALTER TABLE Utilisateur AUTO_INCREMENT = 1";
		 $result = mysqli_query($conn, $sql);
	}








$sql = "INSERT INTO `Utilisateur` (`nom`, `prenom`, `date_naiss`, `lieu_naiss` , `email` , `tel` , `adr` , `id_commune` , `id_wilaya`, `lycee`, `deb_s` , `fin_s` , `id_serie_bac`, `id_mention_bac`, `moy_bac`, `deb_u` , `titre_PFE`)VALUES('$nom','$prenom','$date','$lieu','$email','$num','$adr','$id_commune','$id_wilaya','$lycee','$deb_s','$fin_s','$id_serie','$id_mention','$moy','$deb_u',' $pfe')";


if (!mysqli_query($conn, $sql)) {

  echo "il y a une erreur avec le SGBD: " . $sql . "<br>" . mysqli_error($conn);
}


$_SESSION['number'] = 3;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Page d’Information – Walid BENCHABEKH</title>
		<meta charset="UTF-8">

</head>
<body text="#000066" >
	<!--
<a href="../user/user.php" >Trouver un utilisateur</a> <br />
<a href="index.php" >Ajouter un nouvel utilisateur</a>
-->
	<?php 


	$ac = intval(date("Y"));
		  $mc = intval(date("m"));
		  $jc = intval(date("d"));

		  $an = intval($_SESSION['date']{6}.$_SESSION['date']{7}.$_SESSION['date']{8}.$_SESSION['date']{9});
		  $mn = intval($_SESSION['date']{3}.$_SESSION['date']{4});
		  $jn = intval($_SESSION['date']{0}.$_SESSION['date']{1});


		  $age=$ac-$an;

		   if($mn>$mc)
				$age=$age-1;
			elseif($mn==$mc)
				if($jn<$jc)
				$age=$age-1;



	?>
	<h3 align="right" valign="top">Bienvenue  <?php echo $_SESSION['prenom'] . "  " . $_SESSION['nom'] ."  (".$age."  ans )" ?></h3>
	
		<!--<a href="./Pages/index.htm"> -->
	<img SRC= <?php echo $_SESSION['nom_photo'] ?> align="right" valign="top" width="200px" height="300px" >
	<!--</a>-->

<!-- Afin d'écrire tout en noir -->
<font color="Black" > 
	<!-- Création d'un tableau afin d'encadrer le contenu de la page avec un cadre rouge de 3 pixels avec fond blanc --> 
<table border="3px" bordercolor="red" bgcolor="white"  width="75%" cellspacing="15px" cellpadding="15px" align="left"> 
<tr> 
<!-- Afin d'encadrer chaque section de la page avec un cadre orange de 2 pixels avec fond gris clair --> 
<td style="border: 2px solid orange" bgcolor="#C0C0C0">
	 <!-- Titre de niveau 1 centrés -->
	<h1 align="center" id="ip"> <font  color="red"> Informations Personnelles  </font></h1> 
	<!--Bleu nuit pour écrire les informations personnelles + Formatage du texte -->
	<font color="#000066" face = "Verdana"> 
	<!-- Création d'un tableau afin d'encadrer les informations de chaque section de la page avec un cadre noir de 1 pixel avec fond gris étain -->
	<table border="1px" bordercolor="black" bgcolor="#DCDCDC"  align="center" style="border-collapse: collapse;" cellspacing="0px" cellpadding="5px" width="100%">
	<tr><td>
		<!--l'Utilisation des tableaux sans bordures afin d'assurer l’alignement vertical-->
		<table align="center">
		<!--le titre de chaque information est en gras -->
		<tr ><td align="right"><b>Nom</b><td>:<td> <?php echo $_SESSION['nom']; ?> 
		<tr ><td align="right"><b>Prénom <td>:<td> </b><?php echo $_SESSION['prenom']; ?>
		<tr ><td align="right" ><b>Date de Naissance <td>:<td></b>  <?php echo $_SESSION['date']; ?>
		<tr ><td align="right"><b>Lieu de Naissance <td>:<td></b>   <?php echo $_SESSION['lieuden']; ?>
		</table>
	</table>
	</font>
<tr> 
<!-- Afin d'encadrer chaque section de la page avec un cadre orange de 2 pixels avec fond gris clair --> 
<td style="border: 2px solid orange" bgcolor="#C0C0C0">
	<br /><h1 align="center" id="idc"><font  color="red" >Informations de Contact</font></h1><!-- Titre de niveau 1 centrés -->
	<font  face = "Verdana"> <!--Formatage du texte -->
	<!-- Création d'un tableau afin d'encadrer les informations de chaque section de la page avec un cadre noir de 1 pixel avec fond gris étain -->
	<table border="1px" bordercolor="black" bgcolor="#DCDCDC"  align="center" style="border-collapse:collapse;" cellspacing="0px" cellpadding="5px" width="100%">
		<tr><td>
		<!--l'Utilisation des tableaux sans bordures afin d'assurer l’alignement vertical-->
		<table align="center">
			<!-- L'ajout du lien vers un service de messagerie -->
		<tr ><td align="right"><b>Email <td>:<td> </b><a href=<?php echo "mailto:" . $_SESSION['email']; ?> >Envoyez-moi un e-mail !</a>
		<tr><td  align="right"><b>Numéro de téléphone <td>:<td> </b><?php echo $_SESSION['num']; ?>
		<tr ><td align="right"><b>Adresse <td>:<td> </b><?php echo $_SESSION['adr']; ?>
		<tr ><td align="right"><b>Commune <td>:<td> </b><?php echo $_SESSION['commune']; ?>
		<tr ><td align="right"><b>Wilaya <td>:<td> </b> <?php echo $_SESSION['wilaya']; ?>
		</table>
	</table>
	</font>
<tr> 
<!-- Afin d'encadrer chaque section de la page avec un cadre orange de 2 pixels avec fond gris clair --> 
<td style="border: 2px solid orange" bgcolor="#C0C0C0">
	<br /><h1 align="center" id="islc"><font color="red">Informations sur le Cursus</font></h1><!-- Titre de niveau 1 centrés -->
	<font face = "Verdana"> <!--Formatage du texte -->
	<ol> 
		<li>Cycle Secondaire <!-- Liste numérotées -->
			<ul>
			<!-- Création d'un tableau afin d'encadrer les informations de chaque section de la page avec un cadre noir de 1 pixel avec fond gris étain -->
			<table border="1px" bordercolor="black" bgcolor="#DCDCDC"  align="center" style="border-collapse:collapse;" cellspacing="0px" cellpadding="5px" width="100%">
			<tr><td><li><b>Lycée </b>: <?php echo $_SESSION['lycee']; ?> <!-- Liste à puces -->
			<li><b>Année de début </b>: <?php echo $_SESSION['annd']; ?>
			<li><b>Année de fin </b>: <?php echo $_SESSION['annf']; ?>
			</table>
			</ul>
		<li>Bac
			<dl>
			<!-- Création d'un tableau afin d'encadrer les informations de chaque section de la page avec un cadre noir de 1 pixel avec fond gris étain -->
			<table border="1px" bordercolor="black" bgcolor="#DCDCDC"  align="center" style="border-collapse:collapse;" cellspacing="0px" cellpadding="5px" width="100%">
			<tr><td><dt><b>Série</b>
				<dd><?php echo $_SESSION['serie']; ?> <!-- Liste de définitions -->
			<dt><b>Mention</b>
				<dd><?php echo $_SESSION['mention']; ?>
			<dt><b>Moyenne</b>
				<dd><?php echo $_SESSION['moy']; ?>
			</table>
			</dl>
		<li>Cycle Universitaire
			<ul>
			<!-- Création d'un tableau afin d'encadrer les informations de chaque section de la page avec un cadre noir de 1 pixel avec fond gris étain -->
			<table border="1px" bordercolor="black" bgcolor="#DCDCDC"  align="center" style="border-collapse:collapse;" cellspacing="0px" cellpadding="5px" width="100%">
			<!-- L'ajout du lien de site de l'université -->
			<tr><td><li><b> Université </b>: <a href="www.usthb.dz" target="_top">U.S.T.H.B</a>  
			<li><b>Année de début </b>: <?php echo $_SESSION['anndf']; ?>
			<li><b>Titre P.F.E. </b>: <?php echo $_SESSION['pfe']; ?>
			</table>
			</ul>
	</ol>
	</font>

</font>
<a href="../user/user.php" ><font color="red" size="5">Trouver un utilisateur </font></a> <br />
<a href="index.php" ><font color="red" size="5">Ajouter un nouvel utilisateur </font></a>
</table>
<?php
//remove all session variables
session_unset();

// destroy the session
session_destroy();


?>

</body>
</html>
