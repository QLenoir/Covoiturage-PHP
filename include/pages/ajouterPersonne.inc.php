
<?php if(empty($_POST['per_login'])) { ?>
	<h1>Ajouter une personne</h1>

	<form action="index.php?page=1" id="personne" method="post">
		<div class="pers">
			<div  class=pg>
				<b>Nom : </b><input type="text" class="champ" name="per_nom" size="10" required><br>
				<b>Téléphone : </b><input type="tel" pattern='\d{2}\d{2}\d{2}\d{2}\d{2}' title="06XXXXXXXX" class="champ" name="per_tel" size="10" required><br>
				<b>Login : </b><input type="text" class="champ" name="per_login" size="10" required><br>
			</div>
			<div class=pdr>
				<b>Prénom : </b><input type="text" class="champ" name="per_prenom" size="10" required><br>
				<b>Mail : </b><input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="champ" name="per_mail" size="10" required><br>
				<b>Mot de passe : </b><input type="password" class="champ" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Doit contenir au moins 1 chiffre, 1 lettre majuscule et 1 lettre minuscule et doit au moins faire 8 caractères" name="per_pwd" size="10" required><br>
			</div>
		</div>
		<div class="cat">
			<b><p>Catégorie : <input type="radio" name="p_categ" value=etu checked>Etudiant
				<input type="radio" name="p_categ" value=pers>Personnel</p>
			</b><p><input class="valider" type=submit value="Valider"></p>
		</div>

	</form>
</div>
<?php } else { 
	if($_POST['p_categ']==="etu"){ ?>
		<h1>Ajouter un étudiant</h1>
		<form action="index.php?page=1" id="etudiant" method="post">

			Année : <select> </select>
			<br>
			Département : <select> </select>
			<br>
			
			<input type=submit value="Valider">

		<?php }
		if($_POST['p_categ']==="pers"){ ?>

			<h1>Ajouter un salarié</h1>
			<form action="index.php?page=1" id="salarie" method="post">

				Télephone professionnel :<input type="tel" pattern='\d{2}\d{2}\d{2}\d{2}\d{2}' title="06XXXXXXXX" class="champ" name="per_tel" size="10" required>
				<br>
				Fonction : <select> </select>
				
				<br>
				
				<input type=submit value="Valider">
			<?php }
		} ?>




		<?php /*$db = new Mypdo();
		$manager = new PersonneManager($db);
		$personne = new Personne ($_POST);
		if($manager->exists($personne)===true){ ?>
			<p><img src="image/erreur.png" alt="Erreur" title="Erreur" />Ajout impossible : Login/Email déja utilisé</p> <?php
		} else {
			$manager->addPersonne($personne); ?>
			<p><img src="image/valid.png" alt="Validé" title="Validé" /> 
		    <?php echo $_POST['per_prenom']?> <?php echo $_POST['per_nom']?> a été ajouté(e)</p>
		
		<?php }*/ ?>
		