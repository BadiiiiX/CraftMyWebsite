<?php
/*
	Ce fichier PHP effectue telle ou telle action selon le contenu des gets envoyés par la theme(selon le lien sur lequel l'utilisateur à cliqué etc...).
*/
	if(isset($_GET['action']) AND isset($_Joueur_['rang']) AND ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['access'] == true))
	{
	switch ($_GET['action']) // on utilise ici un switch pour inclure telle ou telle page selon l'action.
	{ 				
		case 'commande': 
		require_once('admin/actions/commande.php');
		break;

		case 'addPrefix':
			require_once('admin/actions/addPrefix.php');
			$_SESSION['referrerAdmin'] = 'forum';
		break;

		case 'supprPrefix':
			require_once('admin/actions/supprPrefix.php');
			$_SESSION['referrerAdmin'] = 'forum';
		break;

		case 'configTheme':
			require_once('theme/'.$_Serveur_['General']['theme'].'/config/configAdminTraitement.php');
			$_SESSION['referrerAdmin'] = 'theme';
		break;

		case 'addSmiley':
			require_once('admin/actions/addSmiley.php');
			$_SESSION['referrerAdmin'] = 'forum';
		break;

		case 'supprSmiley':
			require_once('admin/actions/supprSmiley.php');
			$_SESSION['referrerAdmin'] = 'forum';
		break;

		case 'creerCoupon':
			require_once('admin/actions/creerCoupon.php');
			$_SESSION['referrerAdmin'] = 'boutique';
		break;

		case 'creerPostit':
			require_once('admin/actions/creerPostit.php');
			$_SESSION['referrerAdmin'] = 'accueil';
		break;

		case 'supprPostit':
			require_once('admin/actions/supprPostit.php');
			$_SESSION['referrerAdmin'] = 'accueil';
		break;

		case 'supprCoupon':
			require_once('admin/actions/supprCoupon.php');
			$_SESSION['referrerAdmin'] = 'boutique';
		break;

		case 'ajout_favicon':
			require_once('admin/actions/ajout_favicon.php');
			$_SESSION['referrerAdmin'] = 'general';
		break;
		
		case 'general': 
		require_once('admin/actions/general.php');
		$_SESSION['referrerAdmin'] = 'general';
		break;
		
		case 'editTheme': 
		require_once('admin/actions/editTheme.php');
		$_SESSION['referrerAdmin'] = 'theme';
		break;
		
		case 'supprMembre': 
		require_once('admin/actions/supprMembre.php');
		$_SESSION['referrerAdmin'] = 'membres';
		break;
		
		case 'modifierMembres': 
		require_once('admin/actions/modifierMembres.php');
		$_SESSION['referrerAdmin'] = 'membres';
		break;
		
		case 'creerPage': 
		require_once('admin/actions/creerPage.php');
		$_SESSION['referrerAdmin'] = 'custompages';
		break;
		
		case 'supprPage': 
		require_once('admin/actions/supprPage.php');
		$_SESSION['referrerAdmin'] = 'custompages';
		break;
		
		case 'boutique': 
		require_once('admin/actions/boutique.php');
		$_SESSION['referrerAdmin'] = 'boutique';
		break;
		
		case 'supprCategorie': 
		require_once('admin/actions/supprCategorie.php');
		$_SESSION['referrerAdmin'] = 'boutique';
		break;
		
		case 'supprAction': 
		require_once('admin/actions/supprAction.php');
		$_SESSION['referrerAdmin'] = 'boutique';
		break;
		
		case 'editerAction': 
		require_once('admin/actions/editerAction.php');
		$_SESSION['referrerAdmin'] = 'boutique';
		break;
		
		case 'serveurJsonNew': 
		require_once('admin/actions/serveurJsonNew.php');
		$_SESSION['referrerAdmin'] = 'reglagejsonapi';
		break;
		
		case 'serveurConfig': 
		require_once('admin/actions/serveurConfig.php');
		$_SESSION['referrerAdmin'] = 'reglagejsonapi';
		break;
		
		case 'supprJson': 
		require_once('admin/actions/serveurJsonSuppr.php');
		$_SESSION['referrerAdmin'] = 'regserv';
		break;
		
		case 'newLienMenu': 
		require_once('admin/actions/newLienMenu.php');
		$_SESSION['referrerAdmin'] = 'menus';
		break;
		
		case 'editPayement': 
		require_once('admin/actions/editPayement.php');
		$_SESSION['referrerAdmin'] = 'payement';
		break;
		
		case 'creerOffrePaypal': 
		require_once('admin/actions/creerOffrePaypal.php');
		$_SESSION['referrerAdmin'] = 'paiement';
		break;
		
		case 'modifierOffrePaypal': 
		require_once('admin/actions/modifierOffrePaypal.php');
		$_SESSION['referrerAdmin'] = 'paiement';
		break;
		
		case 'supprimerPaypalOffre': 
		require_once('admin/actions/supprimerPaypalOffre.php');
		$_SESSION['referrerAdmin'] = 'paiement';
		break;
		
		case 'supprLienMenu': 
		require_once('admin/actions/supprLienMenu.php');
		$_SESSION['referrerAdmin'] = 'menus';
		break;
		
		case 'supprLienMenuDeroulant': 
		require_once('admin/actions/supprLienMenuDeroulant.php');
		$_SESSION['referrerAdmin'] = 'menus';
		break;
		
		case 'newListeMenu': 
		require_once('admin/actions/newListeMenu.php');
		$_SESSION['referrerAdmin'] = 'menus';
		break;
		
		case 'modifierLien': 
		require_once('admin/actions/modifierLien.php');
		$_SESSION['referrerAdmin'] = 'menus';
		break;
		
		case 'editMenuListe': 
		require_once('admin/actions/editMenuListe.php');
		$_SESSION['referrerAdmin'] = 'menus';
		break;
		
		case 'nouveauMenuListeLien': 
		require_once('admin/actions/nouveauMenuListeLien.php');
		$_SESSION['referrerAdmin'] = 'menus';
		break;
		
		case 'deplacerMenu': 
		require_once('admin/actions/deplacerMenu.php');
		$_SESSION['referrerAdmin'] = 'menus';
		break;
		
		case 'postNavRap': 
		require_once('admin/actions/postNavRap.php');
		$_SESSION['referrerAdmin'] = 'accueil';
		break;

		case 'postNews': 
		require_once('admin/actions/postNews.php');
		$_SESSION['referrerAdmin'] = 'news';
		break;
		
		case 'supprNews': 
		require_once('admin/actions/supprNews.php');
		$_SESSION['referrerAdmin'] = 'news';
		break;
		
		case 'creerCategorie': 
		require_once('admin/actions/creerCategorie.php');
		$_SESSION['referrerAdmin'] = 'boutique';
		break;
		
		case 'creerOffre': 
		require_once('admin/actions/creerOffre.php');
		$_SESSION['referrerAdmin'] = 'boutique';
		break;
		
		case 'creerAction': 
		require_once('admin/actions/creerAction.php');
		$_SESSION['referrerAdmin'] = 'boutique';
		break;
		
		case 'editRapNav': 
		require_once('admin/actions/editRapNav.php');
		$_SESSION['referrerAdmin'] = 'accueil';
		break;
		
		case 'newSlider':
		require_once('admin/actions/newSlider.php');
		$_SESSION['referrerAdmin'] = 'accueil';
		break;
		
		case 'changeSlider':
		require_once('admin/actions/changeSlider.php');
		$_SESSION['referrerAdmin'] = 'accueil';
		break;
		
		case 'postSlider':
		require_once('admin/actions/postSlider.php');
		$_SESSION['referrerAdmin'] = 'accueil';
		break; 
		
		case 'supprSlider':
		require_once('admin/actions/supprSlider.php');
		$_SESSION['referrerAdmin'] = 'accueil';
		break; 
		
		case 'postBG':
		require_once('admin/actions/postBG.php');
		$_SESSION['referrerAdmin'] = 'theme';
		break; 

		case 'typeBG':
		require_once('admin/actions/postBG.php');
		$_SESSION['referrerAdmin'] = 'theme';
		break; 
		
		case 'modifierVotesGen':
		require_once('admin/actions/modifierVotesGen.php');
		$_SESSION['referrerAdmin'] = 'voter';
		break;
		
		case 'creerLienVote':
		require_once('admin/actions/creerLienVote.php');
		$_SESSION['referrerAdmin'] = 'voter';
		break;
		
		case 'supprLienVote':
		require_once('admin/actions/supprLienVote.php');
		$_SESSION['referrerAdmin'] = 'voter';
		break;
		
		case 'editPage':
		require_once('admin/actions/editPage.php');
		$_SESSION['referrerAdmin'] = 'custompages';
		break;
		
		case 'creerSection':
		require_once('admin/actions/creerSection.php');
		$_SESSION['referrerAdmin'] = 'custompages';
		break;
		
		case 'supprSection':
		require_once('admin/actions/supprSection.php');
		$_SESSION['referrerAdmin'] = 'custompages';
		break;
		
		case 'editPermissions':
		require_once('admin/actions/editPermissions.php');
		$_SESSION['referrerAdmin'] = 'grade';
		break;
		
		case 'supprTicket':
		require_once('admin/actions/supprTicket.php');
		$_SESSION['referrerAdmin'] = 'support';
		break;
		
		case 'newWidget':
		require_once('admin/actions/newWidget.php');
		$_SESSION['referrerAdmin'] = 'widgets';
		break;
		
		case 'supprWidget':
		require_once('admin/actions/supprWidget.php');
		$_SESSION['referrerAdmin'] = 'widgets';
		break;
		
		case 'upWidget':
		require_once('admin/actions/upWidget.php');
		$_SESSION['referrerAdmin'] = 'widgets';
		break;
		
		case 'downWidget':
		require_once('admin/actions/downWidget.php');
		$_SESSION['referrerAdmin'] = 'widgets';
		break;
		
		case 'editNews':
		require_once('admin/actions/editNews.php');
		$_SESSION['referrerAdmin'] = 'news';
		break;

		case 'resetVotes':
		if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['actions']['resetVote'] == true)
			$bddConnection->exec('DELETE FROM cmw_votes');
		$_SESSION['referrerAdmin'] = 'voter';
		break;
		
		case 'etatTickets':
		require_once('admin/actions/etatTickets.php');
		$_SESSION['referrerAdmin'] = 'support';
		break;

		case 'switchMaintenance':
		require_once('admin/actions/switchMaintenance.php');
		$_SESSION['referrerAdmin'] = 'maintenance';
		break;
		
		case 'switchPreference':
		require_once('admin/actions/switchPreference.php');
		$_SESSION['referrerAdmin'] = 'maintenance';
		break;

		case 'editMessage':
		require_once('admin/actions/editMessage.php');
		$_SESSION['referrerAdmin'] = 'maintenance';
		break;

		case 'editMessageAdmin':
		require_once('admin/actions/editMessageAdmin.php');
		$_SESSION['referrerAdmin'] = 'maintenance';
		break;

		case 'commandeConsole': 
		require_once('admin/actions/commandeConsole.php');
		$_SESSION['referrerAdmin'] = 'accueil';
		break;

		case 'commandeRechargementPlugins': 
		require_once('admin/actions/commandeRechargementPlugins.php');
		$_SESSION['referrerAdmin'] = 'accueil';
		break;

		case 'commandeRedemarrageServer': 
		require_once('admin/actions/commandeRedemarrageServer.php');
		$_SESSION['referrerAdmin'] = 'accueil';
		break;

		case 'switchSysMail': 
		require_once('admin/actions/switchSysMail.php');
		$_SESSION['referrerAdmin'] = 'accueil';
		break;

		case 'editSysMail': 
		require_once('admin/actions/editSysMail.php');
		$_SESSION['referrerAdmin'] = 'accueil';
		break;

		case 'editNbrPerIP': 
		require_once('admin/actions/editNbrPerIP.php');
		$_SESSION['referrerAdmin'] = 'accueil';
		break;

		case 'supprGrade': 
		require_once('admin/actions/supprGrade.php');
		$_SESSION['referrerAdmin'] = 'grade';
		break;

		case 'addGrade': 
		require_once('admin/actions/addGrade.php');
		$_SESSION['referrerAdmin'] = 'grade';
		break;

		case 'editGrade': 
		require_once('admin/actions/editGrade.php');
		$_SESSION['referrerAdmin'] = 'grade';
		break;
		
		// Si le joueur a rentré un url contenant une valeur d'action innexistant?
		default:
		header('Location: admin.php');
	}
}
header('Location: admin.php?page='.$_SESSION['referrerAdmin']);
?>
