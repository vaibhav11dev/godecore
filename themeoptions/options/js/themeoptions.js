jQuery(document).ready(function () {

    var vedantamenu;

    // Hide the menu from Appearance.
    jQuery('#menu-appearance a[href="themes.php?page=godecore_options"]').css('display', 'none');

    // Activate the vedanta admin menu theme option entry when theme options are active
    if (jQuery('a[href="admin.php?page=godecore_options"]').hasClass('current')) {
        vedantamenu = jQuery('#toplevel_page_vedanta');

        vedantamenu.addClass('wp-has-current-submenu wp-menu-open');
        vedantamenu.children('a').addClass('wp-has-current-submenu wp-menu-open');
        vedantamenu.children('.wp-submenu').find('a[href="admin.php?page=godecore_options"]').parent().addClass('current');
        vedantamenu.children('.wp-submenu').find('a[href="admin.php?page=godecore_options"]').addClass('current');

        // Do not show the appearance menu as active
        jQuery('#menu-appearance a[href="themes.php"]').removeClass('wp-has-current-submenu wp-menu-open');
        jQuery('#menu-appearance').removeClass('wp-has-current-submenu wp-menu-open');
        jQuery('#menu-appearance').addClass('wp-not-current-submenu');
        jQuery('#menu-appearance a[href="themes.php"]').addClass('wp-not-current-submenu');
        jQuery('#menu-appearance').children('.wp-submenu').find('li').removeClass('current');
    }
});
