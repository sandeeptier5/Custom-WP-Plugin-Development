<?php

class MM_WPFS_Admin_Menu
{
    private $capability = 'manage_options';

    public function __construct()
    {
        add_action('admin_init', array($this, 'admin_init'));
        add_action('admin_menu', array($this, 'menu_pages'));
        if (defined('WP_FULL_STRIPE_DEMO_MODE'))
            $this->capability = 'read';
    }

    function admin_init()
    {
        wp_register_style('fullstripe-css', plugins_url('/css/fullstripe.css', dirname(__FILE__)), null, MM_WPFS::VERSION);
        wp_register_style('fullstripe-ui-css', plugins_url('/css/fullstripe-ui.css', dirname(__FILE__)), null, MM_WPFS::VERSION);
    }

    function menu_pages()
    {
        // Add the top-level admin menu
        $page_title = 'Full Stripe Settings';
        $menu_title = 'Full Stripe';
        $menu_slug = 'fullstripe-settings';
        $capability = $this->capability;
        $function = array($this, 'fullstripe_settings');
        add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function);

        // Add submenu page with same slug as parent to ensure no duplicates
        $sub_menu_title = 'Settings';
        $menu_hook = add_submenu_page($menu_slug, $page_title, $sub_menu_title, $capability, $menu_slug, $function);
        add_action('admin_print_scripts-' . $menu_hook, array($this, 'fullstripe_admin_scripts')); //this ensures script/styles only loaded for this plugin admin pages

        $submenu_page_title = 'Full Stripe Payments';
        $submenu_title = 'Payments';
        $submenu_slug = 'fullstripe-payments';
        $submenu_function = array($this, 'fullstripe_payments');
        $menu_hook = add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);
        add_action('admin_print_scripts-' . $menu_hook, array($this, 'fullstripe_admin_scripts'));

        $submenu_page_title = 'Full Stripe Subscriptions';
        $submenu_title = 'Subscriptions';
        $submenu_slug = 'fullstripe-subscriptions';
        $submenu_function = array($this, 'fullstripe_subscriptions');
        $menu_hook = add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);
        add_action('admin_print_scripts-' . $menu_hook, array($this, 'fullstripe_admin_scripts'));

        $submenu_page_title = 'Full Stripe Transfers';
        $submenu_title = 'Transfers';
        $submenu_slug = 'fullstripe-transfers';
        $submenu_function = array($this, 'fullstripe_transfers');
        $menu_hook = add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);
        add_action('admin_print_scripts-' . $menu_hook, array($this, 'fullstripe_admin_scripts'));

        $submenu_page_title = 'Full Stripe Help';
        $submenu_title = 'Help';
        $submenu_slug = 'fullstripe-help';
        $submenu_function = array($this, 'fullstripe_help');
        $menu_hook = add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);
        add_action('admin_print_scripts-' . $menu_hook, array($this, 'fullstripe_admin_scripts'));

        $submenu_page_title = 'About WP Full Stripe';
        $submenu_title = 'About';
        $submenu_slug = 'fullstripe-about';
        $submenu_function = array($this, 'fullstripe_about_page');
        add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);

        //edit forms page - don't show on submenu
        $submenu_page_title = 'Full Stripe Edit Form';
        $submenu_title = 'Edit Form';
        $submenu_slug = 'fullstripe-edit-form';
        $submenu_function = array($this, 'fullstripe_edit_form');
        $menu_hook = add_submenu_page(null, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);
        add_action('admin_print_scripts-' . $menu_hook, array($this, 'fullstripe_admin_scripts'));

        //edit plans page - don't show on submenu
        $submenu_page_title = 'Full Stripe Edit Plan';
        $submenu_title = 'Edit Plan';
        $submenu_slug = 'fullstripe-edit-plan';
        $submenu_function = array($this, 'fullstripe_edit_plan');
        $menu_hook = add_submenu_page(null, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);
        add_action('admin_print_scripts-' . $menu_hook, array($this, 'fullstripe_admin_scripts'));

        do_action('fullstripe_admin_menus', $menu_slug);
    }

    function fullstripe_admin_scripts()
    {
	    $options = get_option('fullstripe_options');
        wp_enqueue_media();
        wp_enqueue_script('stripe-js', 'https://js.stripe.com/v2/', array('jquery'));
	    wp_enqueue_script( 'sprintf-js', plugins_url( 'js/sprintf.min.js', dirname( __FILE__ ) ), null, MM_WPFS::VERSION );
        wp_enqueue_script('wp-full-stripe-admin-js', plugins_url('/js/wp-full-stripe-admin.js', dirname(__FILE__)), array('sprintf-js', 'jquery', 'stripe-js', 'jquery-ui-tabs', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-autocomplete', 'jquery-ui-button', 'jquery-ui-tooltip', 'jquery-ui-sortable'), MM_WPFS::VERSION);
        if ($options['apiMode'] === 'test')
        {
            wp_localize_script('wp-full-stripe-admin-js', 'stripekey', $options['publishKey_test']);
        }
        else
        {
            wp_localize_script('wp-full-stripe-admin-js', 'stripekey', $options['publishKey_live']);
        }
        wp_localize_script('wp-full-stripe-admin-js', 'admin_ajaxurl', admin_url('admin-ajax.php'));
        wp_localize_script('wp-full-stripe-admin-js', 'currencySymbol', MM_WPFS::get_currency_symbol_for($options['currency']));
        wp_localize_script( 'wp-full-stripe-admin-js', 'emailReceipts', json_decode($options['email_receipts']) );
        wp_enqueue_style('fullstripe-css');
        wp_enqueue_style('fullstripe-ui-css');

        do_action('fullstripe_admin_scripts');

    }

    function fullstripe_settings()
    {
        if (!current_user_can($this->capability))
        {
            wp_die('You do not have sufficient permissions to access this page.');
        }

        include WP_FULL_STRIPE_DIR . '/pages/fullstripe_admin_page.php';
    }

    function fullstripe_payments()
    {
        if (!current_user_can($this->capability))
        {
            wp_die('You do not have sufficient permissions to access this page.');
        }

        if (!class_exists('WP_List_Table'))
        {
            require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
        }
        if (!class_exists('WPFS_Payments_Table'))
        {
            require_once(WP_FULL_STRIPE_DIR . '/include/wp-full-stripe-table-payments.php');
        }

        $table = new WPFS_Payments_Table();
        $table->prepare_items();

        include WP_FULL_STRIPE_DIR . '/pages/fullstripe_payments_page.php';
    }

    function fullstripe_subscriptions()
    {
        if (!current_user_can($this->capability))
        {
            wp_die('You do not have sufficient permissions to access this page.');
        }

        if (!class_exists('WP_List_Table'))
        {
            require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
        }
        if (!class_exists('WPFS_Subscribers_Table'))
        {
            require_once(WP_FULL_STRIPE_DIR . '/include/wp-full-stripe-table-subscribers.php');
        }
        if (!class_exists('WPFS_Multiple_Subscribers_Table')) {
            require_once(WP_FULL_STRIPE_DIR . '/include/wp-full-stripe-table-multiple-subscribers.php');
        }

        $subscribersTable = new WPFS_Multiple_Subscribers_Table();

        include WP_FULL_STRIPE_DIR . '/pages/fullstripe_subscriptions_page.php';
    }

    function fullstripe_transfers()
    {
        if (!current_user_can($this->capability))
        {
            wp_die('You do not have sufficient permissions to access this page.');
        }

        include WP_FULL_STRIPE_DIR . '/pages/fullstripe_transfers_page.php';
    }

    function fullstripe_help()
    {
        if (!current_user_can($this->capability))
        {
            wp_die('You do not have sufficient permissions to access this page.');
        }

        include WP_FULL_STRIPE_DIR . '/pages/fullstripe_help_page.php';
    }

    function fullstripe_edit_form()
    {
        if (!current_user_can($this->capability))
        {
            wp_die('You do not have sufficient permissions to access this page.');
        }

        include WP_FULL_STRIPE_DIR . '/pages/fullstripe_edit_form_page.php';
    }

    function fullstripe_about_page()
    {
        if (!current_user_can($this->capability))
        {
            wp_die('You do not have sufficient permissions to access this page.');
        }

        include WP_FULL_STRIPE_DIR . '/pages/fullstripe_about_page.php';
    }

    function fullstripe_edit_plan()
    {
        if (!current_user_can($this->capability))
        {
            wp_die('You do not have sufficient permissions to access this page.');
        }

        include WP_FULL_STRIPE_DIR . '/pages/fullstripe_edit_plan_page.php';
    }
}


