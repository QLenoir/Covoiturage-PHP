<h1>Pour vous connecter</h1>
<?php if(empty($_POST['per_pwd'])) { ?>
	<form action="index.php?page=11" method="post">
		<p><label>Nom d'utilisateur : </label></p><input type="text" id="champ" name="per_login" size="4">
		<p><label>Mot de passe : </label></p><input type="password" id="champ" name="per_pwd" size="4">
		<input id="connexion" type=submit value="Valider">
	</form>
	<?php 
	} else { 
		$db = new Mypdo();
		$manager = new ConnexionManager($db);
		$personne = new Connexion (array('per_login' => $_POST['per_login'],
										'per_pwd' => $_POST['per_pwd'] ));

		if($manager->login($personne)) {
			$_SESSION['login'] = $personne->getPerLogin();
			header('Location: index.php?page=0');
		} else { ?>
			<p> <img src="image/erreur.png" alt="Erreur" title="Erreur" /> Login / Mot de passe invalide(s)</p>
			<form action="index.php?page=11" method="post">
			<label>Nom d'utilisateur : </label><input type="text" id="champ" name="per_login" size="4">
			<p><label>Mot de passe : </label><input type="password" id="champ" name="per_pwd" size="4"></p><br>
			<input id="connexion" type=submit value="Valider">
			</form>
		<?php }
	} ?>
		
		