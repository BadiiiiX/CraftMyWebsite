<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['maintenance']['actions']['editEtatMaintenance'] == true) {
	$req_Etat = $bddConnection->query('SELECT maintenanceEtat FROM cmw_maintenance WHERE maintenanceId = 1');
	$get_Etat = $req_Etat->fetch(PDO::FETCH_ASSOC);
	$result_Etat = $get_Etat['maintenanceEtat'];
	if($result_Etat == "1") {
		$req = $bddConnection->prepare('UPDATE cmw_maintenance SET maintenanceEtat = :maintenanceEtat WHERE maintenanceId = :maintenanceId');
		$req->execute(array (
			'maintenanceEtat' => $_POST['maintenanceEtat'],
			'maintenanceId' => $_GET['maintenanceId'],
			));
	} else {
		$req = $bddConnection->prepare('UPDATE cmw_maintenance SET maintenanceEtat = :maintenanceEtat, maintenanceTime = UNIX_TIMESTAMP() WHERE maintenanceId = :maintenanceId');
		$req->execute(array (
			'maintenanceEtat' => $_POST['maintenanceEtat'],
			'maintenanceId' => $_GET['maintenanceId'],
			));
	}
}
?>