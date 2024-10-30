jQuery(document).ready(function(){

    //slider setting options by tabbing
    jQuery('.ocwcp-container ul.tabs li').click(function(){
        var tab_id = jQuery(this).attr('data-tab');
        jQuery('.ocwcp-container ul.tabs li').removeClass('current');
        jQuery('.ocwcp-container .tab-content').removeClass('current');
        jQuery(this).addClass('current');
        jQuery("#"+tab_id).addClass('current');
    })

    /*singlr product page button setting code*/
    hidshow();
    jQuery('[name="ocwcp-button-enabled"]').change(function(){
    	hidshow();
    });

    jQuery('[name="ocwcp-allproduct-button-enabled"]').change(function(){
    	hidshow();
    });
    
    jQuery('[name="ocwcp-product-categories-enabled"]').change(function(){
        hidshow();
    });

    jQuery('[name="ocwcp-product-tags-enabled"]').change(function(){
        hidshow();
    });

    jQuery('[name="ocwcp-product-price-enabled"]').change(function(){
        hidshow();
    });
    


    function hidshow(){
        if(jQuery('[name="ocwcp-button-enabled"]').is(':checked') || jQuery('[name="ocwcp-allproduct-button-enabled"]').is(':checked') || jQuery('[name="ocwcp-product-categories-enabled"]').is(':checked') || jQuery('[name="ocwcp-product-tags-enabled"]').is(':checked')  || jQuery('[name="ocwcp-product-price-enabled"]').is(':checked')){
            jQuery(".single_product_setting").show();
        }else{
            jQuery(".single_product_setting").hide();
        }
    }



    /*link choices code*/
    jQuery('input[name="linkchoice"]').change(function(){
    	var radioValue = jQuery('input[name="linkchoice"]:checked').val();
        if(radioValue == "whatshapp"){
        	jQuery('input[name="whatshapp_link"]').show();
        }else {
        	jQuery('input[name="whatshapp_link"]').hide();
        }
        if(radioValue == "call"){
        	jQuery('input[name="call_link"]').show();
        }else {
        	jQuery('input[name="call_link"]').hide();
        }
        if(radioValue == "custom"){
        	jQuery('input[name="ocwcp-button-link-url"]').show();
        }else{
        	jQuery('input[name="ocwcp-button-link-url"]').hide();
        }
    });


    var radioValue = jQuery('input[name="linkchoice"]:checked').val();
    //alert(radioValue);
    if(radioValue == "whatshapp"){
        jQuery('input[name="whatshapp_link"]').show();
    }else {
        jQuery('input[name="whatshapp_link"]').hide();
    }
    if(radioValue == "call"){
        jQuery('input[name="call_link"]').show();
    }else {
        jQuery('input[name="call_link"]').hide();
    }
    if(radioValue == "custom"){
        jQuery('input[name="ocwcp-button-link-url"]').show();
    }else{
        jQuery('input[name="ocwcp-button-link-url"]').hide();
    }

    if(jQuery(".ocwcp-button-link-enabled").is(":checked")){ 
        jQuery(".ocwcp-button-enabled").show();
    }else{
        jQuery(".ocwcp-button-enabled").hide();
    }
    jQuery(".ocwcp-button-link-enabled").click(function() {
        if(jQuery(this).is(":checked")) {
            jQuery(".ocwcp-button-enabled").fadeIn(300);
        } else {
            jQuery(".ocwcp-button-enabled").fadeOut(200);
        }
    });
    
    jQuery('#ocwcp_select_cats').select2({
        ajax: {
                url: ajaxurl,
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        action: 'ocwcp_select_cats_ajax'
                    };
                },
                processResults: function( data ) {
                var options = [];
                if ( data ) {
 
                    jQuery.each( data, function( index, text ) {
                        options.push( { id: text[0], text: text[1]  } );
                    });
 
                }
                return {
                    results: options
                };
            },
            cache: true
        },
        minimumInputLength: 0
    });

    jQuery('#ocwcp_select_tags').select2({
        ajax: {
                url: ajaxurl,
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        action: 'ocwcp_select_tags_ajax'
                    };
                },
                processResults: function( data ) {
                var options = [];
                if ( data ) {
 
                    jQuery.each( data, function( index, text ) {
                        options.push( { id: text[0], text: text[1]  } );
                    });
 
                }
                return {
                    results: options
                };
            },
            cache: true
        },
        minimumInputLength: 0
    });

})

