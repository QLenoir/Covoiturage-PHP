<?php require '/include/autoLoad.inc.php';
  require '/include/config.inc.php'?>
<h1>Ajouter une ville</h1>

	<?php if(empty($_POST['vil_nom'])) { ?>
	<form action="index.php?page=7" id="NO_COMMANDE" method="post">
		Nom : <input type="text" name="vil_nom" size="4"><br>
		<input type=submit value="Valider">
	</form>
	<?php } else { 
		$db = new Mypdo();
		$manager = new VilleManager($db);
		$ville = new Ville (
			array('vil_nom' => $_POST['vil_nom'])
		);
		
		$manager->addVille($ville);
	?>
	<img src="image/valid.png" alt="Validé" title="Validé" /> 
	<p > La ville "<bold><?php echo $_POST['vil_nom']?></bold>" a été ajoutée</p>

	<?php } ?>
