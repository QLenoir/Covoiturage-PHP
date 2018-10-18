
	<h1>Ajouter une personne</h1>

	<?php if(empty($_POST['p_nom'])) { ?>
		<form action="index.php?page=1" id="personne" method="post">
	<p class=pg>
		Nom : <input type="text" name="p_nom" size="10"><br>
		Téléphone : <input type="text" name="p_tel" size="10"><br>
		Login : <input type="text" name="p_login" size="10">
	</p>
	<p class=pdr>
		Prénom : <input type="text" name="p_prenom" size="10"><br>
		Mail : <input type="text" name="p_mail" size="10"><br>
		Mot de passe : <input type="text" name="p_mdp" size="10">
	</p>
	<br>
	Catégorie : <input type="radio" name="p_categ" value=etu checked>Etudiant
				<input type="radio" name="p_categ" value=pers>Personnel
				<br>
	<input type=submit value="Valider">

</form>
		<?php } else { 
		$db = new Mypdo();
		$manager = new PersonneManager($db);
		$personne = new Personne (
			array('p_nom' => $_POST['p_nom'])
		);
		if($manager->exists($personne->getPersLogin())===true){
			?><img src="image/erreur.png" alt="Erreur" title="Erreur" /><p>Ajout impossible : Login déja utilisé</p> <?php
		} else {
			$manager->addPersonne($personne); ?>
			<img src="image/valid.png" alt="Validé" title="Validé" /> 
			<p> La ville "<bold><?php echo $_POST['p_nom']?></bold>" a été ajoutée</p>
		
	<?php }
	} ?>