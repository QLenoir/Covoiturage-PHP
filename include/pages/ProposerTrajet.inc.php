<?php if(!isset($_SESSION['login'])) {
	header('Location: index.php?page=0');
} ?>
<h1>Proposer un trajet</h1>
<?php 
	$db = new Mypdo();
	$manager = new ParcoursManager($db);
	if(empty($_POST['vil_num1'])) { ?>
	<form action="index.php?page=9" id="vil_nom" method="post">
		<p><label>Ville de départ : </label></p>
		<p><select id="champ" size="1" name="vil_num1" >
		<option value="0" > Choisissez </option>
		<?php $listeParcours = $manager->getAllVilleParcours(); 
			foreach ($listeParcours as $attribut => $value) { ?>
					<option value= <?php echo $value->getVilNum() ?> > <?php echo $value->getVilNom() ?> </option>
		<?php } ?>
		</select></p>
		<p><input id="valider" type=submit value="Valider"></p>
	</form>
	<?php } ?> 