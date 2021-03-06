<?php
/**
 * Single Event - Attendees
 *
 * @package single-event/attendees.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $event, $template_section, $inside_endpoint;

$count     = $template_section && isset( $template_section['count'] ) ? $template_section['count'] : 8;
$button    = $template_section && isset( $template_section['button'] ) && is_array( $template_section['button'] ) ? reset( $template_section['button'] ) : '';

if( $inside_endpoint && $inside_endpoint == 'attendees' ) {
	$count = 999;
	$button = 'yes';
}

$attendees = $event->get_attendees( $count );

?>
<div class="eem-event-section eem-attendees-style-1 eem-spacer bg-white">
    <div class="pb-container">

		<?php eem_print_event_section_heading(
			array(
				'heading'     => esc_html__( 'Attendees List', EEM_TD ),
				'sub_heading' => esc_html__( 'Who attend our Event', EEM_TD ),
				'short_desc'  => esc_html__( 'See the peoples are already reserved their seat and ready to attend this event', EEM_TD ),
			)
		); ?>

	    <?php
	    if ( empty( $attendees ) ) {
		    eem_print_event_notice( apply_filters( 'eem_filters_attendees_not_found_text',
			    esc_html__( 'No attendees are confirmed yet. We will announce latter. Stay close !', EEM_TD ) ), 'warning'
		    );
	    }
	    ?>

        <div class="pb-row pb-justify-content-center">
			<?php foreach ( $attendees as $attendee_email ) {

				$attendee      = get_user_by( 'email', $attendee_email );
				$attendee_url  = eem_get_user_profile_url( $attendee->ID );
				$attendee_img  = sprintf( '<div class="eem-attendees-img"><a href="%s">%s</a></div>', $attendee_url, get_avatar( $attendee_email ) );
				$attendee_name = sprintf( '<h3 class="eem-attendees-name"><a href="%s">%s</a></h3>', $attendee_url, $attendee->display_name );

				printf( '<div class="pb-col-md-6 pb-col-lg-3"><div class="eem-attendees-single">%s%s</div></div>', $attendee_img, $attendee_name );
			} ?>
        </div>

		<?php if ( ! empty( $attendees ) && $button !== 'yes' ) {
			eem_print_button( esc_html__( 'All Attendees', EEM_TD ), 'a', 'eem-btn eem-btn-large',
				$event->get_endpoint_url( 'attendees' ), '<div class="view-more text-center">%</div>' );
		} ?>

    </div>
</div>
