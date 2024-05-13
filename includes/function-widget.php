<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Widget.
 *
 * Elementor widget .
 *
 * @since 1.0.0
 */
 
class Elementor_Widget_Projets_WooCommerce extends \Elementor\Widget_Base {

    public function get_name() {
        return 'widget-projets-woocommerce';
    }

    public function get_title() {
        return __('Projets WooCommerce', 'widget-projets-woocommerce');
    }

    public function get_icon() {
        return 'fa fa-list-alt';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function _register_controls() {
        // Contrôles du widget (options)
    }

    protected function render() {
        $projects = wc_get_products(array(
            'status' => 'publish',
            'limit' => -1
        ));
		echo '<div class="gallery-slider">';
        // Afficher la liste des projets avec les métadonnées
        foreach ($projects as $project) {
			$product_id = $project->get_id();
			$product_name = $project->get_name();
			$product_description = $project->get_description();
			$product_budget = $project->get_meta('budget');
			$product_missions = $project->get_meta('missions');
			$image_id  = $project->get_image_id();
			$image_url = wp_get_attachment_image_url( $image_id, 'full' );
        
			?>
            	<div class="slider-img">
					<div class="slider-body">
						<h2>NOS RÉALISATIONS</h2>
						<p>
							<span class="sl-project"><?php echo esc_html($product_name); ?></span>
							<?php echo esc_html($product_description); ?> 
						</p>
						<p>
							<span class="sl-budget">Budget</span> 
							<?php echo esc_html($product_budget); ?>M€
						</p>
						<p>
							<span class="sl-mission">Missions</span> 
							<?php 
								$str_missions = esc_html($product_missions);
								echo str_replace(';', "<br>", $str_missions); 
							?>
						</p>
					</div>
					<div class="slider-image" style="background-image:linear-gradient(to right, rgba(60,161,70, 1) 3%, rgba(60,161,70, 0) 70%), url('<?php echo $image_url ; ?>')"></div>
				</div>
					
		<?php	
				
        }
		
		echo '</div>';
		echo '<button class="btn-action play"><i class="fa fa-play" aria-hidden="true"></i></button><button class="btn-action pause"><i class="fa fa-pause" aria-hidden="true"></i></button>';
    }
}
?>