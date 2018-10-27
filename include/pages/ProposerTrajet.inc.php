<?php if(!isset($_SESSION['login'])) {
	header('Location: index.php?page=0');
} ?>
<h1>Proposer un trajet</h1>
<?php 
$db = new Mypdo();
$manager = new ParcoursManager($db);
if(empty($_POST['vil_num1']) && empty($_POST['vil_num2'])) { ?>
	<form action="index.php?page=9" id="vil_nom" method="post">
		<p><label>Ville de départ : </label></p>
		<p><select class="champ" size="1" name="vil_num1" >
			<option value="0" > Choisissez </option>
			<?php $listeParcours = $manager->getAllVilleParcours(); 
			foreach ($listeParcours as $attribut => $value) { ?>
				<option value= <?php echo $value->getVilNum() ?> > <?php echo $value->getVilNom() ?> </option>
			<?php } ?>
		</select></p>
		<p><input class="valider" type=submit value="Valider"></p>
	</form>
<?php } elseif (empty($_POST['vil_num2'])) { 
	$_SESSION['vil_num1']=$_POST['vil_num1']; ?>
	<form action="index.php?page=9" id="trajet" method="post">
		<p><b> Ville de départ : <?php echo $manager->recupNomVille($_POST['vil_num1']) ?></b>
			<b> Ville d'arrivée : 
				<select class="champ" size="1" name="vil_num2" required>
					<?php $listeParcours2 = $manager->getVilleParcours($_POST['vil_num1']); 
					foreach ($listeParcours2 as $attribut => $value) { ?>
						<option value= <?php echo $value->getVilNum() ?> > <?php echo $value->getVilNom() ?> </option>
					<?php } ?>
				</select></b></p>
				<p><b>Date de départ : </b><input class="champ" type="date" name="pro_date" value=<?php echo date("Y-m-d") ?> required> 
					<b>Heure de départ : </b><input class="champ" type="time" name="pro_time" value=<?php echo date("H:i") ?> required></p>
					<p><b>Nombre de places : </b><input type="number" class="champ" name="pro_place" size="4" min="1" max="50" required></p>
					<p><input class="valider" type=submit value="Valider"></p>
				</form>	
			<?php } else { 
				$proposeManager = new ProposeManager($db);
				$trajet = new Propose(array('par_num' => $manager->findParNum($_SESSION['vil_num1'],$_POST['vil_num2']),
					'per_num' => $proposeManager->perNumLogin($_SESSION['login']),
					'pro_date' => $_POST['pro_date'],
					'pro_time' => $_POST['pro_time'],
					'pro_place' => $_POST['pro_place']));
				$trajet->setProSens($manager->findProSens($trajet->getParNum(),$_SESSION['vil_num1']));
				$proposeManager->addTrajet($trajet);
				?> 
				<p><img src="image/valid.png" alt="Validé" title="Validé" /> Le trajet à été ajouté </p>
				
				<?php unset($_SESSION['var_num1']); } ?>	