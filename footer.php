<div class="footer-container">
    <div class="footer-menus">
        <div class="footer-menu-left">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer_left',
                'container' => 'nav',
                'container_class' => 'footer-left-nav',
                'menu_class' => 'footer-left-menu',
                'walker' => new Image_Walker_Nav_Menu()
            ));
            ?>
        </div>

        <div class="footer-menu-right">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer_right',
                'container' => 'nav',
                'container_class' => 'footer-right-nav',
                'menu_class' => 'footer-right-menu',
            ));
            ?>
        </div>
    </div>
    <div class="signature">
        <p>Developed by MuCow Media</p>
        <p>Copyright © CircaWanderlust 2026</p>
    </div>
</div>
<?php wp_footer();?>
</body>
</html>
