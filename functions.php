<?php
/**
 * woodmart-child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package woodmart-child
 */

add_action( 'wp_enqueue_scripts', 'woodmart_parent_theme_enqueue_styles' );

/**
 * Enqueue scripts and styles.
 */
function woodmart_parent_theme_enqueue_styles() {
	wp_enqueue_style( 'woodmart-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'woodmart-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'woodmart-style' )
	);
}


// SL Swiper
function register_w3_style() {
	
	wp_enqueue_style( 'w3-style',
		get_stylesheet_directory_uri() . '/assets/css/w3.css'
	);
	
	if(is_page('imarya-2020aril')){
		wp_enqueue_style( 'multiplejs-style','https://cdnjs.cloudflare.com/ajax/libs/multiple.js/0.0.1/multiple.min.css');
		wp_enqueue_script( 'multiplejs-script','https://cdnjs.cloudflare.com/ajax/libs/multiple.js/0.0.1/multiple.min.js',array(), '1.0.0', true );
		wp_enqueue_script( 'sl-script', get_stylesheet_directory_uri() . '/assets/js/sljs.js', array('slick-script'),'true');
	}

	if ( is_page( 'imarya-2' ) ) {
		wp_enqueue_style( 'slick-style',get_stylesheet_directory_uri() . '/assets/slick/slick.css');
		wp_enqueue_script( 'slick-script',get_stylesheet_directory_uri() . '/assets/slick/slick.min.js','true');
		wp_enqueue_script( 'sl-script', get_stylesheet_directory_uri() . '/assets/js/sljs.js', array('slick-script'),'true');
	}
}
add_action( 'wp_enqueue_scripts', 'register_w3_style' );

// SL Swiper end

require_once ABSPATH . "vendor/autoload.php";
define('GOOGLE_ANALYTIC_ID', 'UA-122527416-1');
define('GOOGLE_CLOUD_API', '');
# Should be Equal to the cronjob time
define("DEFAULT_TRANSIENT_EXPIRATION", ''); // set to 0 to invalidate transient data
$initialize = new \AMPLUS\Core\Initialize();

function custom_add_google_fonts() {
	wp_enqueue_style( 'custom-google-fonts', 'https://fonts.googleapis.com/css?family=Playfair+Display:400,700&display=swap', false );
}
// add_action( 'wp_enqueue_scripts', 'custom_add_google_fonts' );

function add_meta_tags() {
?>
	<meta name="google-site-verification" content="nW1c1__WUeZpdjo9V26SmgfF3qkt9duRA3quLYsV6a8" />
	
<?php
}
add_action('wp_head', 'add_meta_tags');


// Unregister these custom post types
if (!function_exists('remove_unused_theme_plugin_custom_post_types')) {
   function remove_unused_theme_plugin_custom_post_types()
   {
       $unused_custom_post_types = [

           'portfolio'
       ];

       foreach ($unused_custom_post_types as $cpt) {
           unregister_post_type($cpt);
       }
   }
}
add_action('init', 'remove_unused_theme_plugin_custom_post_types');

// Change WordPress' email sender's name
function change_wp_email_sender_name() {
	return 'Imarya';
}
add_filter('wp_mail_from_name', 'change_wp_email_sender_name');

// Change WordPress' email sender' address
function change_wp_email_sender_address() {
	return 'contact@imarya.com';
}
add_filter('wp_mail_from', 'change_wp_email_sender_address');


// Aelia Currency switcher plugins
/**
 * Uses a custom geolocation function to detect customer's location.
 * 
 * @param string country_code The country code passed by previous filters (if any).
 * @return string A country code, or an empty string if a country code was not passed
 * by WP Engine.
 */
add_filter('wc_aelia_ip2location_before_get_country_code', function($country_code) {
  // Return the country code detected by WP Engine, if it was set
  if(!empty($_SERVER['HTTP_GEOIP_COUNTRY_CODE'])) {
    $country_code = $_SERVER['HTTP_GEOIP_COUNTRY_CODE'];
  }
  return $country_code;
}, 10, 1);

// END Aelia Currency switcher plugins

// Use both redeem points and Coupon - Yith Points and Rewards
if ( ! function_exists( 'yith_ywpar_coupon_fix' ) && defined( 'YITH_YWPAR_PREMIUM' ) ) {
    add_filter( 'woocommerce_apply_with_individual_use_coupon', 'yith_ywpar_coupon_fix', 10, 2 );
    function yith_ywpar_coupon_fix( $bool, $the_coupon ) {
        if (  substr( $the_coupon->get_code(), 0, 6 ) === 'ywpar_' ) {
            $bool = true;
        }
        return $bool;
    }
}
// End Use both redeem points and Coupon

//google tag manager
add_action('wp_head','my_analytics', 20); 
  function my_analytics() {
?> 
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P5W72WZ');</script>
<!-- End Google Tag Manager -->


<?php
}

add_action('__before_header','tag_manager2', 20);
  function tag_manager2(){
?>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P5W72WZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php
} 


//google enhanced Ecommerce


add_action( 'woocommerce_thankyou', 'sl_transection_tracking' );
function sl_transection_tracking( $order_id ) {
    // GET the WC_Order object instance from, the Order ID
    $order = wc_get_order( $order_id );
    $order_key = $order->get_order_key();
    $transaction_id = $order->get_transaction_id(); // Doesn't always exist
    $transaction_id = $order_id; // (Or the order key or the transaction ID if it exist)
    ?>
<script>
window.dataLayer = window.dataLayer || [];
dataLayer.push({
   'transactionId': '<?php echo $transaction_id ?>',
   'transactionAffiliation': 'Imarya',
   'transactionTotal': <?php echo $order->get_total(); ?>,
   'transactionTax': <?php echo $order->get_total_tax(); ?>,
   'transactionShipping': <?php echo $order->get_shipping_total(); ?>,
   'transactionProducts': [<?php
    // LOOP START: Iterate through order items
        foreach( $order->get_items() as $item_id => $item ) :
            // Get an instance of the WC_Product object
            $product = $item->get_product();

            // Get the product categories for the product
            $categories = wp_get_post_terms( $item->get_product_id(), 'product_cat', array( 'fields' => 'names' ) );
            $category = reset($categories); // Keep only the first product category
    ?>{
       'sku': '<?php echo $item->get_id(); ?>',
       'name': '<?php echo $item->get_name(); ?>',
       'category': '<?php echo $category; ?>',
       'price': <?php echo wc_get_price_excluding_tax($product);?>,
       'quantity': <?php echo $item->get_quantity(); ?>},<?php
        endforeach; // LOOP END
    ?>]});
</script>
<?php
}
//end Google Enhanced Ecommerce 

//Packing list
/**
 * Filter the document table headers to add custom column headers
 *
 * @param array $table_headers Table column headers
 * @param int $order_id WC_Order id
 * @param string $document_type WC_PIP_Document type
 * @return array The updated table column headers
 */
function AddCustomHeaderToPackingList( $table_headers, $order_id, $type ) {
		// add custom columns for packing and pick lists
	if ( 'packing-list' === $type || 'pick-list' === $type ) {
// 		remove sku
 		unset( $table_headers['sku'] );
		
// 		add
		$table_headers['size'] = 'Size';
		$table_headers['image'] = 'Image';
        $table_headers['location'] = 'ProductID';
		unset( $table_headers['sku'] );
	}
	return $table_headers;
}
add_filter( 'wc_pip_document_table_headers', 'AddCustomHeaderToPackingList', 10, 3 );
/**
 * Filter the document table row cells to add custom column data
 *
 * @param string $table_row_cells The table row cells.
 * @param string $type WC_PIP_Document type
 * @param string $item_id Item id
 * @param array $item Item data
 * @param \WC_Product $product Product object
 * @param \WC_Order $order Order object
 * @return array The filtered table row cells.
 */
function AddCustomDataToPackingList( $table_row_cells, $document_type, $item_id, $item, $product, $order ) {
	// set custom column content for invoices
	if ( 'packing-list' === $document_type ) {
// 		remove sku
		unset( $table_row_cells['sku'] );
// 		add size
		$table_row_cells['size'] = $product->attribute_summary;
// 		add image
        $TheProductThumnail =  $product->id;
        $featured_img_url = get_the_post_thumbnail_url($TheProductThumnail); 
		$table_row_cells['image'] = "<img src='".$featured_img_url."' height='50px' width='50px'>";
// 		add atum location
		global $wpdb;
        $sl_atum_location = $wpdb->get_var( "
    		SELECT $wpdb->terms.name
            FROM $wpdb->terms
            INNER JOIN $wpdb->term_taxonomy ON $wpdb->terms.term_id = $wpdb->term_taxonomy.term_id 
            INNER JOIN $wpdb->term_relationships ON $wpdb->term_taxonomy.term_taxonomy_id = $wpdb->term_relationships.term_taxonomy_id
            WHERE $wpdb->term_relationships.object_id='".$TheProductThumnail."' AND $wpdb->term_taxonomy.taxonomy='atum_location';
    		
    		" );
    	if($sl_atum_location == ''){
    	    $sl_atum_location = 'NA';
    	}
		$table_row_cells['location'] = $sl_atum_location;
	}
	return $table_row_cells;
}
add_filter( 'wc_pip_document_table_row_cells', 'AddCustomDataToPackingList', 10, 6 );




/**
 * Change the order items sort order in documents in v3.0.2+
 *
 * @param string $sort_order_items_key The column key (such as 'sku', 'price', 'weight', etc.) to sort order items by
 * @param int $order_id The WC_Order id
 * @param string $document_type The type of document being viewed
 * @return string The filtered sort column key
 */
 function sv_wc_pip_document_sort_order_items_key( $sort_by, $order_id, $type ) {
	// sort order items in all document types by SKU.
	// note: uncomment this line and remove the `switch` statement below
	// $sort_by = 'sku';
	// sort order items depending on the document type
	switch ( $type ) {
		case 'invoice':
			$sort_by = 'price';
		break;
		case 'packing-list':
			$sort_by = 'location';
		break;
		case 'pick-list':
			$sort_by = 'sku';
		break;
	}
	return $sort_by;
 }
 add_filter( 'wc_pip_document_sort_order_items_key', 'sv_wc_pip_document_sort_order_items_key', 10, 3 );
 
 /**
 * Examples for adjusting whether packing / pick lists should sort products by category or not
 */ 
/**
 * Removes packing list / pick list sorting by category and
 *   outputs line items in alphabetical order
 */
add_filter( 'wc_pip_packing_list_group_items_by_category', '__return_false' );
/**
 * Example: Remove product grouping if an order is not yet paid. (WC 2.5+)
 * Only removes grouping for pick lists
 * Requires PIP 3.1.1+
 *
 * @param bool $group_items true if items should be grouped by category
 * @param int $order_id the ID for the document's order
 * @param string $document_type the type for the current document
 * @return bool
 */
function sv_wc_pip_packing_list_grouping( $group_items, $order_id, $document_type ) {
	// bail unless we're looking at a pick list
	if ( 'packing-list' !== $document_type ) {
		return $group_items;
	}
	$order = wc_get_order( $order_id );
	if ( ! $order->is_paid() ) {
		return false;
	}
	return $group_items;
}
add_filter( 'wc_pip_packing_list_group_items_by_category', 'sv_wc_pip_packing_list_grouping', 10, 3 );



function sv_wc_pip_display_quantity_in_red( $qty, $item ) {
    if($qty > 1){
        $qty = "<h3 style='color:red'>".$qty."</h3>";
    }
	return $qty;
}
add_filter( 'wc_pip_get_order_item_quantity', 'sv_wc_pip_display_quantity_in_red', 10, 2 );

function change_customer_note_color($customer_note, $order_id){
	
	$imarya_order_note_to_customer = '';
	$notes = wc_get_order_notes( array(
		'order_id' => $order_id,
		'type'     => 'customer', // use 'internal' for admin and system notes, empty for all
	) );
	
	//Show Imarya order note
	if ( $notes ) {
        foreach( $notes as $key => $note ) {
            // system notes can be identified by $note->added_by == 'system'
            //printf( '<div style="color:red;" class="note_content">%s</div>', wpautop( wptexturize( wp_kses_post( make_clickable( $note->content ) ) ) ) );
			$imarya_order_note_to_customer = $imarya_order_note_to_customer . $note->content. "----";
        }
    }
	
	//Show customer note
    $customer_note = "<div style='color: red;'><div style='width: 38%; float: left;'><h4 style='color: red;'>Customer Note:</h4>". $customer_note ."</div><div style='width: 40%;float: left;'><h4 style='color: red;'>Order Note:</h4>". $imarya_order_note_to_customer ."</div></div>";
	

	
    return $customer_note;
}
add_filter( 'wc_pip_document_customer_note', 'change_customer_note_color',10,2);


//packing list end

// Add Current year to footer copyright
function footer_current_year_shortcode() {
    $year = date('Y');
    return $year;
}
add_shortcode('footer_current_year', 'footer_current_year_shortcode');

//admin bar customize
add_action('admin_head', 'sl_custom_style');
function sl_custom_style() {
  echo '<style>
  .overlay{
  display: none !important;
  }
  #wpadminbar{
	height: auto;
  }
  </style>';
}
function remove_toolbar_items($wp_adminbar) {
	$wp_adminbar->remove_node('wp-logo');
  	$wp_adminbar->remove_node('theme-dashboard');
	$wp_adminbar->remove_node('stats');
	$wp_adminbar->remove_node('new-content');
	$wp_adminbar->remove_node('new_draft');
  	$wp_adminbar->remove_node('updates');
  	$wp_adminbar->remove_node('comments');
  	$wp_adminbar->remove_node('search');
  	$wp_adminbar->remove_node('notes');
	
}
add_action('admin_bar_menu', 'remove_toolbar_items', 999);


//end admin bar customize



//Plugin WooCommerce Shipment Tracking
add_filter( 'wc_shipment_tracking_get_providers', 'custom_shipment_tracking' );

function custom_shipment_tracking( $providers ) {

    unset($providers['Australia']);
    unset($providers['Austria']);
    unset($providers['Brazil']);
    unset($providers['Belgium']);
    unset($providers['Czech Republic']);
    unset($providers['Finland']);
    unset($providers['France']);
    unset($providers['Germany']);
    unset($providers['Ireland']);
    unset($providers['Italy']);
    unset($providers['India']);
    unset($providers['Netherlands']);
    unset($providers['Poland']);
    unset($providers['Romania']);
    unset($providers['South African']);
    unset($providers['Sweden']);
    unset($providers['New Zealand']);
    unset($providers['United Kingdom']);
    unset($providers['United States']['Fedex']);
    unset($providers['United States']['Fedex Sameday']);
    unset($providers['United States']['USPS']);
    unset($providers['United States']['OnTrac']);
    unset($providers['United States']['DHL US']);

    return $providers;
}

add_filter( 'woocommerce_shipment_tracking_default_provider', 'custom_woocommerce_shipment_tracking_default_provider' );

function custom_woocommerce_shipment_tracking_default_provider( $provider ) {
	$provider = 'canada post'; // Replace this with the name of the provider. See line 42 in the plugin for the full list.

	return $provider;
}
//Plugin WooCommerce Shipment Tracking

//SL Shortcode

/*
 * List WooCommerce Products by tags
 *
 * ex: [show_woo_products_by_tags tags="shoes,socks"]
 */
function woo_products_by_tags_shortcode( $atts, $content = null ) {
  
	// Get attribuets
	extract(shortcode_atts(array(
		"tags" => ''
	), $atts));
	
	ob_start();
	// Define Query Arguments
	$args = array( 
				'post_type' 	 => 'product', 
				'posts_per_page' => 5, 
				'product_tag' 	 => $tags 
				);
	
	// Create the new query
	$loop = new WP_Query( $args );
	
	// Get products number
	$product_count = $loop->post_count;
	
	// If results
	if( $product_count > 0 ) :
	
		echo '<ul class="products">';
		
			// Start the loop
			while ( $loop->have_posts() ) : $loop->the_post(); global $product;
			
				global $post;
				
				echo "<p>" . $thePostID = $post->post_title. " </p>";
				
				if (has_post_thumbnail( $loop->post->ID )) 
					echo  get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); 
				else 
					echo '<img src="'.$woocommerce->plugin_url().'/assets/images/placeholder.png" alt="" width="'.$woocommerce->get_image_size('shop_catalog_image_width').'px" height="'.$woocommerce->get_image_size('shop_catalog_image_height').'px" />';
		
			endwhile;
		
		echo '</ul><!--/.products-->';
	
	else :
	
		_e('No product matching your criteria.');
	
	endif; // endif $product_count > 0
	
	return ob_get_clean();
}
add_shortcode("show_woo_products_by_tags", "woo_products_by_tags_shortcode");

// End SL shortcode

// Query Monitor error fix
add_filter( 'https_ssl_verify', '__return_true', PHP_INT_MAX );
 
add_filter( 'http_request_args', 'http_request_force_ssl_verify', PHP_INT_MAX );
 
function http_request_force_ssl_verify( $args ) {
 
        $args['sslverify'] = true;
 
        return $args;
}
 


add_action( 'woocommerce_no_products_found', 'show_featured_products_on_no_products_found', 1 );
function show_featured_products_on_no_products_found() {
	echo '<p class="product-not-found">' . esc_html__( 'No products were found matching your selection.', 'woocommerce' ) . '</p>';
}

// Yith Points and Rewards
if( !function_exists('ywcpar_remove_notice_classes')){
add_filter('yith_par_messages_class', 'ywcpar_remove_notice_classes' ,10 , 1 );
 function ywcpar_remove_notice_classes( $classes ){
  $classes = array(
    'woocommerce-cart-notice-minimum-amount',
    'woocommerce-notice',
    'woocommerce-cart-notice'
  );
  return $classes;
 }
}
