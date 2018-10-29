<h1>Ajouter un parcours</h1>

<?php 
$db = new Mypdo();
$villeManager = new villeManager($db);
if(empty($_POST['par_km'])) { ?>
	<form action="index.php?page=5" id="NO_COMMANDE" method="post">
		<p>
			<label>Ville 1 : </label><select class="champ" size="1" name="vil_num1">
				<?php $listeParcours = $villeManager->getAllVille(); 
				foreach ($listeParcours as $attribut => $value) {
					?>
					<option value= <?php echo $value->getVilNum() ?> > <?php echo $value->getVilNom() ?> </option>
				<?php } ?>
			</select>
			<label>Ville 2 : </label><select class="champ" size="1" name="vil_num2">
				<?php $listeParcours = $villeManager->getAllVille(); 
				foreach ($listeParcours as $attribut => $value) {
					?>
					<option value= <?php echo $value->getVilNum() ?> > <?php echo $value->getVilNom() ?> </option>
				<?php } ?>
			</select>
			<label>Nombre de kilomètres : </label><input type="number" class="champ" name="par_km" size="4" min="1" max="1000" required>	
		</p>
		<input type=submit class="valider" value="Valider">
	</form>
<?php } else { 
	$manager = new ParcoursManager($db);
	$parcours = new Parcours (
		array('vil_num1' => $_POST['vil_num1'],
			'vil_num2' => $_POST['vil_num2'],
			'par_km' => $_POST['par_km'])
	);
	if ($_POST['vil_num1']===$_POST['vil_num2']) { ?>
		<p> <img src="image/erreur.png" alt="Erreur" title="Erreur" /> Les villes sélectionnées sont identiques</p>
	<?php } else if($manager->exists($parcours)) { ?>
		<p> <img src="image/erreur.png" alt="Erreur" title="Erreur" /> Le parcours existe déjà</p>
	<?php } else { 
		$manager->addParcours($parcours); ?>
		<p> <img src="image/valid.png" alt="Validé" title="Validé" /> Le parcours a été ajouté</p>
	<?php } 
}?>
