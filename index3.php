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




if ($_SESSION['number'] == 1 || $_SESSION['number'] == 3) {
$_SESSION['number'] = 2;
    
} 
else  if(isset($_POST['submit3'])) {
    if (empty($_POST["lycee"])){
	$lycee = "<font color=\"red\">Il faut saisir le champ Lycée. </font>";
	unset($_SESSION["lycee"]);
	}
if (empty($_POST["moy"])){
	$moy =  "<font color=\"red\">Il faut saisir le champ Moyenne. </font>";
	unset($_SESSION["moy"]);
	}
	else{

		$pattern = "/^[1-9][0-9][\.,][0-9][0-9]$/";
		$bef=$_POST["moy"];
		$beff=floatval($_POST["moy"]);
		if(preg_match($pattern, $bef)!=1 || $beff<10.00 || $beff >19.99){
			$moy = "<font color=\"red\">Moyenne non valide. </font>";
			unset($_SESSION["moy"]);

		} 


	}
if(empty($_POST["pfe"])){
	$pfe = "<font color=\"red\">Il faut saisir le champ Titre P.F.E. </font>";
	unset($_SESSION["pfe"] );
	}

if($_POST['annd']+3 >$_POST['annf'])
	$dl = "<font color=\"red\">L’année début du lycée + 3 est supérieur à l’année de fin du lycée</font>";

if($_POST['annf'] > $_POST['anndf'])
	$df =  "<font color=\"red\">L’année de début du cycle universitaire est antérieure à l’année de
fin du lycée</font>";
$ac = intval(date("Y"));
$mc = intval(date("m"));
$jc = intval(date("d"));
$an = intval($_POST['date']{6}.$_POST['date']{7}.$_POST['date']{8}.$_POST['date']{9});
$mn = intval($_POST['date']{3}.$_POST['date']{4});
$jn = intval($_POST['date']{0}.$_POST['date']{1});

$age=$ac-$an;
if($mn>$mc)
	$age=$age-1;
elseif($mn==$mc)
	if($jn<$jc)
		$age=$age-1;
	if (!(isset($lycee) || isset($moy) || isset($pfe) || isset($dl) || isset($df))) {
		$_SESSION["lycee"] =$_POST["lycee"];
		$_SESSION["annd"] =$_POST["annd"];
		$_SESSION["annf"] =$_POST["annf"];
		$_SESSION["serie"] =$_POST["serie"];
		$_SESSION["mention"] =$_POST["mention"];
		$_SESSION["moy"] =$_POST["moy"];
		$_SESSION["anndf"] =$_POST["anndf"];
		$_SESSION["pfe"] =$_POST["pfe"];			
		$newURL = "affichage.php";
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

<!--<a href="./Pages/index.htm">
	<img SRC="photo1.jpg" align="right" valign="top" width="200px" height="300px" >
</a>-->
<form action="index3.php" method="post">
<!-- Afin d'écrire tout en noir -->
<font color="Black" > 
	<!-- Création d'un tableau afin d'encadrer le contenu de la page avec un cadre rouge de 3 pixels avec fond blanc --> 
<table border="3px" bordercolor="red" bgcolor="white"  width="100%"   height="100%" cellspacing="15px" cellpadding="15px" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0;"> 
<tr> 
<!-- Afin d'encadrer chaque section de la page avec un cadre orange de 2 pixels avec fond gris clair --> 
<td style="border: 2px solid orange" bgcolor="#C0C0C0">
	<br /><h1 align="center" id="islc"><font color="red">Informations sur le Cursus</font></h1><!-- Titre de niveau 1 centrés -->
	<font face = "Verdana"> <!--Formatage du texte -->
	<ol> 
		<li>Cycle Secondaire <!-- Liste numérotées -->
			<ul>
			<!-- Création d'un tableau afin d'encadrer les informations de chaque section de la page avec un cadre noir de 1 pixel avec fond gris étain -->
			<table border="1px" bordercolor="black" bgcolor="#DCDCDC"  align="center" style="border-collapse:collapse;" cellspacing="10px" cellpadding="5px" width="100%" >

			<tr><td><li><b>Lycée </b>: <input type="text" name="lycee" placeholder="Nom_établissement" <?php if(isset($_SESSION["lycee"])) echo 'value = "'.$_SESSION["lycee"].'"'; else echo 'value = "'.$_POST["lycee"].'"'; ?>> <!-- Liste à puces -->
				<?php echo "<br />".$lycee; ?>
			<li><b>Année de début </b>: <select name = "annd">
  						<option value="2005" selected>2005</option>
						<option value="2006">2006</option>
						<option value="2007">2007</option>
						<option value="2008">2008</option>
						<option value="2009">2009</option>
						<option value="2010">2010</option>
						<option value="2011">2011</option>
						<option value="2012">2012</option>
						<option value="2013">2013</option>
						<option value="2014">2014</option>
						<option value="2015">2015</option>	
					</select>
			<li><b>Année de fin </b>: <select name = "annf">
  							<option value="2010" selected>2010</option>
							<option value="2011">2011</option>
							<option value="2012">2012</option>
						    <option value="2013">2013</option>
							<option value="2014">2014</option>
							<option value="2015">2015</option>
							<option value="2016">2016</option>
							<option value="2017">2017</option>
					</select>
					<?php echo "<br />".$dl; ?>
			</table>
			</ul>
		<li>Bac
			<dl>
			<!-- Création d'un tableau afin d'encadrer les informations de chaque section de la page avec un cadre noir de 1 pixel avec fond gris étain -->
			<table border="1px" bordercolor="black" bgcolor="#DCDCDC"  align="center" style="border-collapse:collapse;" cellspacing="10px" cellpadding="5px" width="100%">
			<tr><td><dt><b>Série</b>
				<dd><select name = "serie">
  						<?php
				$sql = "SELECT * FROM Serie";          
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
  					while($row = mysqli_fetch_assoc($result)) {
   						 echo '<option value="'.$row["nom_serie"].'" >'.$row["nom_serie"].'</option>';
  					}
				}
				?>
					</select> <!-- Liste de définitions -->
			<dt><b>Mention</b>
				<dd><select name = "mention">
  						<?php
				$sql = "SELECT * FROM Mention";          
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
  					while($row = mysqli_fetch_assoc($result)) {
   						 echo '<option value="'.$row["nom_mention"].'" >'.$row["nom_mention"].'</option>';
  					}
				}
				?>
					</select>
			<dt><b>Moyenne</b>
				<dd> <input type="text" name="moy" placeholder="MM,MM" <?php if(isset($_SESSION["moy"])) echo 'value = "'.$_SESSION["moy"].'"'; else echo 'value = "'.$_POST["moy"].'"'; ?>>
					<?php echo "<br />".$moy; ?>
			</table>
			</dl>
		<li>Cycle Universitaire
			<ul>
			<!-- Création d'un tableau afin d'encadrer les informations de chaque section de la page avec un cadre noir de 1 pixel avec fond gris étain -->
			<table border="1px" bordercolor="black" bgcolor="#DCDCDC"  align="center" style="border-collapse:collapse;" cellspacing="10px" cellpadding="5px" width="100%">
			<!-- L'ajout du lien de site de l'université -->
			<tr><td><li><b> Université </b>: <a href="www.usthb.dz" target="_top">U.S.T.H.B</a>  
			<li><b>Année de début </b>: <select name = "anndf">
  							<option value="2010">2010</option>
							<option value="2011">2011</option>
							<option value="2012">2012</option>
						    <option value="2013">2013</option>
							<option value="2014">2014</option>
							<option value="2015">2015</option>
							<option value="2016">2016</option>
							<option value="2017">2017</option>
					</select>
					<?php echo "<br />".$df; ?>
			<li><b>Titre P.F.E. </b>: <textarea name="pfe" placeholder="Titre_de_votre_projet" ><?php if (isset($_SESSION["pfe"])) echo $_SESSION["pfe"]; else echo $_POST["pfe"]; ?></textarea>
				<?php echo "<br />".$pfe; ?>
			</table>
			</ul>
	</ol>
	</font>
<br />
<br />
<br />
<div style="text-align:center;  width: 100%">
<input type="submit" value="Suivant" name="submit3"  >
</div>
</form>
<a href="index2.php" >Précédent </a>
</font>
</body>
</html>