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
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">FIL ROUGE</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="#">
          <i class='bx bx-grid-alt'></i>
          <span class="link_name">Tableau</span>
        </a>
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
            <span class="link_name">Approvisionnement</span>
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
            <i class="fa fa-users" style="font-size:20px;color:white"></i>
            <span class="link_name">Client</span>
          </a>
        </div>
        <ul class="sub-menu">
          <li><a href="<?= WEB_ROUTE . "?controller=client&view=client" ?>">Ajouter Client</a></li>
          <li><a href="<?= WEB_ROUTE . "?controller=client&view=client_list" ?>">Liste Client</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-cog'></i>
          <span class="link_name">Setting</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Setting</a></li>
        </ul>
      </li>
      <li>
        <div class="profile-details">
          <div class="profile-content">
            <img src="images/profile.jpg.png" alt="profileImg">
          </div>
          <div class="name-job">
            <div class="profile_name">Mamadou Diouf</div>
            <div class="job">Developpeur Web</div>
          </div>
          <a href="<?= WEB_ROUTE . "?controller=deconnexion&view=dehors" ?>"><i class='bx bx-log-out'>Deconnexion</i></a>
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