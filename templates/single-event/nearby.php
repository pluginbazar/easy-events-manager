<?php
/**
 * Single Event - Blog
 *
 * @package single-event/blog.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $event;

$nearby_facts = eem()->get_nearby_facts();

//echo '<pre>'; print_r( $nearby_facts ); echo '</pre>';

?>

<div <?php eem_print_event_section_classes( 'eem-event-section eem-nearby-style-1 eem-blog-style-1 bg-white eem-force-full-width eem-spacer' ); ?>>
    <div class="pb-container">

		<?php eem_print_event_section_heading(
			array(
				'heading'     => esc_html__( 'Exploring Nearby', EEM_TD ),
				'sub_heading' => esc_html__( 'Would like to know more', EEM_TD ),
				'short_desc'  => esc_html__( 'Have some great time at the event location. Here are some detailed information about nearby facts.', EEM_TD ),
			)
		); ?>

        <div class="pb-row eem-tab-panel">
            <div class="pb-col-md-6 tab-nav">

				<?php $index = 0;
				foreach ( $nearby_facts as $fact_id => $nearby ) {

					$index ++;

					$active = $index == 1 ? 'active' : '';
					$label  = isset( $nearby['label'] ) ? $nearby['label'] : '';
					$icon   = isset( $nearby['icon'] ) ? $nearby['icon'] : '';

					printf( '<div class="tab-nav-item %s" data-target="nearby-%s">%s<span>%s</span></div>', $active, $fact_id, $icon, $label );
				} ?>

            </div>

            <div class="pb-col-md-6 tab-content">
				<?php $index = 0;
				foreach ( $nearby_facts as $fact_id => $nearby ) {

					$index ++;

					$active  = $index == 1 ? 'active' : '';
					$label   = isset( $nearby['label'] ) ? $nearby['label'] : '';
					$icon    = isset( $nearby['icon'] ) ? $nearby['icon'] : '';
					$post_id = $event->get_meta( "_event_nearby_{$fact_id}" );

					printf( '<div class="tab-item-content %s nearby-%s">%s</div>', $active, $fact_id, eem_print_blog_post( $post_id, 'event_nearby', false ) );
				} ?>
            </div>

        </div>
    </div>
</div>