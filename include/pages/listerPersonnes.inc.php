<?php
	$db = new Mypdo();
	$manager = new PersonneManager($db);

	$personnes = $manager->getAllPersonne();

	if(empty($_GET['id'])){ ?>
		
	<h1>Liste des personnes</h1>
	<?php
		
	?>
	<div id="listePersonnes">
		<p>Il y a actuellement <?php echo $manager->getNbPersonne()?> personnes enregistrées</p>
		<table>
			<tr>
				<th> Numéro </th>
				<th> Nom </th>
				<th> Prénom </th>
			</tr>

			<?php 
			foreach ($personnes as $personne) {  ?>
				<tr>
					<td>
						<a href="index.php?page=2&amp;id=<?php echo $personne->getPNum();?>"><?php echo $personne->getPNum() ?></a>
					</td>
					<td>
						<?php echo $personne->getPNom() ?>
					</td>	
					<td>
						<?php echo $personne->getPPrenom() ?>
					</td>
					</tr><?php
				} ?>
			</table>
		</div>
<?php }
else{
	$num_p = $_GET['id'];
	$personne = $manager->getPersonne($num_p);
	$nom= $manager->nomPrenomParPerNum($num_p);

	if ($manager->isEtu($num_p)){ 
		$etuManager = new EtudiantManager($db);
    	$etu = $etuManager->getEtudiant($personne,$num_p);

		?>
		<h1>Détail de l'étudiant <?php echo $nom->getPNom(); ?></h1>
	
		<div id="listeEtu">
			<table>
				<tr>
					<th> Prénom </th>
					<th> Mail </th>
					<th> Tel </th>
					<th> Département </th>
					<th> Ville </th>
				</tr>

			
				<tr>
					<td>
						<?php echo $nom->getPPrenom(); ?>
					</td>
					<td>
						<?php echo $personne->getPMail(); ?>
					</td>	
					<td>
						<?php echo $personne->getPTel(); ?>
					</td>
					<td>
						<?php echo $etu->getDepNum(); ?>
					</td>
					<td>
						<?php   ?>
					</td>
				</tr>
			</table>
		</div>
	<?php }
	elseif ($manager->isSal($num_p)){ 
		$SalManager = new SalarieManager($db);
    	//$sal = $salManager->getEtudiant($personne, $num_p);

		?><h1>Détail du salarié <?php // $personne->getPNum(); ?></h1>
		<?php
		
		?>
		<div id="listeSal">
			<table>
				<tr>
					<th> Prénom </th>
					<th> Mail </th>
					<th> Tel </th>
					<th> Tel pro </th>
					<th> Fonction </th>
				</tr>

				<tr>
					<td>
						<?php //echo $personne->getPNum() ?>
					</td>
					<td>
						<?php //echo $personne->getPNom() ?>
					</td>	
					<td>
						<?php //echo $personne->getPPrenom() ?>
					</td>
					<td>
						<?php //echo $personne->getPPrenom() ?>
					</td>
					<td>
						<?php //echo $personne->getPPrenom() ?>
					</td>
				</tr>
			</table>
		</div>
	<?php }
} ?>