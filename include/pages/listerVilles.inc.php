<h1> Liste des villes </h1>
<?php
	require '/include/autoLoad.inc.php';
	require '/include/config.inc.php'; 
	$db = new Mypdo();
	$manager = new VilleManager($db);
	$villes = $manager->getAllVille();?>
	<div id="listeville">
	<p>Il y a actuellement <?php echo $manager->getNbVille()?> villes</p>
	<table>
		<tr>
			<th> Numéro </th>
			<th> Nom </th>
		</tr>
	<?php 
		foreach ($villes as $attribut => $value) {  ?>
			<td>
				<?php echo $value->getVilNum() ?>
			</td>
			<td>
				<?php echo $value->getVilNom() ?>
			</td>	
			</tr><?php echo "\n";
		} ?>
	</table>
	</div>

