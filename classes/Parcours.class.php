<?php
class Parcours{
	private $par_num;
	private $par_km;
	private $vil_num1;
	private $vil_num2;

	public function __construct($valeurs) {
		if (!empty($valeurs)) {
			$this -> affecte($valeurs);
		}
	}

	public function affecte($donnees) {
		foreach ($donnees as $attribut => $valeur) {
			
			switch($attribut) {
				case 'par_num' : $this->setParNum($valeur);
					break;
				case 'par_km' : $this->setParKm($valeur);
					break;
				case 'vil_num1' : $this->setVilNum1($valeur);
					break;
				case 'vil_num2' : $this->setVilNum2($valeur);
					break;
			}
		}
	}

	public function setParNum($num) {
		$this->par_num = $num;
	}

	public function setParKm($km) {
		$this->par_km = $km;
	}

	public function setVilNum1($num) {
		$this->vil_num1 = $num;
	}

	public function setVilNum2($num) {
		$this->vil_num2 = $num;
	}

	public function getParNum() {
		return $this->par_num;
	}

	public function getParKm() {
		return $this->par_km;
	}

	public function getVilNum1() {
		return $this->vil_num1;
	}

	public function getVilNum2() {
		return $this->vil_num2;
	}

}