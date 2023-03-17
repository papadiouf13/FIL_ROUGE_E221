<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> FILE ROUGE</title>
  <link rel="stylesheet" href="css/menu.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="sidebar close">
    <div class="logo-details">
      <!-- <i class='bx bxl-c-plus-plus'></i> -->
      <img src="images/logo.png.png" alt="profileImg" class="logo">
      <span class="logo_name">FIL ROUGE</span>
    </div>
    <ul class="nav-links">
    <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-grid-alt'></i>
            <span class="link_name">TABLEAU BORD</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a href="<?= WEB_ROUTE . "?controller=tableaubord&view=tableaubord" ?>">Tableau Bord</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-collection'></i>
            <span class="link_name">Categorie</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a href="<?= WEB_ROUTE . "?controller=categorieController&view=categorie" ?>">Ajouter Categorie</a></li>
          <li><a href="<?= WEB_ROUTE . "?controller=categorieController&view=categorie_list" ?>">Liste Categorie</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fa fa-user" style="font-size:20px;color:white"></i>
            <span class="link_name">Fournisseur</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a href="<?= WEB_ROUTE . "?controller=fournisseur&view=fournisseur" ?>">Ajouter Fournisseur</a></li>
          <li><a href="<?= WEB_ROUTE . "?controller=fournisseur&view=fournisseur_list" ?>">Liste Fournisseur</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-book-alt'></i>
            <span class="link_name">Approvisioment</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a href="<?= WEB_ROUTE . "?controller=approvisionnement&view=approvisionnement" ?>">Ajouter Approvisionnement</a></li>
          <li><a href="<?= WEB_ROUTE . "?controller=approvisionnement&view=approvisionnement_list" ?>">Liste Approvisionnement</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-book-alt'></i>
            <span class="link_name">Article Confection</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a href="<?= WEB_ROUTE . "?controller=articleConfectionController&view=add_article" ?>">Ajouter Art Confection</a></li>
          <li><a href="<?= WEB_ROUTE . "?controller=articleConfectionController&view=article_list" ?>">Liste Art Confection</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-collection'></i>
            <span class="link_name">Cat. Vente</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a href="<?= WEB_ROUTE . "?controller=catventeController&view=categorievente" ?>">Ajouter Categorie Vente</a></li>
          <li><a href="<?= WEB_ROUTE . "?controller=catventeController&view=categorievente_list" ?>">Liste Categorie Vente</a></li>
        </ul>

      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-collection'></i>
            <span class="link_name">Article Vente</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a href="<?= WEB_ROUTE . "?controller=articleVenteController&view=add_article" ?>">Ajouter Article Vente</a></li>
          <li><a href="<?= WEB_ROUTE . "?controller=articleVenteController&view=article_list" ?>">Liste Article Vente</a></li>
        </ul>

      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-collection'></i>
            <span class="link_name">Production Vente</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a href="<?= WEB_ROUTE . "?controller=productionventeController&view=add_article" ?>">Ajouter Production Vente</a></li>
          <li><a href="<?= WEB_ROUTE . "?controller=productionventeController&view=article_list" ?>">Liste Production Vente</a></li>
        </ul>

      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-book-alt'></i>
            <span class="link_name">VENTE</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a href="<?= WEB_ROUTE . "?controller=vente&view=vente" ?>">Ajouter Vente</a></li>
          <li><a href="<?= WEB_ROUTE . "?controller=vente&view=vente_list" ?>">Liste Vente</a></li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fa fa-users" style="font-size:20px;color:white"></i>
            <span class="link_name">Client</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a href="<?= WEB_ROUTE . "?controller=client&view=client" ?>">Ajouter Client</a></li>
          <li><a href="<?= WEB_ROUTE . "?controller=client&view=client_list" ?>">Liste Client</a></li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fa fa-user-plus" style="font-size:20px;color:white"></i>
            <span class="link_name">Utilisateur</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a href="<?= WEB_ROUTE . "?controller=utilisateur&view=utilisateur" ?>">Ajouter Utilisateur</a></li>
          <li><a href="<?= WEB_ROUTE . "?controller=utilisateur&view=utilisateur_list" ?>">Liste Utilisateur</a></li>
        </ul>
      </li>

      <!-- <li>
        <a href="#">
          <i class='bx bx-cog'></i>
          <span class="link_name">Setting</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Setting</a></li>
        </ul>
      </li> -->
      <li>
        <div class="profile-details">
          <div class="profile-content">
            <img src="images/profile.jpg.png" alt="profileImg">
          </div>
          <div class="name-job">
            <div class="profile_name">Mamadou Diouf</div>
            <div class="job">Developpeur Web</div>
            <a href="<?= WEB_ROUTE . "?controller=deconnexion&view=dehors" ?>"><i class='bx bx-log-out'>Deconnexion</i></a>
          </div>
        </div>
      </li>
    </ul>
  </div>
  <div class="home-section">
    <div class="home-content">
      <i class='bx bx-menu'></i>

    </div>
  </div>

  <script src="js/script.js"></script>

</body>

</html>