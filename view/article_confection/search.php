<div class="rechercher">
            <form action="<?= WEB_ROUTE ?>" method="get">
                <input type="hidden" name="controller" value="fournisseur">
                <input type="hidden" name="view" value="fournisseur_list">
                <label for="">Recherche</label>
                <input type="text" name="recherche" class="butt">
                <button class="butte" name="OK">OK</button>
            </form>
        </div>





        <?php foreach ($articleconfectionlist as $article) : ?>
                    <div class="card">
                        <div class="">
                            <img class="img-carte" src="<?=WEB_ROUTE.'/images/uploads/'.$article['photoAC']?>" alt="">
                            <h3>Nom: <?= $article['libelleAC'] ?></h3>
                            <h4>Prix: <?= $article['prixAC'] ?></h4>
                            <h4>Quantite: <?= $article['quantiteAC'] ?></h4>
                            <h4>Montant: <?= (int)$article['quantiteAC'] * (int)$article['prixAC'] ?></h4>
                            <div class="action">
                            <a href="<?=WEB_ROUTE.'?controller=articleConfectionController&view=move&id='.$article['idAC']?>" 
                                class="btn btn-secondary">Modifier</a>
                                &nbsp;&nbsp;
                                <a href="<?=WEB_ROUTE.'?controller=articleConfectionController&view=delet&idAC='.$article['idAC']?>" 
                                onclick="confirm('Vouslez-vous vraiment supprimer ?')"
                                 class="text-white" >
                                  <i class="fa-solid fa-trash"></i>Supprimer</a>
                        </div>
                    </div>
                    
                <?php endforeach; ?>