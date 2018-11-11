<?php
class DivisionManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function getAllDivisions() {
		$req = $this->db->prepare('SELECT div_num,div_nom FROM division;');
		$req->execute();

		while ($division = $req->fetch(PDO::FETCH_OBJ)) {
			$listeDivisions[] = new Division($division);
		}

		return $listeDivisions;

		$req->closeCursor();
	}
}