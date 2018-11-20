
	<h1>Supprimer des personnes enregistrées</h1>

<?php
	$db = new Mypdo();
	$manager = new PersonneManager($db);

	$personnes = $manager->getAllPersonne();

	if(empty($_GET['id'])){ ?>
		
	<div class="listePersonnes">
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
						<?php echo $personne->getPNum() ?>
					</td>
					<td>
						<?php echo $personne->getPNom() ?>
					</td>	
					<td>
						<?php echo $personne->getPPrenom() ?>
					</td>
					<td>
						<a href="index.php?page=4&amp;id=<?php echo $personne->getPNum();?>"><img src="image/erreur.png" alt="Erreur" title="Erreur" /></a>
					</td>
					</tr><?php
				} ?>
			</table>
		</div>
<?php }
else{
	$num_p = $_GET['id'];
	$personne=$manager->nomPrenomParPerNum($num_p);
	$manager->supprimerPersonne($num_p);
	?>
	<p><?php echo $personne->getPPrenom() ?> <?php echo $personne->getPNom()." a bien été supprimé !"?><img src="image/valid.png" alt="Valide" title="Valide">
<?php } ?>	