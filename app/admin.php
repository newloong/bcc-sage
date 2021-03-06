<?php

namespace App;

/**
 * Theme customizer
 */
add_action(
	'customize_register', function ( \WP_Customize_Manager $wp_customize ) {
		// Add postMessage support
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->selective_refresh->add_partial(
			'blogname', [
				'selector'        => '.brand',
				'render_callback' => function () {
					bloginfo( 'name' );
				},
			]
		);
	}
);

/**
 * Customizer JS
 */
add_action(
	'customize_preview_init', function () {
		wp_enqueue_script( 'sage/customizer.js', asset_path( 'scripts/customizer.js' ), [ 'customize-preview' ], null, true );
	}
);

/**
 *  Adds a slider ID setting in the customizer "Homepage Settings" section
 */

add_action(
	'customize_register', function ( \WP_Customize_Manager $wp_customize ) {

		$wp_customize->add_setting(
			'slider_setting', [
				'default'    => '',
				'capability' => 'edit_theme_options',

			]
		);

		$wp_customize->add_control(
			'slider_id', [
				'label'    => __( 'Slider ID', 'bcc-sage' ),
				'section'  => 'static_front_page',
				'settings' => 'slider_setting',
			]
		);
	}
);

/**
 * Stores Post ID of 'Topics of Practice' in Homepage Settings
 */
add_action(
	'customize_register', function ( \WP_Customize_Manager $wp_customize ) {

		$wp_customize->add_setting(
			'topics_of_practice_setting', [
				'default'    => '',
				'capability' => 'edit_theme_options',

			]
		);

		$wp_customize->add_control(
			'topics_of_practice_id', [
				'label'    => __( 'Topics of Practice Post ID', 'bcc-sage' ),
				'section'  => 'static_front_page',
				'settings' => 'topics_of_practice_setting',
			]
		);
	}
);

/**
 * Stores Post ID of 'Projects' in Homepage Settings
 */
add_action(
	'customize_register', function ( \WP_Customize_Manager $wp_customize ) {

		$wp_customize->add_setting(
			'projects_setting', [
				'default'    => '',
				'capability' => 'edit_theme_options',

			]
		);

		$wp_customize->add_control(
			'projects_id', [
				'label'    => __( 'Projects Post ID', 'bcc-sage' ),
				'section'  => 'static_front_page',
				'settings' => 'projects_setting',
			]
		);
	}
);


/**
 * Grants landing page section and settings
 */
add_action(
	'customize_register', function ( \WP_Customize_Manager $wp_customize ) {

		$wp_customize->add_section(
			'grants_settings', [
				'title'       => __( 'Grant Page settings', 'bcc-sage' ),
				'priority'    => 150,
				'description' => 'Please enter the post ID of each parent page below. This populates the sections with the corresponding child pages.',
			]
		);

		$wp_customize->add_setting(
			'grants_closed_setting', [
				'default'    => '',
				'capability' => 'edit_theme_options',
			]
		);

		$wp_customize->add_control(
			'grants_closed_setting', [
				'label'    => __( 'Closed Opportunities post ID', 'bcc-sage' ),
				'section'  => 'grants_settings',
				'settings' => 'grants_closed_setting',
			]
		);

	}
);

/**
 * MegaWalker Nav Editor Fields
 * Create fields
 * Show columns
 * Save/Update fields
 * Update the Walker nav
 *
 * @return array
 */

if ( class_exists( '\\BCcampus\MegaWalker' ) ) {

	// Setup fields
	add_action(
		'wp_nav_menu_item_custom_fields', function ( $id, $item, $depth, $args ) {
			$fields = [
				'mm-megamenu'       => 'Activate MegaMenu',
				'mm-column-divider' => 'Column Divider',
				'mm-divider'        => 'Inline Divider',
				'mm-featured-image' => 'Featured Image',
				'mm-description'    => 'Description',
			];

			foreach ( $fields as $_key => $label ) :
				$key   = sprintf( 'menu-item-%s', $_key );
				$id    = sprintf( 'edit-%s-%s', $key, $item->ID );
				$name  = sprintf( '%s[%s]', $key, $item->ID );
				$value = get_post_meta( $item->ID, $key, true );
				$class = sprintf( 'field-%s', $_key );
				?>
			<p class="description description-wide <?php echo esc_attr( $class ) ?>">
				<label for="<?php echo esc_attr( $id ); ?>"><input
						type="checkbox" id="<?php echo esc_attr( $id ); ?>"
						name="<?php echo esc_attr( $name ); ?>"
						value="1" <?php echo ( $value == 1 ) ? 'checked="checked"' : ''; //@codingStandardsIgnoreLine ?> /><?php echo esc_attr( $label ); ?>
				</label>
			</p>
				<?php
		endforeach;

		}, 10, 4
	);

	// Create Columns
	add_filter(
		'manage_nav-menus_columns', function ( $columns ) {
			$fields = [
				'mm-megamenu'       => 'Activate MegaMenu',
				'mm-column-divider' => 'Column Divider',
				'mm-divider'        => 'Inline Divider',
				'mm-featured-image' => 'Featured Image',
				'mm-description'    => 'Description',
			];

			$columns = array_merge( $columns, $fields );

			return $columns;
		}, 99
	);

	// Save fields
	add_action(
		'wp_update_nav_menu_item', function ( $menu_id, $menu_item_db_id, $menu_item_args ) {
			if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
				return;
			}

			check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );

			$fields = [
				'mm-megamenu'       => 'Activate MegaMenu',
				'mm-column-divider' => 'Column Divider',
				'mm-divider'        => 'Inline Divider',
				'mm-featured-image' => 'Featured Image',
				'mm-description'    => 'Description',
			];

			foreach ( $fields as $_key => $label ) {
				$key = sprintf( 'menu-item-%s', $_key );

				// Sanitize.
				if ( ! empty( $_POST[ $key ][ $menu_item_db_id ] ) ) {
					// Do some checks here...
					$value = $_POST[ $key ][ $menu_item_db_id ];
				} else {
					$value = null;
				}

				// Update.
				if ( ! is_null( $value ) ) {
					update_post_meta( $menu_item_db_id, $key, $value );
				} else {
					delete_post_meta( $menu_item_db_id, $key );
				}
			}
		}, 10, 3
	);

	// Custom Walker for the Nav Menu Editor
	add_filter(
		'wp_edit_nav_menu_walker', function ( $walker ) {
			$walker = 'BCcampus\MegaWalkerEditor';

			return $walker;
		}, 99
	);
}

/**
 * we need pages to have excerpts
 */
add_post_type_support( 'page', 'excerpt' );
