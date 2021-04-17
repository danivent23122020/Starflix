<div id="sidebarWrapper">
    <div id="sidebarmenu">
        <a href="/admin">Accueil</a>
        <button class="btn-dropdown"> Gestion des films
        </button>
        <div class="dropdown-movie">
            <form action="/admin/index.php" method="post">
                <input type="hidden" name="menuAdd">
                <input type="submit" value="Ajouter un film" class="btn-sidebar">
            </form>
            <form action="/admin/index.php" method="post">
                <input type="hidden" name="menuEdit">
                <input type="submit" value="Editer/Supprimer un film" class="btn-sidebar">
            </form>
            </div>
            <button class="btn-dropdown"> Gestion des utilisateurs
        </button>
        <div class="dropdown-movie">
            <form action="/admin_users/index.php" method="post">
                <input type="hidden" name="usersList">
                <input type="submit" value="Liste des utilisateurs" class="btn-sidebar">
            </form>
            </div>
    </div>
</div>