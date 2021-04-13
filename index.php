<?php

session_start();
/*

if(isset($_POST['submit'])){
	echo "sah valida";
}
else
	echo "non refricha";
*/

if (!isset($_SESSION['number']) || $_SESSION['number']==1) {
$_SESSION['number'] = 0;
    
}


//if(!$pageWasRefreshed)
else  if(isset($_POST['submit'])) {
    if (empty($_POST["nom"])){
	$nom = "<font color=\"red\">Il faut saisir le champ Nom. </font>";
		unset($_SESSION["nom"]) ;
		
	}
	else{
		$pattern = "/^[A-Z][a-z]{0,}([- ][A-Z][a-z]{0,}){0,}[a-z]$/";
		if(preg_match($pattern, $_POST["nom"])!=1){
			$nom = "<font color=\"red\">Nom non valide</font><br />";
			unset($_SESSION["nom"]);
		} 
	}
	if (empty($_POST["prenom"])){
	$prenom = "<font color=\"red\">Il faut saisir le champ Prénom. </font>";
	unset($_SESSION["prenom"] );
		
	}
	else{
		$pattern = "/^[A-Z][a-z]{0,}([- ][A-Z][a-z]{0,}){0,}[a-z]$/";
		if(preg_match($pattern, $_POST["prenom"])!=1){
		$prenom =  "<font color=\"red\">Prénom non valide.  </font>";
		unset($_SESSION["prenom"] );
		} 
	}

	if (empty($_POST["date"])){
	$date = "<font color=\"red\">Il faut saisir le champ Date de Naissance	. </font>";
	unset($_SESSION["date"]);
		
	}
	else{
		$d=1;
		$pattern = "/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/";
		if(preg_match($pattern, $_POST["date"])!=1){
		$d=0;
		} 

		$exp_reg="/\//";
		$tab=preg_split($exp_reg , $_POST["date"] );

		$j = intval($tab[0]);
		$m = intval($tab[1]);
		$a = intval($tab[2]);


		$b =checkdate($m, $j, $a);
		if(!$b || !$d){
		$date = "<font color=\"red\"> Date non valide.  </font>";
		unset($_SESSION["date"] );
		}
		}

$servername = "XXXX";
$username = "XXXX";
$password = "XXXX";
$dbname = "atelier";




// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$sql =   "SELECT id  FROM Utilisateur GROUP BY id DESC";        
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
               $id = $row["id"];
               break;
              
            }

            
        }
        $id=intval($id) + 1;
     






$target_dir = "../user/";
$file_ext=strtolower(end(explode('.',$_FILES['fileToUpload']['name'])));
$target_file = $target_dir . $id.".".$file_ext;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));





// Check file size
if ($_FILES["fileToUpload"]["size"] > 2000000) {
  $photo .= "<font color=\"red\">la taille de la photo ne doit pas dépasser 2 mo..</font>";
  $uploadOk = 0;
}

// Allow certain file formats

if( $imageFileType != "jpg" && $imageFileType != "jpeg") {
  $photo .= "<font color=\"red\"> La photo doit être un fichier format JPEG .</font>";
  $uploadOk = 0;
}




if($imageFileType == "jpg"){

$file_pointer = $target_dir . $id.".jpeg";
if (file_exists($file_pointer))  
{ 
    unlink($file_pointer);
} 



}
elseif ($imageFileType == "jpeg") {
	

$file_pointer = $target_dir . $id.".jpg";
if (file_exists($file_pointer))  
{ 
    unlink($file_pointer);
} 

}




// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $photo .= "<br /><font color=\"red\">désoler votre photo n'a pas été téléchargé.</font>";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    // echo "The file ".  $id.$file_ext. " has been uploaded.";
  } else {
   $photo .= "<br /><font color=\"red\">désoler une erreur lors le téléchargement de votre photo vers un serveur .</font>";
    $uploadOk == 0;
  }
}

		if (!(isset($nom) || isset($prenom) || isset($date) || isset($photo))) {
			$_SESSION["nom"] =$_POST["nom"];
			$_SESSION["prenom"] =$_POST["prenom"];
			$_SESSION["date"] =$_POST["date"];
			$_SESSION["lieuden"] =$_POST["lieuden"];
			$_SESSION["nom_photo"] =$target_file;
			$_SESSION["nom_tmp"]=$_FILES["fileToUpload"]["tmp_name"];
			$newURL = "index2.php";
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

<form action="index.php" method="post"  enctype="multipart/form-data" >
<!-- Afin d'écrire tout en noir -->
<!--<font color="Black" > -->
	<!-- Création d'un tableau afin d'encadrer le contenu de la page avec un cadre rouge de 3 pixels avec fond blanc --> 
<table border="3px" bordercolor="red" bgcolor="white"  width="100%"   height="100%" cellspacing="15px" cellpadding="15px" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0;"> 

<tr> 
<!-- Afin d'encadrer chaque section de la page avec un cadre orange de 2 pixels avec fond gris clair --> 
<td style="border: 2px solid orange" bgcolor="#C0C0C0" >
	 <!-- Titre de niveau 1 centrés -->
	<h1 align="center" id="ip"> <font  color="red"> Informations Personnelles  </font></h1> 
	<!--Bleu nuit pour écrire les informations personnelles + Formatage du texte -->
	<font  face = "Verdana"> 
	<!-- Création d'un tableau afin d'encadrer les informations de chaque section de la page avec un cadre noir de 1 pixel avec fond gris étain -->
	<table border="1px" bordercolor="black" bgcolor="#DCDCDC"  valign="top" style="border-collapse: collapse;" cellspacing="0px" cellpadding="5px" width="100%" >
	<tr><td>
		<!--l'Utilisation des tableaux sans bordures afin d'assurer l’alignement vertical-->
		<table align="center" cellspacing="10px">
		<!--le titre de chaque information est en gras -->
		<tr ><td align="right"><b>Nom</b><td>:<td> <input type="text" name="nom" placeholder="Votre_Nom" <?php if (isset($_SESSION["nom"])) echo 'value = "'.$_SESSION["nom"].'"'; else echo 'value = "'.$_POST["nom"].'"'; ?> > 
		<?php echo "<br />".$nom; ?>
		<tr ><td align="right"><b>Prénom <td>:<td> </b> <input type="text" name="prenom" placeholder="Votre_Prénom" <?php if(isset($_SESSION["prenom"])) echo 'value = "'.$_SESSION["prenom"].'"'; else echo 'value = "'.$_POST["prenom"].'"'; ?>>
		<?php echo  "<br />".$prenom; ?>
		<tr ><td align="right" ><b>Date de Naissance <td>:<td></b>  <input type="text" name="date" placeholder="JJ/MM/AAAA" <?php if (isset($_SESSION["date"])) echo 'value = "'.$_SESSION["date"].'"'; else echo 'value = "'.$_POST["date"].'"'; ?> >
		<?php echo  "<br />".$date; ?>
		<tr ><td align="right"><b>Lieu de Naissance <td>:<td></b>  <select name = "lieuden">
  						<option value="Sidi M'Hamed" <?php if($_POST['lieuden']=="Sidi M'Hamed") echo "selected"; else if($_SESSION['lieuden']=="Sidi M'Hamed") echo "selected" ; ?> >Sidi M'Hamed</option>
  						<option value="Beni Messous" <?php if($_POST['lieuden']=="Beni Messous") echo "selected";  else if($_SESSION['lieuden']=="Beni Messous") echo "selected" ;?>>Beni Messous</option>
  						<option value="Kouba" <?php if($_POST['lieuden']=="Kouba") echo "selected";  else if($_SESSION['lieuden']=="Kouba") echo "selected" ;?>>Kouba</option>
  						<option value="Hydra" <?php if($_POST['lieuden']=="Hydra") echo "selected";  else if($_SESSION['lieuden']=="Hydra") echo "selected" ;?>>Hydra</option>
					</select>
		<tr ><td align="right"><b>Photo <td>:<td></b>   
			<input type="file" name="fileToUpload" id="fileToUpload">
			<?php echo  "<br />".$photo; ?>

		</table>
	</table>
	</font>
<br />
<br />
<br />
<div style="text-align:center;  width: 100%">
<input type="submit" value="Suivant" name="submit"  >
</div>
<a href="../user/user.php" >Trouvez un utilisateur</a>
</form>
<!--</font>-->
</table>
</body>
</html>