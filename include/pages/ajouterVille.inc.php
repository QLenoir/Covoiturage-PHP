<h1>Ajouter une ville</h1>

	<?php if(empty($_POST['vil_nom'])) { ?>
	<form action="index.php?page=7" id="NO_COMMANDE" method="post">
		<label>Nom : </label><input type="text" name="vil_nom" size="4">
		<input type=submit value="Valider">
	</form>
	<?php } else { 
		$db = new Mypdo();
		$manager = new VilleManager($db);
		$ville = new Ville (
			array('vil_nom' => $_POST['vil_nom'])
		);
		if($manager->exists($ville->getVilNom())===true){
			?><p><img src="image/erreur.png" alt="Erreur" title="Erreur" /> Ajout impossible : ville déja présente</p> <?php
		} else {
			$manager->addVille($ville); ?>
				<p> <img src="image/valid.png" alt="Validé" title="Validé" /> La ville "<strong><?php echo $_POST['vil_nom']?></strong>" a été ajoutée</p>
		
	<?php }
	} ?>
