<?php 
    $id_level = $_SESSION['ID_LEVEL'] ?? '';

    $queryLevelMenu = mysqli_query($config, "SELECT * FROM menus JOIN level_menus ON menus.id = level_menus.id_menu WHERE id_level = '$id_level' ORDER BY menus.`order`");
    $rowLevelMenus = mysqli_fetch_all($queryLevelMenu, MYSQLI_ASSOC);
?>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <?php foreach ($rowLevelMenus as $rowLevelMenu): ?> 
            <?php if($rowLevelMenu['link'] == 'history') {
                
            } ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="?page=<?= $rowLevelMenu['link'] ?>">
                <i class="<?= $rowLevelMenu['icon'] ?>"></i>
                <span><?= $rowLevelMenu['name'] ?></span>
            </a>
        </li>
        <?php endforeach ?>
    </ul>

</aside>
<!-- End Sidebar-->