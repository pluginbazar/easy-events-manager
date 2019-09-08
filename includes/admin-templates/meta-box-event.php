<?php
/**
 * EEM - Admin Templates - Event Meta Box
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

$event = eem_get_event();

?>
<div class="eem-tab-panel">

    <div class="tab-nav">
        <div class="tab-nav-item" data-target="general-info"><?php esc_html_e( 'General Info', EEM_TD ); ?></div>
        <div class="tab-nav-item" data-target="speakers"><?php esc_html_e( 'Speakers', EEM_TD ); ?></div>
        <div class="tab-nav-item active" data-target="schedules"><?php esc_html_e( 'Schedules', EEM_TD ); ?></div>
        <div class="tab-nav-item" data-target="guests"><?php esc_html_e( 'Guests', EEM_TD ); ?></div>
    </div>

    <div class="tab-content">

        <div class="tab-item-content general-info">
			<?php eem()->PB()->generate_fields( $this->get_meta_fields( 'general-info' ), $post->ID ); ?>
        </div>

        <div class="tab-item-content speakers">
            Speakers
        </div>

        <div class="tab-item-content schedules active">

            <div class="button eem-add-day"><?php esc_html_e( 'Add Day', EEM_TD ); ?></div>

            <div class="eem-side-nav-container">

                <div class="eem-side-nav">
					<?php
					$index = 0;
                    foreach ( $event->get_meta( '_event_schedules', array() ) as $schedule ) {
						eem_print_event_schedule_day_nav( array_merge( array( 'index' => $index ), $schedule ) );
						$index++;
					} ?>
                </div>

                <div class="eem-side-nav-content">
	                <?php
                    $index = 0;
                    foreach ( $event->get_meta( '_event_schedules', array() ) as $schedule ) {
		                eem_print_event_schedule_day_content( array_merge( array( 'index' => $index ), $schedule ) );
		                $index++;
	                } ?>
                </div>

            </div>


        </div>

        <div class="tab-item-content guests">
            Guests
        </div>

    </div>

</div>
