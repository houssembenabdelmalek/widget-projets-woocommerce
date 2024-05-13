<?php

class General_Widget_Projets_WooCommerc {

    public function __construct() {
		add_action('woocommerce_product_options_general_product_data', array($this, 'woo_metadonnees_produit_woocommerce' ));
        add_action('woocommerce_admin_process_product_object', array($this, 'ajouter_metadonnees_produit_woocommerce'));
		add_action('wp_enqueue_scripts', array($this, 'theme_enqueue_scripts') );
		
    }
	
	/**
	 * Notice if Elementor or WooCommerce is not active
	*/
	function widget_projets_wooCommerce_missing_notice() {
		?>
		<div class="notice notice-error">
			<p><?php esc_html_e('Widget Projets WooCommerce requires both Elementor and WooCommerce to be activated.', 'widget-projets-woocommerce'); ?></p>
		</div>
		<?php
	}
	
	/**
	 * Ajouter des métadonnées personnalisées (Budget et Missions) à un produit WooCommerce
	 */
	function woo_metadonnees_produit_woocommerce() {
		global $woocommerce, $post;
		// Text Field
		woocommerce_wp_text_input(
			array(
				'id' => 'budget',
				'label' => __( 'Budget', 'woocommerce' ),
				'placeholder' => 'Budget',
				'desc_tip' => 'true',
				'description' => __( 'Budget...', 'woocommerce' )
			)
		);
		woocommerce_wp_textarea_input(
			array(
				'id' => 'missions',
				'label' => __( 'Missions', 'woocommerce' ),
				'placeholder' => 'Listez vos missions séparées par des ; ',
				'desc_tip' => 'true',
				'description' => __( 'Listez vos missions séparées par des ; ', 'woocommerce' )
			)
		);

	}
	function ajouter_metadonnees_produit_woocommerce( $product ) {
		
		// Vérifie si le champ Budget est présent dans la requête POST
		if ( isset( $_POST['budget'] ) ) {
			// Mettre à jour la valeur de la métadonnée du budget pour le produit
			$product->update_meta_data('budget', sanitize_text_field( $_POST['budget'] ) );
		}

		// Vérifie si le champ Missions est présent dans la requête POST
		if ( isset( $_POST['missions'] ) ) {
			// Mettre à jour la valeur de la métadonnée des missions pour le produit
			$product->update_meta_data('missions', esc_html( $_POST['missions'] ) );
		}
	}
	function theme_enqueue_scripts() {
    	// Enqueue slider CSS
    	wp_enqueue_style( 'slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1');
		// Enqueue slider JavaScript
    	wp_enqueue_script( 'slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true);
		//Enqueue my custom JavaScript
		wp_enqueue_script('widget-projets-wooCommerc-js', plugin_dir_url(__FILE__).'../js/main.js', array(), '1.0.0', 'all');
		// Enqueue my CSS
		wp_enqueue_style('widget-projets-wooCommerc-css', plugin_dir_url(__FILE__).'../css/styles.css', array(), '1.0.12', 'all');
	}

	
	
}

