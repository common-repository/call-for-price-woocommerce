<?php

if (!defined('ABSPATH'))
  exit;

if (!class_exists('OCWCP_admin_menu')) {

  class OCWCP_admin_menu {

    protected static $OCWCP_instance;
    /**
     * Registers ADL Post Slider post type.
     */

    function OCWCP_submenu_page() {
        add_menu_page( 'Woo Call Price', 'Woo Call Price', 'manage_options', 'woo-callprice',array($this, 'OCWCP_callback'));
    }

    function OCWCP_callback() {
    ?>    
        <div class="wrap">
            <h2><u>Woo Call Price</u></h2>
            <?php 
            	if(isset($_REQUEST['message'])){
		            if($_REQUEST['message'] == 'success'){ 
		            	?>
		                <div class="notice notice-success is-dismissible"> 
		                    <p><strong>Record updated successfully.</strong></p>
		                </div>
		            	<?php 
		            } 
		        }
            ?>
        </div>
        <div class="ocwcp-container">
            <form method="post" >
                <?php wp_nonce_field( 'ocwcp_nonce_action', 'ocwcp_nonce_field' ); ?>
                <ul class="tabs">
                    <li class="tab-link current" data-tab="ocwcp-tab-general"><?php echo __( 'General Settings', OCWCP_DOMAIN );?></li>
                    <li class="tab-link" data-tab="ocwcp-tab-other"><?php echo __( 'Other Settings', OCWCP_DOMAIN );?></li>
                </ul>
                <div id="ocwcp-tab-general" class="tab-content current">
                    <fieldset>
                        <div class="ocwcp-top">
                            <p class="ocwcp-heading"><?php echo __( 'Button Options (Read more)', OCWCP_DOMAIN );?></h2>
                            <p class="ocwcp-tips"><?php echo __( 'This Options work only when product have empty price.', OCWCP_DOMAIN );?></p>
                        </div>
                            <table class="form-table">
                                <tbody>
                                    <tr>
                                        <th>
                                            <label><?php echo __( 'Enable / Disable', 'call-for-price-woocommerce' );?></label>
                                        </th>
                                        <td>
                                            <?php
                                                $ocwcp_enabled_val = empty(get_option( 'ocwcp_enabled' )) ? 'no' : get_option( 'ocwcp_enabled' );
                                            ?>
                                            <input type="checkbox" name="ocwcp-enabled" value="yes" <?php if ($ocwcp_enabled_val == "yes") {echo 'checked="checked"';} ?>><strong><?php echo __( 'Enable/Disable This Plugin', OCWCP_DOMAIN ); ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label><?php echo __( 'Button Label', OCWCP_DOMAIN );?></label>
                                        </th>
                                        <td>
                                            <?php
                                                $ocwcp_all_button_enabled_val = empty(get_option( 'ocwcp_all_button_enabled' )) ? 'no' : get_option( 'ocwcp_all_button_enabled' );
                                            ?>
                                            <p><label><input type="checkbox" name="ocwcp-all-button-enabled" value="yes" <?php if ($ocwcp_all_button_enabled_val == "yes") {echo 'checked="checked"';} ?>><?php echo __( 'Enable/Disable Button Label', OCWCP_DOMAIN ); ?></label></p>
                                            <div class="ocwcp-space"></div>
                                            <input type="text" name="ocwcp-buttontxt" size="100" value="<?php echo empty(get_option( 'ocwcp_buttontxt' )) ? 'Call Price' : get_option( 'ocwcp_buttontxt' ); ?>">
                                            <p class="ocwcp-tips"><?php echo __( "Custom button Label (Note: if This Option not Enable Then Button Label is 'Call Price')", OCWCP_DOMAIN );?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label><?php echo __( 'Hide button', OCWCP_DOMAIN );?></label>
                                        </th>
                                        <td>
                                            <?php
                                                $ocwcp_hidebutton_enabled = empty(get_option( 'ocwcp_hidebutton_enabled' )) ? 'no' : get_option( 'ocwcp_hidebutton_enabled' );
                                            ?>
                                            <p><label><input type="checkbox" name="ocwcp-hidebutton-enabled" value="yes"  <?php if ($ocwcp_hidebutton_enabled == "yes") {echo 'checked="checked"';} ?>><?php echo __( 'Enable/Disable Hide Button', OCWCP_DOMAIN ); ?></label></p>
                                            <p class="ocwcp-tips"><?php echo __( 'Hide Empty price product on all product page (read more button) ', OCWCP_DOMAIN );?></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    </fieldset>
                </div>
                <div id="ocwcp-tab-other" class="tab-content">
                    <fieldset>
                        <div class="ocwcp-top">
                            <p class="ocwcp-heading"><?php echo __( 'All Type Product Button Options', OCWCP_DOMAIN );?></p>
                            <p class="ocwcp-tips"><?php echo __( 'This work for all product or selected product category,tags or price ranges.', OCWCP_DOMAIN );?></p>
                        </div>
                        <table class="form-table">
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <label><?php echo __( 'All Product Button Label', OCWCP_DOMAIN );?></label>
                                    </th>
                                    <td>
                                        <?php
                                            $ocwcp_allproduct_button_enabled_val = empty(get_option( 'ocwcp_allproduct_button_enabled' )) ? 'no' : get_option( 'ocwcp_allproduct_button_enabled' );
                                        ?>
                                        <p><label><input type="checkbox" name="ocwcp-allproduct-button-enabled" value="yes" <?php if ($ocwcp_allproduct_button_enabled_val == "yes") {echo 'checked="checked"';} ?>><?php echo __( 'Enable/Disable Button Label', OCWCP_DOMAIN ); ?></label></p>
                                        <p class="ocwcp-tips"><?php echo __( 'Changes All Product button Label on all product page(single product, cart, category)', OCWCP_DOMAIN );?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <label><?php echo __( 'Empty Price Button Label', OCWCP_DOMAIN );?></label>
                                    </th>
                                    <td>
                                        <?php
                                            $ocwcp_button_enabled_val = empty(get_option( 'ocwcp_button_enabled' )) ? 'no' : get_option( 'ocwcp_button_enabled' );
                                        ?>
                                        <p><label><input type="checkbox" name="ocwcp-button-enabled" value="yes" <?php if ($ocwcp_button_enabled_val == "yes") {echo 'checked="checked"';} ?>><?php echo __( 'Enable/Disable Button Label', OCWCP_DOMAIN ); ?></label></p>
                                        <p class="ocwcp-tips"><?php echo __( 'Changes Empty Price product Button Label on all product page(single product, cart, category)', OCWCP_DOMAIN );?></p>
                                    </td>
                                </tr>
                               
                                <tr>
                                    <th scope="row">
                                        <label><?php echo __( 'Product categories', OCWCP_DOMAIN );?></label>
                                    </th>
                                    <td>
                                        <?php
                                            $ocwcp_product_categories_enabled_val = empty(get_option( 'ocwcp_product_categories_enabled' )) ? 'no' : get_option( 'ocwcp_product_categories_enabled' );
                                        ?>
                                        <p>
                                            <label>
                                                <input type="checkbox" name="ocwcp-product-categories-enabled" value="yes" disabled><?php echo __( 'Enable/Disable Product Categories', OCWCP_DOMAIN ); ?>
                                            </label>
                                        </p>
                                        <div class="ocwcp-space"></div>
                                        <select id="ocwcp_select_cats" name="ocwcp-product-categories[]" multiple="multiple" style="width:60%;" disabled>
                                            <?php

                                                $appended_terms = get_option('ocwcp_product_categories');

                                                if( !empty($appended_terms) ) {
                                                    foreach( $appended_terms as $term_id ) {
                                                        $term_name = get_term( $term_id )->name;
                                                        $term_name = ( mb_strlen( $term_name ) > 50 ) ? mb_substr( $term_name, 0, 49 ) . '...' : $term_name;
                                                        echo '<option value="' . $term_id . '" selected="selected">' . $term_name . '</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <label class="ocwcp_pro_link">Only available in pro version <a href="https://www.xeeshop.com/product/call-for-price-woocommerce-pro/" target="_blank">link</a></label>
                                        <p class="ocwcp-tips"><?php echo __('Change Product button Label for Selected Category Products. This Option is work with only empty product price. (Note: Press and hold Ctrl Key and select more than one item from the list.)', OCWCP_DOMAIN );?></p>
                                        <p class="ocwcp-tips"><?php echo __('product Button Label on all product page(single product, cart, category)', OCWCP_DOMAIN );?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <label><?php echo __( 'Product Tags', OCWCP_DOMAIN );?></label>
                                    </th>
                                    <td>
                                        <?php
                                            $ocwcp_product_tags_enabled_val = empty(get_option( 'ocwcp_product_tags_enabled' )) ? 'no' : get_option( 'ocwcp_product_tags_enabled' );
                                        ?>
                                        <p>
                                            <label>
                                                <input type="checkbox" name="ocwcp-product-tags-enabled" value="yes" disabled><?php echo __( 'Enable/Disable Product Tags', OCWCP_DOMAIN ); ?>
                                            </label>
                                        </p>
                                        <div class="ocwcp-space"></div>
                                        <select id="ocwcp_select_tags" name="ocwcp-product-tags[]" multiple="multiple" style="width:60%;" disabled>
                                            <?php
                                                $appended_tags = get_option('ocwcp_product_tags');

                                                if( !empty($appended_tags) ) {
                                                    foreach( $appended_tags as $tag_id ) {
                                                        $tag_name = get_term( $tag_id )->name;
                                                        $tag_name = ( mb_strlen( $tag_name ) > 50 ) ? mb_substr( $tag_name, 0, 49 ) . '...' : $tag_name;
                                                        echo '<option value="' . $tag_id . '" selected="selected">' . $tag_name . '</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <label class="ocwcp_pro_link">Only available in pro version <a href="https://www.xeeshop.com/product/call-for-price-woocommerce-pro/" target="_blank">link</a></label>
                                        <p class="ocwcp-tips"><?php echo __( 'Change Product button Label for Selected Tags Products. This Option is work with only empty product price. (Note: Press and hold Ctrl Key and select more than one item from the list.)', OCWCP_DOMAIN );?></p>
                                        <p class="ocwcp-tips"><?php echo __('product Button Label on all product page(single product, cart, category)', OCWCP_DOMAIN );?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <label><?php echo __( 'Product Price Ranges', OCWCP_DOMAIN );?></label>
                                    </th>
                                    <td>
                                        <?php
                                            $ocwcp_product_price_enabled_val = empty(get_option( 'ocwcp_product_price_enabled' )) ? 'no' : get_option( 'ocwcp_product_price_enabled' );
                                        ?>
                                        <p>
                                            <label>
                                                <input type="checkbox" name="ocwcp-product-price-enabled" value="yes" <?php if ($ocwcp_product_price_enabled_val == "yes") {echo 'checked="checked"';} ?>><?php echo __( 'Enable/Disable Product Price', OCWCP_DOMAIN ); ?>
                                                <p class="ocwcp-tips"><?php echo __( 'Change Product button Label for all products in selected price range.', OCWCP_DOMAIN );?></p>
                                                <p class="ocwcp-tips"><?php echo __('product Button Label on all product page(single product, cart, category)', OCWCP_DOMAIN );?></p>
                                            </label>
                                        </p>
                                        <div class="ocwcp-product-rang">
                                            <ul>
                                                <li>
                                                    <p><label><?php echo __( 'Minimum Product Price', OCWCP_DOMAIN ); ?></label></p>
                                                    <div class="ocwcp-space"></div>
                                                    <input type="number" name="ocwcp-minimum-product-price" size="100" value="40" disabled>
                                                    <p class="ocwcp-tips"><?php echo __( 'Minimum Product Price', OCWCP_DOMAIN );?></p>
                                                </li>
                                                <li>
                                                    <p><label><?php echo __( 'Maximum Product Price', OCWCP_DOMAIN ); ?></label></p>
                                                    <div class="ocwcp-space"></div>
                                                    <input type="number" name="ocwcp-maximum-product-price" size="100" value="120" disabled>
                                                    <p class="ocwcp-tips"><?php echo __( 'Maximum Product Price', OCWCP_DOMAIN );?></p>
                                                </li>
                                                <label class="ocwcp_pro_link">Only available in pro version <a href="https://www.xeeshop.com/product/call-for-price-woocommerce-pro/" target="_blank">link</a></label>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="single_product_setting">
                            <h2>Enable/Disable Price Call in single product page</h2>
                            <table class="form-table">
                                <tbody>       
                                    <tr>
                                        <th scope="row">
                                            <label><?php echo __( 'Add Button Label On single Product Page', OCWCP_DOMAIN );?></label>
                                        </th>
                                        <td>
                                            <?php
                                                $ocwcp_button_link_enabled_val = empty(get_option( 'ocwcp_button_link_enabled' )) ? 'no' : get_option( 'ocwcp_button_link_enabled' );
                                            ?>
                                            <p><label><input type="checkbox" name="ocwcp-button-link-enabled" class="ocwcp-button-link-enabled" value="yes" <?php if ($ocwcp_button_link_enabled_val == "yes" || empty($ocwcp_button_link_enabled_val)) {echo 'checked="checked"';} ?>><?php echo __( 'Enable/Disable Button (On Single Product Page), Enable/Disable Button Link (On Single Product Page)', OCWCP_DOMAIN ); ?></label></p>
                                            <div class="ocwcp-button-enabled">
                                                <div class="ocwcp-linkchoice">
                                                    <input type="radio" name="linkchoice" value="whatshapp" <?php if(get_option( 'ocwcp_linkchoice' ) == "whatshapp"){ echo "checked"; } ?> >Whatshapp
                                                    <input type="radio" name="linkchoice" value="call" <?php if(get_option( 'ocwcp_linkchoice' ) == "call"){ echo "checked"; } ?>>Call
                                                    <input type="radio" name="linkchoice" value="custom" <?php if(get_option( 'ocwcp_linkchoice' ) == "custom" || empty(get_option( 'ocwcp_linkchoice' ))){ echo "checked"; } ?>>Custom link
                                                </div>
                                                <div class="ocwcp-linkchoice-input">
                                                    <input type="text" name="whatshapp_link" size="100" value="<?php echo get_option( 'ocwcp_whatshapp_link' ); ?>" placeholder="Enter whatshapp number" style="display: none;"> 
                                                    <input type="text" name="call_link" size="100" value="<?php echo get_option( 'ocwcp_call_link' ); ?>" style="display: none;"  placeholder="Enter Phone number" > 
                                                    <input type="text" name="ocwcp-button-link-url" size="100" value="<?php echo empty(get_option( 'ocwcp_button_link_url' )) ? '#' : get_option( 'ocwcp_button_link_url' ); ?>" style="display: none;"> 
                                                </div>
                                                <p class="ocwcp-tips"><?php echo __( "Add Custom Product link On single Product Page (Note: Default url is '#')", OCWCP_DOMAIN );?></p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                </div>
                <input type="hidden" name="action" value="ocwcp_save_option">
                <input type="submit" value="Save changes" name="submit" class="button-primary" id="ocwcp-btn-space">
            </form>  
        </div>
    <?php
    }

    // For multiple value
    function recursive_sanitize_text_field($array) {
        $new_arr = array();
        foreach ( $array as $key => $value ) {
            if ( is_array( $value ) ) {
                $value = recursive_sanitize_text_field($value);
            }
            else {
                $value = sanitize_text_field( $value );
                $new_arr[] = $value;
            }
        }
        return $new_arr;
    }

    function OCWCP_save_options(){
        if( current_user_can('administrator') ) { 
        	if(isset($_REQUEST['action'])){
		        if($_REQUEST['action'] == 'ocwcp_save_option'){
		            if(!isset( $_POST['ocwcp_nonce_field'] ) || !wp_verify_nonce( $_POST['ocwcp_nonce_field'], 'ocwcp_nonce_action' ) ){
		                print 'Sorry, your nonce did not verify.';
		                exit;
		            }else{
		                $ocwcp_enabled = (!empty(sanitize_text_field( $_REQUEST['ocwcp-enabled'] )))? sanitize_text_field( $_REQUEST['ocwcp-enabled'] ) : 'no';
		                $ocwcp_button_enabled = (!empty(sanitize_text_field( $_REQUEST['ocwcp-button-enabled'] )))? sanitize_text_field( $_REQUEST['ocwcp-button-enabled'] ) : 'no';
		                $ocwcp_hidebutton_enabled = (!empty(sanitize_text_field( $_REQUEST['ocwcp-hidebutton-enabled'] )))? sanitize_text_field( $_REQUEST['ocwcp-hidebutton-enabled'] ) : 'no';
		                $ocwcp_allproduct_button_enabled = (!empty(sanitize_text_field( $_REQUEST['ocwcp-allproduct-button-enabled'] )))? sanitize_text_field( $_REQUEST['ocwcp-allproduct-button-enabled'] ) : 'no';
		                $ocwcp_product_price_enabled = (!empty(sanitize_text_field( $_REQUEST['ocwcp-product-price-enabled'] )))? sanitize_text_field( $_REQUEST['ocwcp-product-price-enabled'] ) : 'no';
		                $ocwcp_button_link_enabled = (!empty(sanitize_text_field( $_REQUEST['ocwcp-button-link-enabled'] )))? sanitize_text_field( $_REQUEST['ocwcp-button-link-enabled'] ) : 'no';
		                $ocwcp_all_button_enabled = (!empty(sanitize_text_field(  $_REQUEST['ocwcp-all-button-enabled'] )))? sanitize_text_field(  $_REQUEST['ocwcp-all-button-enabled'] ) : 'no';
		                update_option('ocwcp_enabled',$ocwcp_enabled, 'yes');
		                update_option('ocwcp_button_enabled', $ocwcp_button_enabled, 'yes');
		                update_option('ocwcp_buttontxt', sanitize_text_field( $_REQUEST['ocwcp-buttontxt'] ), 'yes');
		                update_option('ocwcp_hidebutton_enabled', $ocwcp_hidebutton_enabled, 'yes');

		                update_option('ocwcp_linkchoice', sanitize_text_field(  $_REQUEST['linkchoice'] ), 'yes');
		                update_option('ocwcp_whatshapp_link', sanitize_text_field( $_REQUEST['whatshapp_link'] ), 'yes');
		                update_option('ocwcp_call_link', sanitize_text_field( $_REQUEST['call_link'] ), 'yes');
		                update_option('ocwcp_button_link_url', sanitize_text_field( $_REQUEST['ocwcp-button-link-url'] ), 'yes');

		                update_option('ocwcp_allproduct_button_enabled', $ocwcp_allproduct_button_enabled, 'yes');
		                update_option('ocwcp_product_price_enabled', $ocwcp_product_price_enabled, 'yes');
		                update_option('ocwcp_button_link_enabled', $ocwcp_button_link_enabled, 'yes');
		                
		                update_option('ocwcp_all_button_enabled', $ocwcp_all_button_enabled, 'yes');
		                wp_redirect( admin_url( 'admin.php?page=woo-callprice&message=success') ); exit;
		            }
		        }
		    }
        }
    }

    function init() {
        add_action( 'admin_menu',  array($this, 'OCWCP_submenu_page'));
        add_action( 'init',  array($this, 'OCWCP_save_options'));
        add_action( 'wp_ajax_nopriv_ocwcp_select_cats_ajax',array($this, 'ocwcp_cats_ajax') );
        add_action( 'wp_ajax_ocwcp_select_cats_ajax', array($this, 'ocwcp_cats_ajax') );
        add_action( 'wp_ajax_nopriv_ocwcp_select_tags_ajax',array($this, 'ocwcp_select_tags_ajax') );
        add_action( 'wp_ajax_ocwcp_select_tags_ajax', array($this, 'ocwcp_select_tags_ajax') );
    }

    public static function OCWCP_instance() {
      if (!isset(self::$OCWCP_instance)) {
        self::$OCWCP_instance = new self();
        self::$OCWCP_instance->init();
      }
      return self::$OCWCP_instance;
    }

  }

  OCWCP_admin_menu::OCWCP_instance();
}

