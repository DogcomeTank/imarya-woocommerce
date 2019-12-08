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

function register_w3_style() {
  if ( is_page( 'home-page-v3' ) ) {
    wp_enqueue_style( 'w3-style',
		get_stylesheet_directory_uri() . '/w3.css'
	);
  }
}
add_action( 'wp_enqueue_scripts', 'register_w3_style' );

require_once ABSPATH . "vendor/autoload.php";
define('GOOGLE_ANALYTIC_ID', 'UA-122527416-1');
define('GOOGLE_CLOUD_API', '');
# Should be Equal to the cronjob time
define("DEFAULT_TRANSIENT_EXPIRATION", ''); // set to 0 to invalidate transient data
$initialize = new \AMPLUS\Core\Initialize();

function custom_add_google_fonts() {
	wp_enqueue_style( 'custom-google-fonts', 'https://fonts.googleapis.com/css?family=Playfair+Display:400,700&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'custom_add_google_fonts' );

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
           'woodmart_slide',
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

// Image Grid
add_shortcode('img_grid_block', 'imageGridBlock');

function imageGridBlock($atts = array())
{
	extract(shortcode_atts( array(
		"id" => 10027,
	), $atts));

	ob_start(); ?>
		<div class="amplus-img-grid-block products woocommerce row categories-style-masonry-first categories-masonry woodmart-spacing-20 columns-4">
			<div class="col-6 col-sm-4 col-md-6 col-lg-6 category-grid-item cat-design-default categories-with-shadow product-category product">
				<div class="wrapp-category">
					<div class="category-image-wrapp">
						<a href="<?= get_field('grid_1_url', $id) ?>" class="category-image">
							<img src="<?= get_field('grid_1_image', $id)['url'] ?>" alt="<?= get_field('grid_1_image', $id)['alt'] ?>">
						</a>
					</div>
					<div class="hover-mask">
						<h3 class="category-title"><?= get_field('grid_1_title', $id); ?></h3>
					</div>
					<a href="<?= get_field('grid_1_url', $id) ?>" class="category-link"></a>
				</div>
			</div>
			<div class="col-6 col-sm-4 col-md-3 col-lg-3 category-grid-item cat-design-default categories-with-shadow product-category product">
				<div class="wrapp-category">
					<div class="category-image-wrapp">
						<a href="<?= get_field('grid_2_url', $id) ?>" class="category-image">
							<img src="<?= get_field('grid_2_image', $id)['url'] ?>" alt="<?= get_field('grid_2_image', $id)['alt'] ?>">
						</a>
					</div>
					<div class="hover-mask">
						<h3 class="category-title"><?= get_field('grid_2_title', $id); ?></h3>
					</div>
					<a href="<?= get_field('grid_2_url', $id) ?>" class="category-link"></a>
				</div>
			</div>
			<div class="col-6 col-sm-4 col-md-3 col-lg-3 category-grid-item cat-design-default categories-with-shadow product-category product">
				<div class="wrapp-category">
					<div class="category-image-wrapp">
						<a href="<?= get_field('grid_3_url', $id) ?>" class="category-image">
							<img src="<?= get_field('grid_3_image', $id)['url'] ?>" alt="<?= get_field('grid_3_image', $id)['alt'] ?>">
						</a>
					</div>
					<div class="hover-mask">
						<h3 class="category-title"><?= get_field('grid_3_title', $id); ?></h3>
					</div>
					<a href="<?= get_field('grid_3_url', $id) ?>" class="category-link"></a>
				</div>
			</div>
			<div class="col-6 col-sm-4 col-md-3 col-lg-3 category-grid-item cat-design-default categories-with-shadow product-category product">
				<div class="wrapp-category">
					<div class="category-image-wrapp">
						<a href="<?= get_field('grid_4_url', $id) ?>" class="category-image">
							<img src="<?= get_field('grid_4_image', $id)['url'] ?>" alt="<?= get_field('grid_4_image', $id)['alt'] ?>">
						</a>
					</div>
					<div class="hover-mask">
						<h3 class="category-title"><?= get_field('grid_4_title', $id); ?></h3>
					</div>
					<a href="<?= get_field('grid_4_url', $id) ?>" class="category-link"></a>
				</div>
			</div>
			<div class="col-6 col-sm-4 col-md-3 col-lg-3 category-grid-item cat-design-default categories-with-shadow product-category product">
				<div class="wrapp-category">
					<div class="category-image-wrapp">
						<a href="<?= get_field('grid_5_url', $id) ?>" class="category-image">
							<img src="<?= get_field('grid_5_image', $id)['url'] ?>" alt="<?= get_field('grid_5_image', $id)['alt'] ?>">
						</a>
					</div>
					<div class="hover-mask">
						<h3 class="category-title"><?= get_field('grid_5_title', $id); ?></h3>
					</div>
					<a href="<?= get_field('grid_5_url', $id) ?>" class="category-link"></a>
				</div>
			</div>
		</div>
	<?php return ob_get_clean();
}

add_action('woocommerce_before_main_content', 'showImageGridRow', 1);

function showImageGridRow()
{
	$categories = [
		'collections',
	];

	$tags = [
		'age_0-24months',
		'age_10-years',
		'age_2-5-year',
		'age_3-years',
		'age_6-year',
		'age_7-years',
		'age_8-years',
		'age_9-years'
	];

	if (!is_product_category($categories) && !is_product_tag($tags)) return;
	echo do_shortcode('[img_grid_row id="10056" style="row"]');
	return;
}

add_shortcode('img_grid_row', 'imageGridRow');
function imageGridRow($atts = array())
{
	if (!is_product_category() && !is_product_tag()) return;

	global $wp_query;

	extract(shortcode_atts( array(
		"id" => 10056,
	), $atts));

	$query_object 		= $wp_query->get_queried_object();
	$shop_link 			= get_permalink( woocommerce_get_page_id('shop') );
	$urls				= buildImageGridUrls($query_object->taxonomy, $query_object->slug, $id);

	ob_start(); ?>

	<div class="amplus-img-grid-row">
		<div class="row">
			<div class="col">
				<a href="<?= $urls[0] ?>" class="category-image">
					<img src="<?= get_field('grid_1_image', $id)['url'] ?>" alt="<?= get_field('grid_1_image', $id)['alt'] ?>">
				</a>
			</div>
			<div class="col">
				<a href="<?= $urls[1] ?>" class="category-image">
					<img src="<?= get_field('grid_2_image', $id)['url'] ?>" alt="<?= get_field('grid_2_image', $id)['alt'] ?>">
				</a>
			</div>
			<div class="col">
				<a href="<?= $urls[2] ?>" class="category-image">
					<img src="<?= get_field('grid_3_image', $id)['url'] ?>" alt="<?= get_field('grid_3_image', $id)['alt'] ?>">
				</a>
			</div>
			<div class="col">
				<a href="<?= $urls[3] ?>" class="category-image">
					<img src="<?= get_field('grid_4_image', $id)['url'] ?>" alt="<?= get_field('grid_4_image', $id)['alt'] ?>">
				</a>
			</div>
			<div class="col">
				<a href="<?= $urls[4] ?>" class="category-image">
					<img src="<?= get_field('grid_5_image', $id)['url'] ?>" alt="<?= get_field('grid_5_image', $id)['alt'] ?>">
				</a>
			</div>
		</div>
	</div>

	<?php return ob_get_clean();
}

function buildImageGridUrls($query_taxonomy, $query_slug, $post_id)
{
	$urls				= [];
	$product_categories = [];
	$product_tags		= [];
	$shop_link			= get_permalink( woocommerce_get_page_id('shop') );

	$grid_taxonomies = [
		get_field('grid_1_taxonomy', $post_id),
		get_field('grid_2_taxonomy', $post_id),
		get_field('grid_3_taxonomy', $post_id),
		get_field('grid_4_taxonomy', $post_id),
		get_field('grid_5_taxonomy', $post_id)
	];

	$grid_slugs = [
		get_field('grid_1_slug', $post_id),
		get_field('grid_2_slug', $post_id),
		get_field('grid_3_slug', $post_id),
		get_field('grid_4_slug', $post_id),
		get_field('grid_5_slug', $post_id)
	];

	// Create connection between grid taxonomies and slugs
	foreach($grid_taxonomies as $tax_key => $tax) {
		if ($tax === 'product_cat') {
			$category_keys[] = $tax_key;
		} else {
			$tag_keys[] = $tax_key;
		}
	}

	// Organize data
	foreach($grid_slugs as $slug_key => $slug) {
		if (in_array($slug_key, $category_keys)) {
			$product_categories[$slug_key][] = $slug;
		}

		if (in_array($slug_key, $tag_keys)) {
			$product_tags[$slug_key][] = $slug;
		}

		if ($query_taxonomy === 'product_cat') {
			$product_categories[$slug_key][] = $query_slug;
		} else {
			$product_tags[$slug_key][] = $query_slug;
		}
	}

	if ($query_taxonomy === 'product_cat') {
		foreach($product_categories as $key => $pc) {
			// if (!isset($product_tags[$key])) continue;
			if (isset($product_tags[$key])) {
				$product_tag = '&product_tag=' . implode(',', $product_tags[$key]);
			} else {
				$product_tag = '';
			}

			$urls[] = $shop_link . '?product_cat=' . implode(',', $pc) . $product_tag;
		}
	}

	if ($query_taxonomy === 'product_tag') {
		foreach($product_tags as $key => $pt) {
			// if (!isset($product_categories[$key])) continue;
			if (isset($product_categories[$key])) {
				$product_category = '&product_cat=' . implode(',', $product_categories[$key]);
			} else {
				$product_category = '';
			}

			$urls[] = $shop_link . '?product_tag=' . implode(',', $pt) . $product_category;
		}
	}

	return $urls;
}




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
//Google Enhanced Ecommerce end

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
		$table_headers['image'] = 'Image';
        $table_headers['location'] = 'ProductID';
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
        $TheProductThumnail =  $product->id;
        $featured_img_url = get_the_post_thumbnail_url($TheProductThumnail); 
		$table_row_cells['image'] = "<img src='".$featured_img_url."' height='50px' width='50px'>";
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

//Remove SKU from Packing List
/**
 * Filter the document table headers and row cells to remove column headers
 *
 * @param array $table_headers Table column headers
 * @param int $order_id WC_Order id
 * @param string $document_type WC_PIP_Document type
 * @return array The updated table column headers
 */
function sv_wc_pip_document_table_headers_remove_columns( $table_headers, $order_id, $type ) {
	// remove SKU columns on Packing List
	if ( 'packing-list' === $type && isset( $table_headers['sku'] ) ) {
		unset( $table_headers['sku'] );
	}
	return $table_headers;
}
add_filter( 'wc_pip_document_table_headers', 'sv_wc_pip_document_table_headers_remove_columns', 10, 3 );
/**
 * Filter the document table row cells to remove column data
 *
 * @param string $table_row_cells The table row cells.
 * @param string $type WC_PIP_Document type
 * @param string $item_id Item id
 * @param array $item Item data
 * @param \WC_Product $product Product object
 * @param \WC_Order $order Order object
 * @return array The filtered table row cells.
 */
function sv_wc_pip_document_table_row_cells_remove_columns( $table_row_cells, $type, $item_id, $item, $product, $order ) {
	// remove SKU columns on Packing List
	if ( 'packing-list' === $type && isset( $table_row_cells['sku'] ) ) {
		unset( $table_row_cells['sku'] );
	}
	return $table_row_cells;
}
add_filter( 'wc_pip_document_table_row_cells', 'sv_wc_pip_document_table_row_cells_remove_columns', 10, 6 );
//Remove SKU

function sv_wc_pip_display_quantity_in_red( $qty, $item ) {
    if($qty > 1){
        $qty = "<h3 style='color:red'>".$qty."</h3>";
    }
	return $qty;
}
add_filter( 'wc_pip_get_order_item_quantity', 'sv_wc_pip_display_quantity_in_red', 10, 2 );

function change_customer_note_color($customer_note){
    $customer_note = "<div style='color: red;'><h4 style='color: red;'>Customer Note:</h4>". $customer_note ."</div>";
    return $customer_note;
}
add_filter( 'wc_pip_document_customer_note', 'change_customer_note_color');


//packing list end

add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
  .icl_tm_wrap > .overlay{
      display: none !important;
  }
  </style>';
}




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



add_action( 'woocommerce_no_products_found', 'show_featured_products_on_no_products_found', 1 );
function show_featured_products_on_no_products_found() {
	echo '<p class="product-not-found">' . esc_html__( 'No products were found matching your selection.', 'woocommerce' ) . '</p>';
}
