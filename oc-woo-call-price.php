<?php
/**
* Plugin Name: Call for Price Woocommerce
* Description: This plugin allows create Call for Price plugin.
* Version: 1.0
* Copyright: 2020
* Text Domain: call-for-price-woocommerce
* Domain Path: /languages 
*/

if (!defined('ABSPATH')) {
  die('-1');
}
if (!defined('OCWCP_PLUGIN_NAME')) {
  define('OCWCP_PLUGIN_NAME', 'Call for Price Woocommerce');
}
if (!defined('OCWCP_PLUGIN_VERSION')) {
  define('OCWCP_PLUGIN_VERSION', '1.0.0');
}
if (!defined('OCWCP_PLUGIN_FILE')) {
  define('OCWCP_PLUGIN_FILE', __FILE__);
}
if (!defined('OCWCP_PLUGIN_DIR')) {
  define('OCWCP_PLUGIN_DIR',plugins_url('', __FILE__));
}
if (!defined('OCWCP_BASE_NAME')) {
    define('OCWCP_BASE_NAME', plugin_basename(OCWCP_PLUGIN_FILE));
}
if (!defined('OCWCP_DOMAIN')) {
  define('OCWCP_DOMAIN', 'call-for-price-woocommerce');
}

//Main class
//Load required js,css and other files

if (!class_exists('OCWCP')) {

  class OCWCP {

    protected static $OCWCP_instance;

           /**
       * Constructor.
       *
       * @version 3.2.3
       */
      function __construct() {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        //check plugin activted or not
        add_action('admin_init', array($this, 'OCWCP_check_plugin_state'));
      }

    //Add JS and CSS on Backend
    function OCWCP_load_admin_script_style() {
      wp_enqueue_style( 'ocwcp_admin_css', OCWCP_PLUGIN_DIR . '/css/admin-ocwcp-style.css', false, '1.0.0' );
      wp_enqueue_script( 'ocwcp_admin_js', OCWCP_PLUGIN_DIR . '/js/admin-ocwcp-js.js', array( 'jquery', 'select2') );
      wp_localize_script( 'ajaxloadpost', 'ajax_postajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
      wp_enqueue_style( 'woocommerce_admin_styles-css', WP_PLUGIN_URL. '/woocommerce/assets/css/admin.css',false,'1.0',"all");
    }

    function OCWCP_show_notice() {

        if ( get_transient( get_current_user_id() . 'ocwcperror' ) ) {

          deactivate_plugins( plugin_basename( __FILE__ ) );

          delete_transient( get_current_user_id() . 'ocwcperror' );

          echo '<div class="error"><p> This plugin is deactivated because it require <a href="plugin-install.php?tab=search&s=woocommerce">WooCommerce</a> plugin installed and activated.</p></div>';

        }

    }

    function OCWCP_check_plugin_state(){
      if ( ! ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) ) {
        set_transient( get_current_user_id() . 'ocwcperror', 'message' );
      }
    }

    function init() {
      add_action( 'admin_notices', array($this, 'OCWCP_show_notice'));
      add_action('admin_enqueue_scripts', array($this, 'OCWCP_load_admin_script_style'));
      add_filter( 'plugin_row_meta', array( $this, 'OCWCP_plugin_row_meta' ), 10, 2 );
    }

    
    function OCWCP_plugin_row_meta( $links, $file ) {
      if ( OCWCP_BASE_NAME === $file ) {
          $row_meta = array(
            'rating'    =>  ' <a href="https://www.xeeshop.com/call-for-price-woocommerce" target="_blank">Documentation</a> | <a href="https://www.xeeshop.com/support-us/?utm_source=aj_plugin&utm_medium=plugin_support&utm_campaign=aj_support&utm_content=aj_wordpress" target="_blank">Support</a> | <a href="https://wordpress.org/support/plugin/call-for-price-woocommerce/reviews/?filter=5" target="_blank"><img src="'.OCWCP_PLUGIN_DIR.'/images/star.png" class="ocwcp_rating_div"></a>',
          );

          return array_merge( $links, $row_meta );
      }
      return (array) $links;
    }

    //Load all includes files
    function includes() {
      //Admn site Layout
      include_once('includes/ocwcp-backend.php');
      include_once('includes/ocwcp-kit.php');
      //Custom Functions
      include_once('includes/ocwcp-function.php');
      //Add Option backend on product page
      include_once('includes/ocwcp-admin-product.php');

    }

    //Plugin Rating
    public static function OCWCP_do_activation() {
      set_transient('ocwcp-first-rating', true, MONTH_IN_SECONDS);
    }

    public static function OCWCP_instance() {
      if (!isset(self::$OCWCP_instance)) {
        self::$OCWCP_instance = new self();
        self::$OCWCP_instance->init();
        self::$OCWCP_instance->includes();
      }
      return self::$OCWCP_instance;
    }

  }

  add_action('plugins_loaded', array('OCWCP', 'OCWCP_instance'));

  register_activation_hook(OCWCP_PLUGIN_FILE, array('OCWCP', 'OCWCP_do_activation'));
}

add_action( 'plugins_loaded', 'OCWCP_load_textdomain' );
function OCWCP_load_textdomain() {
    load_plugin_textdomain( 'call-for-price-woocommerce', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

function OCWCP_load_my_own_textdomain( $mofile, $domain ) {
    if ( 'call-for-price-woocommerce' === $domain && false !== strpos( $mofile, WP_LANG_DIR . '/plugins/' ) ) {
        $locale = apply_filters( 'plugin_locale', determine_locale(), $domain );
        $mofile = WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) . '/languages/' . $domain . '-' . $locale . '.mo';
    }
    return $mofile;
}
add_filter( 'load_textdomain_mofile', 'OCWCP_load_my_own_textdomain', 10, 2 );