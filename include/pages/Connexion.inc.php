<h1>Pour vous connecter</h1>

<?php
$db = new Mypdo();
$manager = new ConnexionManager($db);
if(empty($_POST['per_pwd'])) { ?>

	<form action="index.php?page=11" method="post">
		
		<p><label>Nom d'utilisateur : </label></p><input type="text" class="champ" name="per_login" size="4" required>
		
		<p><label>Mot de passe : </label></p><input type="password" class="champ" name="per_pwd" size="4" required>
		
		<?php 
		$_SESSION['src1'] = rand(1, 9);
		$_SESSION['src2'] = rand(1, 9);
		?>

		<div id="captcha">
			<img id="nb" src=<?php echo "image/nb/".$_SESSION['src1'].".jpg" ?> alt=Captcha title="Captcha"  /> <b id ="operation">+</b> 
			<img id="nb" src=<?php echo "image/nb/".$_SESSION['src2'].".jpg" ?> alt=Captcha title="Captcha"  />  <b id="operation">=</b>
		</div>
			
			<input type="text" class="champ" name="reponse" size="4" required>
			<input id="connexion" type=submit value="Valider">
		</form>
		
		<?php 
	} else { 
		$personne = new Connexion (array('per_login' => $_POST['per_login'],
			'per_pwd' => $_POST['per_pwd'] ,
			'captcha' => $_SESSION['src1']+$_SESSION['src2'],
			'reponse' => $_POST['reponse']));
		$log=$manager->login($personne);
		if($log === 1) {
			$_SESSION['login'] = $personne->getPerLogin();
			unset($_SESSION['src1']);
			unset($_SESSION['src2']);
			header('Location: index.php?page=0');
		} else {
			if($log === 0) { ?>	

				<p> <img src="image/erreur.png" alt="Erreur" title="Erreur" /> Login / Mot de passe invalide(s)</p>
			
			<?php } else { ?>
				
				<p> <img src="image/erreur.png" alt="Erreur" title="Erreur" /> CAPTCHA invalide</p>
			
			<?php } ?>
			
			<form action="index.php?page=11" method="post">
				
				<label>Nom d'utilisateur : </label><input type="text" class="champ" name="per_login" size="4" required>
				
				<p><label>Mot de passe : </label><input type="password" class="champ" name="per_pwd" size="4" required></p><br>
				
				<?php 
				$_SESSION['src1'] = rand(1, 9);
				$_SESSION['src2'] = rand(1, 9);
				?>

				<div id="captcha">
					<img id="nb" src=<?php echo "image/nb/".$_SESSION['src1'].".jpg" ?> alt=Captcha title="Captcha"  /> <b id ="operation">+</b> 
					<img id="nb" src=<?php echo "image/nb/".$_SESSION['src2'].".jpg" ?> alt=Captcha title="Captcha"  />  <b id="operation">=</b>
				</div>

					<input type="text" class="champ" name="reponse" size="4" required>
					<input id="connexion" type=submit value="Valider">
					
				</form>
			<?php }
		} ?>
		
		