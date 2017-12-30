<?php
    // creating a variable to remove conflict on Homepage
    if (isset($_GET['menu'])) {
        $menu_item = $_GET['menu'];
    }
    else {
        $menu_item = '';
    }
?>
<ul>
    <li <?php if($menu_item == 1) echo "class='current'" ?>>
        <a href="index.php?menu=1">Catalog</a>
    </li>

    <?php if(isset($_SESSION['regadmin'])) : ?>
        <li <?php if($menu_item == 4) echo "class='current'" ?>>
            <a href="index.php?menu=4">Archive</a>
        </li>
        <li <?php if($menu_item == 5) echo "class='current'" ?>>
            <a href="index.php?menu=5">Admin Area</a>
        </li>
    <?php endif; ?>

</ul>