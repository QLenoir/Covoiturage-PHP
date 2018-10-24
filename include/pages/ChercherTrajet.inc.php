<?php if(!isset($_SESSION['login'])) {
	header('Location: index.php?page=0');
	}
	$db = new Mypdo();
	$manager = new ProposeManager($db);
 ?>
<h1>Rechercher un trajet</h1>
<?php if(empty($_POST['vil_num1']) && empty($_POST['pro_date'])) {?>
		<form action="index.php?page=10" id="vil_nom" method="post">
			<p><label>Ville de départ : </label></p>
			<p><select id="champ" size="1" name="vil_num1" >
			<option value="0" > Choisissez </option>
			<?php $listeTrajets = $manager->getVilleDepart(); 
				foreach ($listeTrajets as $attribut => $value) { ?>
						<option value= <?php echo $value->getVilNum() ?> > <?php echo $manager->recupNomVille($value->getVilNum()) ?> </option>
			<?php } ?>
			</select></p>
			<p><input id="valider" type=submit value="Valider"></p>
		</form>
<?php } elseif(!empty($_POST['vil_num1']) && empty($_POST['pro_date'])) { 
	$_SESSION['vil_num1']=$_POST['vil_num1'];?>

	<form action="index.php?page=10" id="vil_nom" method="post">
		<p><b> Ville de départ : <?php echo $manager->recupNomVille($_POST['vil_num1']) ?></b>
		<b> Ville d'arrivée : 
			<select id="champ" size="1" name="vil_num2" required>
				<?php $listeTrajets2 = $manager->getVilleArrivee($_POST['vil_num1']); 
					foreach ($listeTrajets2 as $attribut => $value) { ?>
					<option value= <?php echo $value->getVilNum() ?> > <?php echo $manager->recupNomVille($value->getVilNum()) ?> </option>
				<?php } ?>
			</select></b></p>
			<p><b>Date de départ : </b><input id="champ" type="date" name="pro_date" required> 
			<b>Précision : </b><select id="champ" size="1" name="precision" required>
				<option value=0>Ce jour</option>
				<?php  for ($i = 1; $i <= 3 ; $i++) { ?>
					<option value= <?php echo $i ?> > 
						<?php if($i === 1) {echo "+/- ".$i." jour";
								} else {
								echo "+/- ".$i." jours";
							} ?> 
					</option>
				<?php } ?>
			</select></p>
			<p><b>A partir de : </b>
			<select id="champ" size="1" name="heure" required>
				<?php  for ($i = 0; $i <= 23 ; $i++) { ?>
					<option value= <?php echo $i ?> > <?php echo $i."h" ?> </option>
				<?php } ?>
			</select></p>
			<p><input id="valider" type=submit value="Valider"></p>
	</form>
<?php } else { 
		$recherche = $manager->findTrajet($_SESSION['vil_num1'],$_POST['vil_num2'],$_POST['pro_date'],$_POST['heure'],$_POST['precision']);
		if($recherche===0){
			?> <p><b> <img src="image/erreur.png" alt="Erreur" title="Erreur" /> Désolé, pas de trajet disponible !</b></p> <?php
		} else { ?>
			<table id="recherche">
				<tr>
					<th> Ville départ </th>
					<th> Ville arrivée </th>
					<th> Date départ </th>
					<th> Heure départ </th>
					<th> Nombre de place(s) </th>
					<th> Nom du covoitureur </th>
				</tr>
	<?php 
		foreach ($recherche as $attribut => $value) { ?>
			<td>
				<?php echo $manager->recupNomVille($recherche[$attribut]['vil_num1']) ?>
			</td>
			<td>
				<?php echo $manager->recupNomVille($recherche[$attribut]['vil_num2']) ?>
			</td>
			<td>
				<?php echo $manager->getFormatDate($recherche[$attribut]['pro_date']) ?>
			</td>
			<td>
				<?php echo $recherche[$attribut]['pro_time'] ?>
			</td>		
			<td>
				<?php echo $recherche[$attribut]['pro_place'] ?>
			</td>
			<td>
				<a id="avis" href="#" title="bite"><?php echo $manager->getPrenomNomFromNum($recherche[$attribut]['per_num']) ?></a>
			</td>	
			</tr><?php echo "\n";
		} ?>
	</table>
	<?php } ?>
<?php } ?>