<?php
	$db = new Mypdo();
	$manager = new PersonneManager($db);
	//$personnes = $manager->getAllPersonne();

	if(!isset($pers)){ ?>
		
	<h1>Modifier une personne enregistrée</h1>
	
	<form action="index.php?page=3" id="personne" method="post">
			<div class="pers">
				<div  class=pg>
					<p><b>Nom : </b><input type="text" class="champ" name="per_nom" size="10" required></p><br>
					<p><b>Téléphone : </b><input type="tel" pattern='\d{2}\d{2}\d{2}\d{2}\d{2}' title="0XXXXXXXXX" class="champ" name="per_tel" size="10" required></p><br>
					<p><b>Login : </b><input type="text" class="champ" name="per_login" size="10" required></p><br>
				</div>
				<div class=pdr>
					<p><b>Prénom : </b><input type="text" class="champ" name="per_prenom" size="10" required></p><br>
					<p><b>Mail : </b><input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="champ" name="per_mail" size="10" required></p><br>
					<p><b>Mot de passe : </b><input type="password" class="champ" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Doit contenir au moins 1 chiffre, 1 lettre majuscule et 1 lettre minuscule et doit au moins faire 8 caractères" name="per_pwd" size="10" required></p><br>
				</div>
			</div>
			<div class="cat">

				<p><input class="valider" type=submit value="Valider"></p>
			</div>
		</form>
<?php }
else{
	$pers= new Personne($_POST);

	if($manager->exists($pers)===false) { ?>
		<p><img src="image/erreur.png" alt="Erreur" title="Erreur" /> Modification impossible : cette personne n'est pas présente dans la base</p> <?php
	}
	else{
		$manager->modifierPersonne($pers);
		?>
		<p><img src="image/valid.png" alt="Validé" title="Validé" /> Cette personne a été modifiée</p>
		<?php
	}
	
}?>