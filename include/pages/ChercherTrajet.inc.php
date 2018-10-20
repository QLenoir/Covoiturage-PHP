<?php if(!isset($_SESSION['login'])) {
	header('Location: index.php?page=0');
	}
	$db = new Mypdo();
	$manager = new ProposeManager($db);
 ?>
<h1>Rechercher un trajet</h1>

<form action="index.php?page=10" id="vil_nom" method="post">
	<p><label>Ville de départ : </label></p>
	<p><select id="champ" size="1" name="vil_num1" >
	<option value="0" > Choisissez </option>
	<?php $listeParcours = $manager->getVilleDepart(); 
		foreach ($listeParcours as $attribut => $value) { ?>
				<option value= <?php echo $value->getVilNum() ?> > <?php echo $manager->recupNomVille($value->getVilNum()) ?> </option>
	<?php } ?>
	</select></p>
	<p><input id="valider" type=submit value="Valider"></p>
</form>