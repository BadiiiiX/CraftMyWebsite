<div class="cmw-page-content-header"><strong>Gestion</strong> - Gérez vos rangs</div>

<div class="row">
        <?php if($_Joueur_['rang'] != 1) { ?>
            <div class="col-md-12 text-center">
                <div class="alert alert-danger">
                    <strong>Vous n'êtes pas créateur.</strong>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-md-12 text-center">
                <div class="row">
                    <div class="alert alert-success">
                        <strong>Vous pouvez ajouter autant de grades que vous le souhaitez pour votre site. Grâce à une toute nouvelle fonctionnalité vous pouvez dorénavant modifier/ajouter des permissions à tous vos grades créés. Cependant, les grades par défaut (Créateur et Joueur) ne peuvent pas être modifiés par sécurité.<br>L'accès à cette fonctionnalité est réservée aux Créateurs.</strong>
                    </div>
                </div>
                <div class="row">
                    <div class="alert alert-warning">
                        <strong>ATTENTION<br>Certains hébergeurs bloquent la création automatique des grades.</strong>
                    </div>
                </div>
            </div>
        <?php }
        if($_Joueur_['rang'] == 1) {
            if(isset($_GET['gradeCreated']))
            {
                echo '<div class="alert alert-success text-center">Grade créé avec succès !</div>';
            }
            elseif(isset($_GET['nomGradeLong']))
                echo '<div class="alert alert-danger text-center"><strong>Erreur !</strong><br>Le nom du grade entré est trop long !</div>';
            elseif(isset($_GET['nomGradeCourt']))
                echo '<div class="alert alert-danger text-center"><strong>Erreur !</strong><br>Le nom du grade entré est trop court !</div>';
            elseif (isset($_GET['cdgi'])) {
                echo '<div class="alert alert-danger text-center"><strong>Erreur Critique!</strong><br>Erreur interne, contacter le support de CraftMyWebsite code d\'erreur : cdgi</div>';
            }
            elseif(isset($_GET['cdnti']))
                echo '<div class="alert alert-danger text-center"><strong>Erreur Critique!</strong><br>Erreur interne, contacter le support de CraftMyWebsite code d\'erreur : cdnti</div>';
            elseif(isset($_GET['gradeNameAlreadyUsed']))
                echo '<div class="alert alert-danger text-center"><strong>Erreur !</strong>Le nom du grade existe déjà !</div>';
            elseif(isset($_GET['gradeDefaultInexistantRegen']))
                echo '<div class="alert alert-danger text-center"><strong>Erreur Critique !</strong>Un fichier interne a été supprimé ! Réessayer l\'opération, en cas d\'échec contacter le support de CraftMyWebsite</div>';
            elseif(isset($_GET['conflitGrade']))
                echo '<div class="alert alert-danger text-center"><strong>Erreur Critique !</strong>Le ficheir existe déjà !</div>';
         ?>
        <div class="col-md-12">
            <div class="panel panel-default cmw-panel">
                <div class="panel-heading cmw-panel-header">
                    <h3 class="panel-title"><strong>Changer le nom du grade Créateur</strong></h3>
                </div>
            </div>
            <div class="panel-body">
                <form method="POST" action="?action=changeNom">
                    <div class="col-md-12">
                        <h3>Changer le nom</h3>
                        <div class="row">
                            <label class="control-label">Nom</label>
                            <input type="text" name="nom" class="form-control" style="text-align: center;" value="<?php echo $_Serveur_['General']['createur']; ?>" />
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center" style="margin-top: 5px;">
                                <input type="submit" class="btn btn-success" value="Changer le nom !">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default cmw-panel">
                <div class="panel-heading cmw-panel-header">
                    <h3 class="panel-title"><strong>Création d'un nouveau grade</strong></h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="?&action=addGrade">
                        <div class="col-md-12">
                            <h3>Créer un grade</h3>
                            <div class="row">
                                <label class="control-label">Nom du grade</label>
                                <input type="text" name="gradeName" class="form-control" style="text-align: center;" placeholder="Support"/>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center" style="margin-top: 5px;">
                                    <input type="submit" class="btn btn-success" value="Créer le grade !"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php } 
        if($_Joueur_['rang'] == 1 AND end($lastGrade) >= 2) { ?>
        <div class="col-md-12">
            <div class="panel panel-default cmw-panel">
                <div class="panel-heading cmw-panel-header">
                    <h3 class="panel-title"><strong>Édition des grades</strong></h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="?&action=editGrade">
                        <h3>Editer un/des grade(s)</h3>
                            <ul class="nav nav-tabs">
                                <?php for($i = 2; $i <= end($lastGrade); $i++) { 
                                    if(file_exists($dirGrades.$i.'.yml')) { ?>
                                        <li <?php if($i == 2) echo 'class="active"'; ?>><a href="#grade<?php echo $i; ?>" data-toggle="tab"><?php echo $idGrade[$i]['Grade']; ?></a></li>
                                <?php }
                                } ?>
                            </ul>
                            <div class="tab-content">
                                <?php for($i = 2; $i <= end($lastGrade); $i++) { 
                                    if(file_exists($dirGrades.$i.'.yml')) { ?>
                                    <div class="tab-pane well <?php if($i == 2) echo 'active"'; ?>" id="grade<?php echo $i; ?>">
                                        <div class="row">
                                            <input type="hidden" name="oldGradeName-<?php echo $i; ?>" value="<?php echo $idGrade[$i]['Grade']; ?>"/>
                                            <label class="control-label">Nom du grade</label>
                                            <input class="form-control" name="gradeName<?php echo $i; ?>" type="text" style="text-align: center;" value="<?php echo $idGrade[$i]['Grade']; ?>" placeholder="Modérateur"/>
                                            <label class="control-label">Couleur du Grade</label>
                                            <label class="checkbox-inline">
                                              <input class="form-check-input" type="radio" name="prefix<?php echo $i; ?>" id="prefixPrimary" value="prefixPrimary" <?=($idGrade[$i]['prefix'] == "prefixPrimary") ? 'checked' : ''; ?>>
                                                <span class="prefix prefixPrimary" style="height: 10px; width: 5px;"></span>
                                            </label>
                                            <label class="checkbox-inline">
                                              <input class="form-check-input" type="radio" name="prefix<?php echo $i; ?>" id="prefixSecondary" value="prefixSecondary" <?=($idGrade[$i]['prefix'] == "prefixSecondary") ? 'checked' : ''; ?>>
                                                <span class="prefix prefixSecondary" style="height: 10px; width: 5px;"></span>
                                            </label>
                                            <label class="checkbox-inline">
                                              <input class="form-check-input" type="radio" name="prefix<?php echo $i; ?>" id="prefixRed" value="prefixRed" <?=($idGrade[$i]['prefix'] == "prefixRed") ? 'checked' : ''; ?>>
                                                <span class="prefix prefixRed" style="height: 10px; width: 5px;"></span>
                                            </label>
                                            <label class="checkbox-inline">
                                              <input class="form-check-input" type="radio" name="prefix<?php echo $i; ?>" id="prefixGreen" value="prefixGreen" <?=($idGrade[$i]['prefix'] == "prefixGreen") ? 'checked' : ''; ?>>
                                                <span class="prefix prefixGreen" style="height: 10px; width: 5px;"></span>
                                            </label>
                                            <label class="checkbox-inline">
                                              <input class="form-check-input" type="radio" name="prefix<?php echo $i; ?>" id="prefixOlive" value="prefixOlive"<?=($idGrade[$i]['prefix'] == "prefixOlive") ? 'checked' : ''; ?> >
                                                <span class="prefix prefixOlive" style="height: 10px; width: 5px;"></span>
                                            </label>
                                            <label class="checkbox-inline">
                                              <input class="form-check-input" type="radio" name="prefix<?php echo $i; ?>" id="prefixLightGreen" value="prefixLightGreen" <?=($idGrade[$i]['prefix'] == "prefixLightGreen") ? 'checked' : ''; ?>>
                                                <span class="prefix prefixLightGreen" style="height: 10px; width: 5px;"></span>
                                            </label>
                                            <label class="checkbox-inline">
                                              <input class="form-check-input" type="radio" name="prefix<?php echo $i; ?>" id="prefixBlue" value="prefixBlue" <?=($idGrade[$i]['prefix'] == "prefixBlue") ? 'checked' : ''; ?>>
                                                <span class="prefix prefixBlue" style="height: 10px; width: 5px;"></span>
                                            </label>
                                            <label class="checkbox-inline">
                                              <input class="form-check-input" type="radio" name="prefix<?php echo $i; ?>" id="prefixRoyalBlue" value="prefixRoyalBlue" <?=($idGrade[$i]['prefix'] == "prefixRoyalBlue") ? 'checked' : ''; ?>>
                                                <span class="prefix prefixRoyalBlue" style="height: 10px; width: 5px;"></span>
                                            </label>
                                            <label class="checkbox-inline">
                                              <input class="form-check-input" type="radio" name="prefix<?php echo $i; ?>" id="prefixSkyBlue" value="prefixSkyBlue" <?=($idGrade[$i]['prefix'] == "prefixSkyBlue") ? 'checked' : ''; ?>>
                                                <span class="prefix prefixSkyBlue" style="height: 10px; width: 5px;"></span>
                                            </label>
                                            <label class="checkbox-inline">
                                              <input class="form-check-input" type="radio" name="prefix<?php echo $i; ?>" id="prefixGray" value="prefixGray" <?=($idGrade[$i]['prefix'] == "prefixGray") ? 'checked' : ''; ?>>
                                                <span class="prefix prefixGray" style="height: 10px; width: 5px;"></span>
                                            </label>
                                            <label class="checkbox-inline">
                                              <input class="form-check-input" type="radio" name="prefix<?php echo $i; ?>" id="prefixSilver" value="prefixSilver" <?=($idGrade[$i]['prefix'] == "prefixSilver") ? 'checked' : ''; ?>>
                                                <span class="prefix prefixSilver" style="height: 10px; width: 5px;"></span>
                                            </label>
                                            <label class="checkbox-inline">
                                              <input class="form-check-input" type="radio" name="prefix<?php echo $i; ?>" id="prefixYellow" value="prefixYellow" <?=($idGrade[$i]['prefix'] == "prefixYellow") ? 'checked' : ''; ?>>
                                                <span class="prefix prefixYellow" style="height: 10px; width: 5px;"></span>
                                            </label>
                                            <label class="checkbox-inline">
                                              <input class="form-check-input" type="radio" name="prefix<?php echo $i; ?>" id="prefixOrange" value="prefixOrange" <?=($idGrade[$i]['prefix'] == "prefixOrange") ? 'checked' : ''; ?>>
                                                <span class="prefix prefixOrange" style="height: 10px; width: 5px;"></span>
                                            </label><br/>
                                            <label class="control-label">Effets</label>
                                            <label class="checkbox-inline">
                                                <input class="form-check-input" type="radio" name="effet<?php echo $i; ?>" id="spark" value="style5" <?=($idGrade[$i]['effets'] == "style5") ? 'checked' : ''; ?>>
                                                    <span class="username"><span class="style5">Test</span></span>
                                            </label>
                                            <label class="checkbox-inline">
                                                <input class="form-check-input" type="radio" name="effet<?php echo $i; ?>" id="etoile" value="style16" <?=($idGrade[$i]['effets'] == "style16") ? 'checked' : ''; ?>>
                                                    <span class="username"><span class="style16">Test</span></span>
                                            </label>
                                        </div>
                                        <div class="row">
                                            <div class="panel-group" id="accordion<?php echo $i; ?>" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="headingOne<?php echo $i; ?>">
                                                        <h4 class="panel-title text-center">
                                                            <a role="button" data-toggle="collapse" data-parent="#accordion<?php echo $i; ?>" href="#collapseOne<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $i; ?>"><strong>Permissions générales</strong></a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne<?php echo $i; ?>">
                                                        <div class="panel-body">
                                                            <div class="col-lg-8 col-lg-offset-2 text-center">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-lg-offset-1 text-left">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsDefaultNewsDeleteMemberComm<?php echo $i; ?>" <?php if($idGrade[$i]['PermsDefault']['news']['deleteMemberComm'] == true) echo 'checked'; ?> /> Suppression des commentaires dans les nouveautés
                                                                            </label>
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsDefaultNewsEditMemberComm<?php echo $i; ?>" <?php if($idGrade[$i]['PermsDefault']['news']['editMemberComm'] == true) echo 'checked'; ?> /> Edition des commentaires dans les nouveautés
                                                                            </label>
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsDefaultSupportDeleteMemberComm<?php echo $i; ?>" <?php if($idGrade[$i]['PermsDefault']['support']['deleteMemberComm'] == true) echo 'checked'; ?> /> Suppression des commentaires dans le support
                                                                            </label>
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsDefaultSupportEditMemberComm<?php echo $i; ?>" <?php if($idGrade[$i]['PermsDefault']['support']['editMemberComm'] == true) echo 'checked'; ?> /> Edition des commentaires dans le support
                                                                            </label>
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsDefaultSupportCloseTicket<?php echo $i; ?>" <?php if($idGrade[$i]['PermsDefault']['support']['closeTicket'] == true) echo 'checked'; ?> /> Ouvrir/Fermer les tickets dans le support
                                                                            </label>
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsDefaultSupportDisplayTicket<?php echo $i; ?>" <?php if($idGrade[$i]['PermsDefault']['support']['displayTicket'] == true) echo 'checked'; ?> /> Voir les tickets
                                                                                privés dans le support
                                                                            </label>
                                                                       </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsDefaultChatColor<?php echo $i; ?>" <?php if($idGrade[$i]['PermsDefault']['chat']['color'] == true) echo 'checked'; ?> /> Écrire en couleur sur le chat 
                                                                            </label>
                                                                       </div>
                                                                       <div class="checkbox">
                                                                            <label>
                                                                                <input type="number" class="form-control" min="0" max="100" name="permsDefaultForumPerms<?php echo $i; ?>" value="<?=$idGrade[$i]['PermsDefault']['forum']['perms'];?>" /> Niveau de permissions (forum, categories, sous-forum et topics). Aura a accès à tous ce qui est inférieur ou égal a son niveau de permission. 
                                                                            </label>
                                                                       </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="headingTwo<?php echo $i; ?>">
                                                        <h4 class="panel-title text-center">
                                                            <a role="button" data-toggle="collapse" data-parent="#accordion<?php echo $i; ?>" href="#collapseTwo<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseTwo<?php echo $i; ?>"><strong>Accès Panel</strong></a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseTwo<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo<?php echo $i; ?>">
                                                        <div class="panel-body">
                                                            <div class="col-lg-12 text-center">
                                                                <div class="row">
                                                                    <div class="col-lg-6 col-lg-offset-4 text-left">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsPanelAccess<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['access'] == true) echo 'checked'; ?> /><strong> Accès au panel</strong>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="col-lg-6 text-left">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsPanelInfo<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['info']['showPage'] == true) echo 'checked'; ?> /> Accès à la page <strong>informations</strong>
                                                                            </label>
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsPanelGeneral<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['general']['showPage'] == true) echo 'checked'; ?> /> Accès à la page <strong>général</strong>
                                                                            </label>
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsPanelTheme<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['theme']['showPage'] == true) echo 'checked'; ?> /> Accès à la page <strong>thèmes</strong>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 text-left">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsPanelAccueil<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['home']['showPage'] == true) echo 'checked'; ?> /> Accès à la page <strong>accueil</strong>
                                                                            </label>
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsPanelServeur<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['server']['showPage'] == true) echo 'checked'; ?> /> Accès à la page <strong>réglages serveur</strong>
                                                                            </label>
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsPanelPages<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['pages']['showPage'] == true) echo 'checked'; ?> /> Accès à la page <strong>pages</strong>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 text-left">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsPanelNouveautes<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['news']['showPage'] == true) echo 'checked'; ?> /> Accès à la page <strong>nouveautés</strong>
                                                                            </label>
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsPanelBoutique<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['shop']['showPage'] == true) echo 'checked'; ?> /> Accès à la page <strong>boutique</strong>
                                                                            </label>
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsPanelPayement<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['payment']['showPage'] == true) echo 'checked'; ?> /> Accès à la page <strong>paiement</strong>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 text-left">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsPanelMenus<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['menus']['showPage'] == true) echo 'checked'; ?> /> Accès à la page <strong>menus</strong>
                                                                            </label>
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsPanelVoter<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['vote']['showPage'] == true) echo 'checked'; ?> /> Accès à la page <strong>voter</strong>
                                                                            </label>
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsPanelMembres<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['members']['showPage'] == true) echo 'checked'; ?> /> Accès à la page <strong>membres</strong>
                                                                            </label>
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsPanelForum<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['forum']['showPage'] == true) echo 'checked'; ?> /> Accès à la page <strong>forum</strong>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 text-left">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsPanelTickets<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['support']['tickets']['showPage'] == true) echo 'checked'; ?> /> Accès à la page <strong>tickets</strong>
                                                                            </label>
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsPanelMaintenance<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['support']['maintenance']['showPage'] == true) echo 'checked'; ?> /> Accès à la page <strong>maintenance</strong>
                                                                            </label>
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" name="permsPanelMaj<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['update']['showPage'] == true) echo 'checked'; ?> /> Accès à la page <strong>mise à jour</strong>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="headingThree<?php echo $i; ?>">
                                                        <h4 class="panel-title text-center">
                                                            <a role="button" data-toggle="collapse" data-parent="#accordion<?php echo $i; ?>" href="#collapseThree<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseThree<?php echo $i; ?>"><strong>Permissions Panel</strong></a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseThree<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree<?php echo $i; ?>">
                                                        <div class="panel-body">
                                                            <div class="col-lg-12 text-center">
                                                                <div class="row" >
                                                                    <div class="col-lg-10 col-lg-offset-1">
                                                                        <div class="panel-group" id="accordionPages<?php echo $i; ?>" role="tablist" aria-multiselectable="true">
                                                                            <div class="alert alert-success">
                                                                                <strong>Avant de vous attaquer à cette liste, veuillez activer l'accès au panel et aux pages que vous souhaitiez pour que la liste ci-dessous prenne effet. Si vous ne voulez pas que le grade accède aux menus, ignorez la liste.</strong>
                                                                            </div>
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading" role="tab" id="headingPagesInfo<?php echo $i; ?>">
                                                                                    <h4 class="panel-title">
                                                                                        <a role="button" data-toggle="collapse" data-parent="#accordionPages<?php echo $i; ?>" href="#collapsePagesInfo<?php echo $i; ?>" aria-expanded="true" aria-controls="collapsePagesInfo<?php echo $i; ?>"><strong>Informations</strong></a>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapsePagesInfo<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPagesInfo<?php echo $i; ?>">
                                                                                    <div class="panel-body">
                                                                                        <div class="col-lg-12 text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12 col-lg-offset-2 text-left">
                                                                                                    <div class="col-lg-7">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelInfoDetailsPlayer<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['info']['details']['player'] == true) echo 'checked'; ?> /> Voir les joueurs en ligne
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelInfoDetailsConsole<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['info']['details']['console'] == true) echo 'checked'; ?> /> Voir la console
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelInfoDetailsCommand<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['info']['details']['command'] == true) echo 'checked'; ?> /> Accès aux commandes
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-lg-8">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelInfoDetailsPlugins<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['info']['details']['plugins'] == true) echo 'checked'; ?> /> Voir les plugins
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelInfoDetailsServer<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['info']['details']['server'] == true) echo 'checked'; ?> /> Accès aux infos du serveur
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-lg-9">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelInfoStatsVisitorsShowTable<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['info']['stats']['visitors']['showTable'] == true) echo 'checked'; ?> /> Voir les stats des visiteurs
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelInfoStatsMembersShowTable<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['info']['stats']['members']['showTable'] == true) echo 'checked'; ?> /> Voir les stats des inscriptions
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelInfoStatsMembersEditLimitIp<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['info']['stats']['members']['editLimitIp'] == true) echo 'checked'; ?> /> Edition de la limite d'inscription par IP
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelInfoStatsMembersShowIP<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['info']['stats']['members']['showIP']) echo 'checked'; ?> /> Voir les adresse IP des joueurs
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-lg-10">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelInfoStatsMembersEditEmail<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['info']['stats']['members']['editEmail'] == true) echo 'checked'; ?> /> Edition de la limite d'inscription par email
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelInfoStatsActivityShowTable<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['info']['stats']['activity']['showTable'] == true) echo 'checked'; ?> /> Voir les stats des activités
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelInfoStatsShopShowTable<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['info']['stats']['shop']['showTable'] == true) echo 'checked'; ?> /> Voir les stats de la boutique
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading" role="tab" id="headingPagesGeneral<?php echo $i; ?>">
                                                                                    <h4 class="panel-title">
                                                                                        <a role="button" data-toggle="collapse" data-parent="#accordionPages<?php echo $i; ?>" href="#collapsePagesGeneral<?php echo $i; ?>" aria-expanded="true" aria-controls="collapsePagesGeneral<?php echo $i; ?>"><strong>General</strong></a>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapsePagesGeneral<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPagesGeneral<?php echo $i; ?>">
                                                                                    <div class="panel-body">
                                                                                        <div class="col-lg-12 text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12 col-lg-offset-2 text-left">
                                                                                                    <div class="col-lg-8">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelGeneralActionsEditGeneral<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['general']['actions']['editGeneral'] == true) echo 'checked'; ?> /> Edition des paramètres généraux
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading" role="tab" id="headingPagesThemes<?php echo $i; ?>">
                                                                                    <h4 class="panel-title">
                                                                                        <a role="button" data-toggle="collapse" data-parent="#accordionPages<?php echo $i; ?>" href="#collapsePagesThemes<?php echo $i; ?>" aria-expanded="true" aria-controls="collapsePagesThemes<?php echo $i; ?>"><strong>Thèmes</strong></a>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapsePagesThemes<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPagesThemes<?php echo $i; ?>">
                                                                                    <div class="panel-body">
                                                                                        <div class="col-lg-12 text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12 col-lg-offset-2 text-left">
                                                                                                    <div class="col-lg-8">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelThemeActionsEditTheme<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['theme']['actions']['editTheme'] == true) echo 'checked'; ?> /> Edition du thème
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelThemeActionsEditBackground<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['theme']['actions']['editBackground'] == true) echo 'checked'; ?> /> Edition du fond d'écran
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelThemeActionsEditTypeBackground<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['theme']['actions']['editTypeBackground'] == true) echo 'checked'; ?> /> Edition du type de fond d'écran
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading" role="tab" id="headingPagesAccueil<?php echo $i; ?>">
                                                                                    <h4 class="panel-title">
                                                                                        <a role="button" data-toggle="collapse" data-parent="#accordionPages<?php echo $i; ?>" href="#collapsePagesAccueil<?php echo $i; ?>" aria-expanded="true" aria-controls="collapsePagesAccueil<?php echo $i; ?>"><strong>Accueil</strong></a>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapsePagesAccueil<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPagesAccueil<?php echo $i; ?>">
                                                                                    <div class="panel-body">
                                                                                        <div class="col-lg-12 text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12 col-lg-offset-3 text-left">
                                                                                                    <div class="col-lg-8">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelHomeActionsUploadSlider<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['home']['actions']['uploadSlider'] == true) echo 'checked'; ?> /> Uploader un slider
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelHomeActionsEditSlider<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['home']['actions']['editSlider'] == true) echo 'checked'; ?> /> Edition des sliders
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelHomeActionsUploadMiniature<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['home']['actions']['uploadMiniature'] == true) echo 'checked'; ?> /> Uploader une miniature
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-lg-8">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelHomeActionsEditMiniature<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['home']['actions']['editMiniature'] == true) echo 'checked'; ?> /> Edition des miniatures
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelHomeActionsAddSlider<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['home']['actions']['addSlider'] == true) echo 'checked'; ?> /> Ajouter un slider
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading" role="tab" id="headingPagesServeur<?php echo $i; ?>">
                                                                                    <h4 class="panel-title">
                                                                                        <a role="button" data-toggle="collapse" data-parent="#accordionPages<?php echo $i; ?>" href="#collapsePagesServeur<?php echo $i; ?>" aria-expanded="true" aria-controls="collapsePagesServeur<?php echo $i; ?>"><strong>Réglages Serveur</strong></a>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapsePagesServeur<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPagesServeur<?php echo $i; ?>">
                                                                                    <div class="panel-body">
                                                                                        <div class="col-lg-12 text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12 col-lg-offset-3 text-left">
                                                                                                    <div class="col-lg-8">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelServerActionsAddServer<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['server']['actions']['addServer'] == true) echo 'checked'; ?> /> Ajouter un serveur
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelServerActionsEditServer<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['server']['actions']['editServer'] == true) echo 'checked'; ?> /> Edition d'un serveur
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading" role="tab" id="headingPagesPages<?php echo $i; ?>">
                                                                                    <h4 class="panel-title">
                                                                                        <a role="button" data-toggle="collapse" data-parent="#accordionPages<?php echo $i; ?>" href="#collapsePagesPages<?php echo $i; ?>" aria-expanded="true" aria-controls="collapsePagesPages<?php echo $i; ?>"><strong>Pages</strong></a>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapsePagesPages<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPagesPages<?php echo $i; ?>">
                                                                                    <div class="panel-body">
                                                                                        <div class="col-lg-12 text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12 col-lg-offset-3 text-left">
                                                                                                    <div class="col-lg-8">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelPagesActionsEditPage<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['pages']['actions']['editPage'] == true) echo 'checked'; ?> /> Edition des pages
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelPagesActionsAddPage<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['pages']['actions']['addPage'] == true) echo 'checked'; ?> /> Ajouter une page
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading" role="tab" id="headingPagesNouveautes<?php echo $i; ?>">
                                                                                    <h4 class="panel-title">
                                                                                        <a role="button" data-toggle="collapse" data-parent="#accordionPages<?php echo $i; ?>" href="#collapsePagesNouveautes<?php echo $i; ?>" aria-expanded="true" aria-controls="collapsePagesNouveautes<?php echo $i; ?>"><strong>Nouveautés</strong></a>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapsePagesNouveautes<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPagesNouveautes<?php echo $i; ?>">
                                                                                    <div class="panel-body">
                                                                                        <div class="col-lg-12 text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12 col-lg-offset-3 text-left">
                                                                                                    <div class="col-lg-8">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelNewsActionsAddNews<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['news']['actions']['addNews'] == true) echo 'checked'; ?> /> Ajouter une nouveauté
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelNewsActionsEditNews<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['news']['actions']['editNews'] == true) echo 'checked'; ?> /> Edition des nouveautés
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading" role="tab" id="headingPagesBoutique<?php echo $i; ?>">
                                                                                    <h4 class="panel-title">
                                                                                        <a role="button" data-toggle="collapse" data-parent="#accordionPages<?php echo $i; ?>" href="#collapsePagesBoutique<?php echo $i; ?>" aria-expanded="true" aria-controls="collapsePagesBoutique<?php echo $i; ?>"><strong>Boutique</strong></a>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapsePagesBoutique<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPagesBoutique<?php echo $i; ?>">
                                                                                    <div class="panel-body">
                                                                                        <div class="col-lg-12 text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12 col-lg-offset-3 text-left">
                                                                                                    <div class="col-lg-8">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelShopActionsAddCategorie<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['shop']['actions']['addCategorie'] == true) echo 'checked'; ?> /> Ajouter une catégorie
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelShopActionsAddOffre<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['shop']['actions']['addOffre'] == true) echo 'checked'; ?> /> Ajouter une offre
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelShopActionsEditCategorieOffre<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['shop']['actions']['editCategorieOffre'] == true) echo 'checked'; ?> /> Edition des offres/catégories
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading" role="tab" id="headingPagesPaiement<?php echo $i; ?>">
                                                                                    <h4 class="panel-title">
                                                                                        <a role="button" data-toggle="collapse" data-parent="#accordionPages<?php echo $i; ?>" href="#collapsePagesPaiement<?php echo $i; ?>" aria-expanded="true" aria-controls="collapsePagesPaiement<?php echo $i; ?>"><strong>Paiement</strong></a>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapsePagesPaiement<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPagesPaiement<?php echo $i; ?>">
                                                                                    <div class="panel-body">
                                                                                        <div class="col-lg-12 text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12 col-lg-offset-3 text-left">
                                                                                                    <div class="col-lg-8">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelPaymentActionsEditPayment<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['payment']['actions']['editPayment'] == true) echo 'checked'; ?> /> Edition des paiements
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelPaymentActionsAddOffrePaypal<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['payment']['actions']['addOffrePaypal'] == true) echo 'checked'; ?> /> Ajouter une offre PayPal
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelPaymentActionsEditOffrePaypal<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['payment']['actions']['editOffrePaypal'] == true) echo 'checked'; ?> /> Edition des offres PayPal
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading" role="tab" id="headingPagesMenus<?php echo $i; ?>">
                                                                                    <h4 class="panel-title">
                                                                                        <a role="button" data-toggle="collapse" data-parent="#accordionPages<?php echo $i; ?>" href="#collapsePagesMenus<?php echo $i; ?>" aria-expanded="true" aria-controls="collapsePagesMenus<?php echo $i; ?>"><strong>Menus</strong></a>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapsePagesMenus<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPagesMenus<?php echo $i; ?>">
                                                                                    <div class="panel-body">
                                                                                        <div class="col-lg-12 text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12 col-lg-offset-2 text-left">
                                                                                                    <div class="col-lg-8">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelMenusActionsAddLinkMenu<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['menus']['actions']['addLinkMenu'] == true) echo 'checked'; ?> /> Ajouter un lien menu
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelMenusActionsAddDropLinkMenu<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['menus']['actions']['addDropLinkMenu'] == true) echo 'checked'; ?> /> Ajouter un menu déroulant
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelMenusActionsEditDropAndLinkMenu<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['menus']['actions']['editDropAndLinkMenu'] == true) echo 'checked'; ?> /> Edition des lien menus/déroulants
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading" role="tab" id="headingPagesVoter<?php echo $i; ?>">
                                                                                    <h4 class="panel-title">
                                                                                        <a role="button" data-toggle="collapse" data-parent="#accordionPages<?php echo $i; ?>" href="#collapsePagesVoter<?php echo $i; ?>" aria-expanded="true" aria-controls="collapsePagesVoter<?php echo $i; ?>"><strong>Voter</strong></a>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapsePagesVoter<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPagesVoter<?php echo $i; ?>">
                                                                                    <div class="panel-body">
                                                                                        <div class="col-lg-12 text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12 col-lg-offset-3 text-left">
                                                                                                    <div class="col-lg-8">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelVoteActionsEditSettings<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['vote']['actions']['editSettings'] == true) echo 'checked'; ?> /> Edition des réglages
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelVoteActionsAddVote<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['vote']['actions']['addVote'] == true) echo 'checked'; ?> /> Ajouter un lien de vote
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelVoteActionsResetVote<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['vote']['actions']['resetVote'] == true) echo 'checked'; ?> /> Réinitialiser les votes
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-lg-8">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelVoteActionsDeleteVote<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['vote']['actions']['deleteVote'] == true) echo 'checked'; ?> /> Supprimer un lien de vote
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading" role="tab" id="headingPagesMembres<?php echo $i; ?>">
                                                                                    <h4 class="panel-title">
                                                                                        <a role="button" data-toggle="collapse" data-parent="#accordionPages<?php echo $i; ?>" href="#collapsePagesMembres<?php echo $i; ?>" aria-expanded="true" aria-controls="collapsePagesMembres<?php echo $i; ?>"><strong>Membres</strong></a>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapsePagesMembres<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPagesMembres<?php echo $i; ?>">
                                                                                    <div class="panel-body">
                                                                                        <div class="col-lg-12 text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12 col-lg-offset-3 text-left">
                                                                                                    <div class="col-lg-8">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelMembersActionsEditMember<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['members']['actions']['editMember'] == true) echo 'checked'; ?> /> Edition des membres
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading" role="tab" id="headingPagesForum<?php echo $i; ?>">
                                                                                    <h4 class="panel-title">
                                                                                        <a role="button" data-toggle="collapse" data-parent="#accordionPages<?php echo $i; ?>" href="#collapsePagesForum<?php echo $i; ?>" aria-expanded="true" aria-controls="collapsePagesForum<?php echo $i; ?>"><strong>Forum</strong></a>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapsePagesForum<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPagesForum<?php echo $i; ?>">
                                                                                    <div class="panel-body">
                                                                                        <div class="col-lg-12 text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12 col-lg-offset-3 text-left">
                                                                                                    <div class="col-lg-8">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelForumActionsAddSmiley<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['forum']['actions']['addSmiley'] == true) echo 'checked'; ?> /> Ajout de smileys
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelForumActionsSeeSmileys<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['forum']['actions']['seeSmileys'] == true) echo 'checked'; ?> /> Voir/Supprimer les smileys
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelForumActionsAddPrefix<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['forum']['actions']['addPrefix'] == true) echo 'checked'; ?> /> Ajouter des prefixes de discussion
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelForumActionsSeePrefix<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['forum']['actions']['seePrefix'] == true) echo 'checked'; ?> /> Voir/supprimer les prefixes de discussion
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading" role="tab" id="headingPagesWidgets<?php echo $i; ?>">
                                                                                    <h4 class="panel-title">
                                                                                        <a role="button" data-toggle="collapse" data-parent="#accordionPages<?php echo $i; ?>" href="#collapsePagesWidgets<?php echo $i; ?>" aria-expanded="true" aria-controls="collapsePagesWidgets<?php echo $i; ?>"><strong>Widgets</strong></a>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapsePagesWidgets<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPagesWidgets<?php echo $i; ?>">
                                                                                    <div class="panel-body">
                                                                                        <div class="col-lg-12 text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12 col-lg-offset-3 text-left">
                                                                                                    <div class="col-lg-8">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelWidgetsActionsAddWidgets<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['widgets']['actions']['addWidgets'] == true) echo 'checked'; ?> /> Ajouter un Widget
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelWidgetsActionsEditWidgets<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['widgets']['actions']['editWidgets'] == true) echo 'checked'; ?> /> Edition des Widgets
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading" role="tab" id="headingPagesTickets<?php echo $i; ?>">
                                                                                    <h4 class="panel-title">
                                                                                        <a role="button" data-toggle="collapse" data-parent="#accordionPages<?php echo $i; ?>" href="#collapsePagesTickets<?php echo $i; ?>" aria-expanded="true" aria-controls="collapsePagesTickets<?php echo $i; ?>"><strong>Tickets</strong></a>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapsePagesTickets<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPagesTickets<?php echo $i; ?>">
                                                                                    <div class="panel-body">
                                                                                        <div class="col-lg-12 text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12 col-lg-offset-3 text-left">
                                                                                                    <div class="col-lg-8">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelSupportTicketsActionsEditEtatTicket<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['support']['tickets']['actions']['editEtatTicket'] == true) echo 'checked'; ?> /> Changer l'état des tickets
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelSupportTicketsActionsDeleteTicket<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['support']['tickets']['actions']['deleteTicket'] == true) echo 'checked'; ?> /> Supprimer un ticket
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading" role="tab" id="headingPagesMaintenance<?php echo $i; ?>">
                                                                                    <h4 class="panel-title">
                                                                                        <a role="button" data-toggle="collapse" data-parent="#accordionPages<?php echo $i; ?>" href="#collapsePagesMaintenance<?php echo $i; ?>" aria-expanded="true" aria-controls="collapsePagesMaintenance<?php echo $i; ?>"><strong>Maintenance</strong></a>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapsePagesMaintenance<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPagesMaintenance<?php echo $i; ?>">
                                                                                    <div class="panel-body">
                                                                                        <div class="col-lg-12 text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12 col-lg-offset-2 text-left">
                                                                                                    <div class="col-lg-10">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelSupportMaintenanceActionsEditDefaultMessage<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['support']['maintenance']['actions']['editDefaultMessage'] == true) echo 'checked'; ?> /> Edition du message par défaut
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelSupportMaintenanceActionsEditAdminMessage<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['support']['maintenance']['actions']['editAdminMessage'] == true) echo 'checked'; ?> /> Edition du message adressé aux admins
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelSupportMaintenanceActionsEditEtatMaintenance<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['support']['maintenance']['actions']['editEtatMaintenance'] == true) echo 'checked'; ?> /> Changer l'état de la maintenance
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-lg-8">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelSupportMaintenanceActionsSwitchRedirectMode<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['support']['maintenance']['actions']['switchRedirectMode'] == true) echo 'checked'; ?> /> Changer le mode de redirection
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading" role="tab" id="headingPagesNewsLetter<?php echo $i; ?>">
                                                                                    <h4 class="panel-title">
                                                                                        <a role="button" data-toggle="collapse" data-parent="#accordionPages<?php echo $i; ?>" href="#collapsePagesNewsLetter<?php echo $i; ?>" aria-expanded="true" aria-controls="collapsePagesNewsLetter<?php echo $i; ?>"><strong>NewsLetter</strong></a>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapsePagesNewsLetter<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPagesNewsLetter<?php echo $i; ?>">
                                                                                    <div class="panel-body">
                                                                                        <div class="col-lg-12 text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12 col-lg-offset-2 text-left">
                                                                                                    <div class="col-lg-10">
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsPanelNewsletterActionsEditDefaultMessage<?php echo $i; ?>" <?php if($idGrade[$i]['PermsPanel']['newsletter']['actions']['send']) echo 'checked'; ?> /> Peut envoyer une newsletter
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading" role="tab" id="headingPagesMaj<?php echo $i; ?>">
                                                                                    <h4 class="panel-title">
                                                                                        <a role="button" data-toggle="collapse" data-parent="#accordionPages<?php echo $i; ?>" href="#collapsePagesMaj<?php echo $i; ?>" aria-expanded="true" aria-controls="collapsePagesMaj<?php echo $i; ?>"><strong>Mise à jour</strong></a>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapsePagesMaj<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPagesMaj<?php echo $i; ?>">
                                                                                    <div class="panel-body">
                                                                                        <div class="col-lg-12 text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-8 col-lg-offset-2">
                                                                                                    <div class="col-lg-12">
                                                                                                        <strong>Aucune permission disponible</strong>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
												<div class="panel panel-default">
													<div class="panel-heading" role="tab" id="headingFour<?php echo $i; ?>">
														<h4 class="panel-title text-center">
															<a role="button" data-toggle="collapse" data-parent="#accordion<?php echo $i; ?>" href="#collapseFour<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseFour<?php echo $i; ?>"><strong>Permissions Forum</strong></a>
														</h4>
													</div>
													<div id="collapseFour<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour<?php echo $i; ?>">
														<div class="panel-body">
															<div class="col-lg-12 text-center">
																<div class="row">
																	<div class="col-lg-10 col-lg-offset-1">
																		<div class="panel-group" id="accordionForum<?php echo $i; ?>" role="tablist"aria-multiselectable="true">
																			<div class="panel panel-default">
																				<div class="panel-heading" role="tab" id="headingGeneral<?php echo $i; ?>">
																					<h4 class="panel-title">
																						<a role="button" data-toggle="collapse" data-parent="accordionForum<?php echo $i; ?>" href="#collapseGeneral<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseGeneral<?php echo $i; ?>"><strong>Général</strong></a>
																					</h4>
																				</div>
																				<div id="collapseGeneral<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingGeneral<?php echo $i; ?>">
																					<div class="panel-body">
																						<div class="col-lg-12 text-center">
																							<div class="row">
																								<div class="col-lg-12 col-lg-offset-2 text-left">
																									<div class="col-lg-10">
																										<div class="checkbox">
																											<label>
																												<input type="checkbox" name="permsForumGeneralAddCategorie<?php echo $i; ?>" <?php if($idGrade[$i]['PermsForum']['general']['addCategorie'] == true) echo 'checked'; ?> /> Ajouter des Catégories
																											</label>
																										</div>
																										<div class="checkbox">
																											<label>
																												<input type="checkbox" name="permsForumGeneralAddForum<?php echo $i; ?>" <?php if($idGrade[$i]['PermsForum']['general']['addForum'] == true) echo 'checked'; ?> /> Ajouter des Forums
																											</label>
																										</div>
																										<div class="checkbox">
																											<label>
																												<input type="checkbox" name="permsForumGeneralDeleteForum<?php echo $i; ?>" <?php if($idGrade[$i]['PermsForum']['general']['deleteForum'] == true) echo 'checked'; ?> /> Supprimer des Forums
																											</label>
																										</div>
																										<div class="checkbox">
																											<label>
																												<input type="checkbox" name="permsForumGeneralDeleteCategorie<?php echo $i; ?>" <?php if($idGrade[$i]['PermsForum']['general']['deleteCategorie'] == true) echo 'checked'; ?> /> Supprimer des Catégories
																											</label>
																										</div>
																										<div class="checkbox">
																											<label>
																												<input type="checkbox" name="permsForumGeneralAddSousForum<?php echo $i; ?>" <?php if($idGrade[$i]['PermsForum']['general']['addSousForum'] == true) echo 'checked'; ?> /> Ajouter des Sous-Forums
																											</label>
																										</div>
																										<div class="checkbox">
																											<label>
																												<input type="checkbox" name="permsForumGeneralDeleteSousForum<?php echo $i; ?>" <?php if($idGrade[$i]['PermsForum']['general']['deleteSousForum'] == true) echo 'checked'; ?> /> Supprimer des Sous-Forums
																											</label>
																										</div>
																										<div class="checkbox">
																											<label>
																												<input type="checkbox" name="permsForumGeneralModeJoueur<?php echo $i; ?>" <?php if($idGrade[$i]['PermsForum']['general']['modeJoueur'] == true) echo 'checked'; ?> /> Passer au visuel Joueur/Administrateur
																											</label>
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>	
																			<div class="panel panel-default">
																				<div class="panel-heading" role="tab" id="headingModeration<?php echo $i; ?>">
																					<h4 class="panel-title">
																						<a role="button" data-toggle="collapse" data-parent="accordionForum<?php echo $i; ?>" href="#collapseModeration<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseModeration<?php echo $i; ?>"><strong>Modération</strong></a>
																					</h4>
																				</div>
																				<div id="collapseModeration<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingModeration<?php echo $i; ?>">
																					<div class="panel-body">
																						<div class="col-lg-12 text-center">
																							<div class="row">
																								<div class="col-lg-12 col-lg-offset-2 text-left">
																									<div class="col-lg-10">
																										<div class="checkbox">
																											<label>
																												<input type="checkbox" name="permsForumModerationEditTopic<?php echo $i; ?>" <?php if($idGrade[$i]['PermsForum']['moderation']['editTopic'] == true) echo 'checked'; ?> /> Editer des Topics
																											</label>
																										</div>
																										<div class="checkbox">
																											<label>
																												<input type="checkbox" name="permsForumModerationDeleteTopic<?php echo $i; ?>" <?php if($idGrade[$i]['PermsForum']['moderation']['deleteTopic'] == true) echo 'checked'; ?> /> Supprimer des Topics
																											</label>
																										</div>
																										<div class="checkbox">
																											<label>
																												<input type="checkbox" name="permsForumModerationEditMessage<?php echo $i; ?>" <?php if($idGrade[$i]['PermsForum']['moderation']['editMessage'] == true) echo 'checked'; ?> /> Editer des Messages
																											</label>
																										</div>
																										<div class="checkbox">
																											<label>
																												<input type="checkbox" name="permsForumModerationDeleteMessage<?php echo $i; ?>" <?php if($idGrade[$i]['PermsForum']['moderation']['deleteMessage'] == true) echo 'checked'; ?> /> Supprimer des Messages
																											</label>
																										</div>
																										<div class="checkbox">
																											<label>
																												<input type="checkbox" name="permsForumModerationCloseTopic<?php echo $i; ?>" <?php if($idGrade[$i]['PermsForum']['moderation']['closeTopic'] == true) echo 'checked'; ?> /> Fermer/Ouvrir des Topics
																											</label>
																										</div>
																										<div class="checkbox">
																											<label>
																												<input type="checkbox" name="permsForumModerationMooveTopic<?php echo $i; ?>" <?php if($idGrade[$i]['PermsForum']['moderation']['mooveTopic'] == true) echo 'checked'; ?> /> Déplacer des Topics
																											</label>
																										</div>
																										<div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsForumModerationSeeSignalement<?php echo $i; ?>" <?php if($idGrade[$i]['PermsForum']['moderation']['seeSignalement'] == true) echo 'checked'; ?> /> 
                                                                                                                    Voir les topics/messages signalés
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsForumModerationAddPrefix<?php echo $i; ?>" <?php if($idGrade[$i]['PermsForum']['moderation']['addprefix'] == true) echo 'checked'; ?> /> 
                                                                                                                    Ajouter/Enlever des préfixes de discussions
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
                                                                                                            <label>
                                                                                                                <input type="checkbox" name="permsForumModerationEpingle<?php echo $i; ?>" <?php if($idGrade[$i]['PermsForum']['moderation']['epingle'] == true) echo 'checked'; ?> /> 
                                                                                                                    Epingler des topics
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="checkbox">
																											<label>
																												<input type="checkbox" name="permsForumModerationSelTopic<?php echo $i; ?>" <?php if($idGrade[$i]['PermsForum']['moderation']['selTopic'] == true) echo 'checked'; ?> /> 
                                                                                                                    Peut sélectionner des topics (les deux précédentes permissions sont inutiles sans celle-ci)
																											</label>
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
                                                <div class="row">
                                                    <div class="col-md-12 text-center" style="margin-top: 5px;">
                                                        <a class="btn btn-danger" href="?&action=supprGrade&grade=<?php echo $i; ?>">Supprimer le grade <?php echo $idGrade[$i]['Grade']; ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                            <?php }
                                            } ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center" style="margin-top: 5px;">
                                                <input type="submit" class="btn btn-success" value="Valider les changements !"/>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
        <?php } else { ?>
            <div class="col-md-12 text-center">
                <div class="alert alert-danger">
                    <strong>Aucun grade est actif.</strong>
                </div>
            </div>
        <?php } ?>    
</div>
<!-- /.row -->