<?php 
$db = new Mypdo();
$manager = new PersonneManager($db);

if (!isset($_SESSION['personne'])){
	if(empty($_POST['per_login'])) { ?>

		<h1>Ajouter une personne</h1>

		<form action="index.php?page=1" id="personne" method="post">
			<div class="pers">
				<div  class=pg>
					<p><b>Nom : </b><input type="text" class="champ" name="per_nom" size="10" required></p><br>
					<p><b>Téléphone : </b><input type="tel" pattern='\d{2}\d{2}\d{2}\d{2}\d{2}' title="06XXXXXXXX" class="champ" name="per_tel" size="10" required></p><br>
					<p><b>Login : </b><input type="text" class="champ" name="per_login" size="10" required></p><br>
				</div>
				<div class=pdr>
					<p><b>Prénom : </b><input type="text" class="champ" name="per_prenom" size="10" required></p><br>
					<p><b>Mail : </b><input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="champ" name="per_mail" size="10" required></p><br>
					<p><b>Mot de passe : </b><input type="password" class="champ" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Doit contenir au moins 1 chiffre, 1 lettre majuscule et 1 lettre minuscule et doit au moins faire 8 caractères" name="per_pwd" size="10" required></p><br>
				</div>
			</div>
			<div class="cat">
				<b><p>Catégorie : 
				<input type="radio" name="p_categ" value="etu" checked>Etudiant
				<input type="radio" name="p_categ" value="pers">Personnel
				</p></b>

				<p><input class="valider" type=submit value="Valider"></p>
			</div>
		</form>

	<?php }
	else { 
		$_SESSION['personne'] = new Personne($_POST); 

		if($_POST['p_categ']==='etu'){ ?>

			<h1>Ajouter un étudiant</h1>
			<form action="index.php?page=1" id="etudiant" method="post">

				<p>Année : 
					<select class="champ" size="1" name="div_num" required> 
						<option value=0>Choisissez</option>
						<?php $DiviManager = new DivisionManager($db);
						$listeDivisions = $DiviManager->getAllDivisions();
						foreach ($listeDivisions as $attribut => $division) { ?>
						<option value=<?php echo $division->getDivNum()?> > 
							<?php echo $division->getDivNom() ?> </option>
						<?php }  ?> 
					</select>
				</p>
				<br>
				<p>Département : 
					<select class="champ" size="1" name="dep_num" required>
						<option value=0>Choisissez</option>
						<?php $DepManager = new DepartementManager($db);
						$listeDepartements = $DepManager->getAllDepartements();
						foreach ($listeDepartements as $attribut => $dep) { ?>
						<option value=<?php echo $dep->getDepNum()?> > 
						<?php echo $dep->getDepNom()." - ".$DepManager->recupNomVille($dep->getVilNum()) ?> </option>
						<?php }  ?>

					</select>
				</p>
				<br>

				<input type=submit value="Valider">

			</form>

			<?php

		}
		elseif($_POST['p_categ']==='pers'){ ?>

			<h1>Ajouter un salarié</h1>
			<form action="index.php?page=1" id="salarie" method="post">

				<p>Télephone professionnel : <input type="tel" pattern='\d{2}\d{2}\d{2}\d{2}\d{2}' title="06XXXXXXXX" class="champ" name="sal_telprof" size="10" required></p>
				<br>
				<p>Fonction : 
					<select class="champ" size="1" name="fon_num" required> 
						<?php $FonManager = new FonctionManager($db);
						$listeFonctions = $FonManager->getAllFonctions();
						foreach ($listeFonctions as $attribut => $fonction) { ?>
						<option value=<?php echo $fonction->getFonNum()?> > 
						<?php echo $fonction->getFonLib() ?> </option>
						<?php }  ?>
					</select>
				</p>

				<br>

				<input type=submit value="Valider">
			</form>
			
			<?php //$sal= new Salarie($_POST);
		}
	}
}
else{
	if($manager->exists($_SESSION['personne'])===true) { ?>
		<p><img src="image/erreur.png" alt="Erreur" title="Erreur" /> Ajout impossible : personne déja présente</p> <?php
	} 
	else {
		if (!empty($_POST['div_num'])){

			$manager->addPersonne($_SESSION['personne']);
			$etuManager = new EtudiantManager($db);
			$etuManager->addEtudiant(new Etudiant($_POST));
			?>

			<p> <img src="image/valid.png" alt="Validé" title="Validé" /> Cet étudiant a été ajouté</p>

			<?php
		}
		elseif (!empty($_POST['sal_telprof'])){

			$manager->addPersonne($_SESSION['personne']);
			$salManager = new SalarieManager($db);
			$salManager->addSalarie(new Salarie($_POST));
			?>
		

			<p><img src="image/valid.png" alt="Validé" title="Validé" /> Ce salarié a été ajouté</p>

			<?php
		}
	}

	unset($_SESSION['personne']);
}?>
