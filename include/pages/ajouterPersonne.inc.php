
	<h1>Ajouter une personne</h1>

	<?php if(empty($_POST['per_login'])) { ?>
		<form action="index.php?page=1" id="personne" method="post">
	<p class=pg>
		Nom : <input type="text" id="champ" name="per_nom" size="10"><br>
		Téléphone : <input type="text" id="champ" name="per_tel" size="10"><br>
		Login : <input type="text" id="champ" name="per_login" size="10">
	</p>
	<p class=pdr>
		Prénom : <input type="text" id="champ" name="per_prenom" size="10"><br>
		Mail : <input type="mail" id="champ" name="per_mail" size="10"><br>
		Mot de passe : <input type="password" id="champ" name="per_pwd" size="10">
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
		$personne = new Personne ($_POST);
		if($manager->exists($personne)===true){
			?><p><img src="image/erreur.png" alt="Erreur" title="Erreur" />Ajout impossible : Login/Email déja utilisé</p> <?php
		} else {
			$manager->addPersonne($personne); ?>
			<p><img src="image/valid.png" alt="Validé" title="Validé" /> 
		    <?php echo $_POST['per_prenom']?> <?php echo $_POST['per_nom']?> a été ajouté(e)</p>
		
	<?php }
	} ?>