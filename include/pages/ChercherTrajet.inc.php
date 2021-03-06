<?php if(!isset($_SESSION['login'])) {
	header('Location: index.php?page=0');
}
$db = new Mypdo();
$manager = new ProposeManager($db);
$avisManager = new AvisManager($db);
$villeManager = new VilleManager($db);
?>

<h1>Rechercher un trajet</h1>

<?php if(empty($_POST['vil_num1']) && empty($_POST['pro_date'])) { ?>

	<form action="index.php?page=10" id="vil_nom" method="post">
		<p><label>Ville de départ : </label></p>
		<p><select class="champ" size="1" name="vil_num1" required>
			<option value="" > Choisissez </option>
			
			<?php $listeTrajets = $manager->getVilleDepart(); 
			foreach ($listeTrajets as $attribut => $value) { ?>
				<option value= <?php echo $value->getVilNum() ?> > <?php echo $villeManager->recupNomVille($value->getVilNum()) ?> </option>
			<?php } ?>

		</select></p>
		<p><input class="valider" type=submit value="Valider"></p>
	</form>

<?php } elseif(!empty($_POST['vil_num1']) && empty($_POST['pro_date'])) { 
	
	$_SESSION['vil_num1']=$_POST['vil_num1'];?>

	<form action="index.php?page=10" id="vil_nom" method="post">
		<div class="pers">
			<div class="pg">
				
				<p><b> Ville de départ : <?php echo $villeManager->recupNomVille($_POST['vil_num1']) ?></b></p>
				
				<p><b>Date de départ : </b><input class="champ" type="date" name="pro_date" required> </p>
				
				<p><b>A partir de : </b>
					<select class="champ" size="1" name="heure" >
						<?php  for ($i = 0; $i <= 23 ; $i++) { ?>
							<option value= <?php echo $i ?> > <?php echo $i."h" ?> </option>
						<?php } ?>
					</select>
				</p>
			</div>
			<div class="pdr">	
				<p><b> Ville d'arrivée : 
					<select class="champ" size="1" name="vil_num2" required>
						<option value=""> Choisissez </option>
						
						<?php $listeTrajets2 = $manager->getVilleArrivee($_POST['vil_num1']); 
						foreach ($listeTrajets2 as $attribut => $value) { ?>
							<option value= <?php echo $value->getVilNum() ?> > <?php echo $villeManager->recupNomVille($value->getVilNum()) ?> </option>

						<?php } ?>
					</select>
				</b></p>
				
				<p><b>Précision : </b>
					<select class="champ" size="1" name="precision" >
						<option value=0>Ce jour</option>

						<?php  for ($i = 1; $i <= PRECISION ; $i++) { ?>
							<option value= <?php echo $i ?> > 
								<?php if($i === 1) {echo "+/- ".$i." jour";
									} else {
										echo "+/- ".$i." jours";
									} ?> 
							</option>
						<?php } ?>
					</select>
				</p>			
			</div>
	</div>
	
	<p><input class="valider" type=submit value="Valider"></p>
</form>

<?php } else { 
	$recherche = $manager->findTrajet($_SESSION['vil_num1'],$_POST['vil_num2'],$_POST['pro_date'],$_POST['heure'],$_POST['precision']);
	if($recherche===0){ ?> 

		<p><b> <img src="image/erreur.png" alt="Erreur" title="Erreur" /> Désolé, pas de trajet disponible !</b></p> <?php

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
				<tr>
					<td>
						<?php echo $villeManager->recupNomVille($_SESSION['vil_num1']) ?>
					</td>
					<td>
						<?php echo $villeManager->recupNomVille($_POST['vil_num2']) ?>
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
						<div class="tooltip">
							<a><?php echo $recherche[$attribut]['per_prenom']." ".$recherche[$attribut]['per_nom'] ?></a>
							
							<span class="tooltiptext">Moyenne des avis : <?php echo $avisManager->getMoyenneAvis($recherche[$attribut]['per_num']) ?> <br> Dernier avis : <?php echo $avisManager->getDernierAvis($recherche[$attribut]['per_num']) ?></span>

						</div>
					</td>	
					</tr><?php echo "\n";
				} ?>
			</table>

		<?php }
	} ?>