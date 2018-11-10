<h1>Liste des parcours</h1>
<?php
$db = new Mypdo();
$manager = new ParcoursManager($db);
$managerVille = new VilleManager($db);
$ListeParcours = $manager->getAllParcours();?>
<div>
	<p>Il y a actuellement <?php echo $manager->getNbParcours()?> parcours</p>
	<table id="listeparcours">
		<tr>
			<th> Numéro </th>
			<th> Nom Ville </th>
			<th> Nom Ville </th>
			<th> Nombre de Km </th>
		</tr>
		<?php 
		foreach ($ListeParcours as $attribut => $value) {  ?>
			<tr>
				<td>
					<?php echo $value->getParNum() ?>
				</td>
				<td>
					<?php echo $managerVille->recupNomVille($value->getVilNum1()) ?>
				</td>
				<td>
					<?php echo $managerVille->recupNomVille($value->getVilNum2()) ?>
				</td>
				<td>
					<?php echo $value->getParKm() ?>
				</td>	
				</tr><?php echo "\n";
			} ?>
		</table>
	</div>