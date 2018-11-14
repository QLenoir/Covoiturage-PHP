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
	$etuManager = new EtudiantManager($db);

	if ($etuManager->exists($num_p)){
		echo "hello";
	}
} ?>