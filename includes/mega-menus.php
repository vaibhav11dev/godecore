<?php
/**
 * Vedanta Framework
 *
 * WARNING: This file is part of the ved Core Framework.
 * Do not edit the core files.
 * Add any modifications necessary under a child theme.
 *
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Dont duplicate me!
if ( ! class_exists( 'vedCoreFrontendWalker' ) ) {

	class VedCoreFrontendWalker extends Walker_Nav_Menu {

		/**
		 * @var string $menu_megamenu_status are we currently rendering a mega menu?
		 */
		private $menu_megamenu_status = "";

		/**
		 * @var string $menu_megamenu_width use full width mega menu?
		 */
		private $menu_megamenu_width = "";

		/**
		 * @var int $num_of_columns how many columns should the mega menu have?
		 */
		private $num_of_columns = 0;

		/**
		 * @var int $max_num_of_columns mega menu allow for 4 columns at max
		 */
		private $max_num_of_columns = 4;

		/**
		 * @var int $total_num_of_columns total number of columns for a single megamenu?
		 */
		private $total_num_of_columns = 0;

		/**
		 * @var int $num_of_rows number of rows in the mega menu
		 */
		private $num_of_rows = 1;

		/**
		 * @var array $submenu_matrix holds number of columns per row
		 */
		private $submenu_matrix = array();

		/**
		 * @var string $menu_megamenu_title should a colum title be displayed?
		 */
		private $menu_megamenu_title = '';

		/**
		 * @var string $menu_megamenu_widget_area should one column be a widget area?
		 */
		private $menu_megamenu_widget_area = '';

		/**
		 * @var string $menu_megamenu_icon does the item have an icon?
		 */
		private $menu_megamenu_icon = '';

		/**
		 * @var string $menu_megamenu_thumbnail does the item have a thumbnail?
		 */
		private $menu_megamenu_thumbnail = '';
                
                /**
		 * @var string $menu_megamenu_banner does the item have a banner?
		 */
		private $menu_megamenu_banner = '';

		/**
		 * @see Walker::start_lvl()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of page. Used for padding.
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );
			if ( $depth === 0 && $this->menu_megamenu_status == "enabled" ) {
				$output	 .= "\n{first_level}\n";
				$output	 .= "\n$indent<div class=\"ved-megamenu-holder\" >\n<ul class='ved-megamenu {megamenu_border}'>\n";
			} elseif ( $depth >= 2 && $this->menu_megamenu_status == "enabled" ) {
				$output .= "\n$indent<ul class=\"sub-menu deep-level\">\n";
			} else {
				$output .= "\n$indent<ul class=\"sub-menu\">\n";
			}
		}

		/**
		 * @see Walker::end_lvl()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of page. Used for padding.
		 */
		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent		 = str_repeat( "\t", $depth );
			$row_width	 = '';

			if ( $depth === 0 && $this->menu_megamenu_status == "enabled" ) {

				$output .= "\n</ul>\n</div>\n</div><!--/ved-megamenu-wrapper-->\n";

				if ( $this->total_num_of_columns < $this->max_num_of_columns ) {
					$col_span = " col-span-" . $this->total_num_of_columns;
				} else {
					$col_span = " col-span-" . $this->max_num_of_columns;
				}

				if ( $this->menu_megamenu_width == "fullwidth" ) {
					$col_span = " col-span-12";
				}

				$output = str_replace( "{first_level}", "<div class='ved-megamenu-wrapper columns-" . esc_attr($this->total_num_of_columns . $col_span ) . "  sub-menu'>", $output );
				if ( $this->total_num_of_columns > $this->max_num_of_columns ) {
					$output = str_replace( "{megamenu_border}", "ved-megamenu-border", $output );
				} else {
					$output = str_replace( "{megamenu_border}", "", $output );
				}

				foreach ( $this->submenu_matrix as $row => $columns ) {
					$layout_columns = 12 / $columns;

//					if ( $columns < $this->max_num_of_columns ) {
//						
//					}

					$output = str_replace( "{row_width_" . $row . "}", $row_width, $output );

					if ( ( $row - 1 ) * $this->max_num_of_columns + $columns < $this->total_num_of_columns ) {
						$output = str_replace( "{row_number_" . $row . "}", "ved-megamenu-row-columns-" . $columns . " ved-megamenu-border", $output );
					} else {
						$output = str_replace( "{row_number_" . $row . "}", "ved-megamenu-row-columns-" . $columns, $output );
					}
					$output = str_replace( "{current_row_" . $row . "}", "ved-megamenu-columns-" . $columns . " col-lg-" . $layout_columns . " col-md-" . $layout_columns . " col-sm-" . $layout_columns, $output );
				}
			} else {
				$output .= "$indent</ul>\n";
			}
		}

		/**
		 * @see Walker::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Menu item data object.
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param int $current_page Menu item ID.
		 * @param object $args
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $smof_data;
			$item_output	 = $class_columns	 = '';
			$indent		 = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			/* set some vars */
			if ( $depth === 0 ) {

				$this->menu_megamenu_status	 = get_post_meta( $item->ID, '_menu_item_ved_megamenu_status', true );
				$this->menu_megamenu_width	 = get_post_meta( $item->ID, '_menu_item_ved_megamenu_width', true );
				$allowed_columns		 = get_post_meta( $item->ID, '_menu_item_ved_megamenu_columns', true );
				if ( $allowed_columns != "auto" ) {
					$this->max_num_of_columns = $allowed_columns;
				}
				$this->num_of_columns		 = $this->total_num_of_columns	 = 0;
			}

			$this->menu_megamenu_title	 = get_post_meta( $item->ID, '_menu_item_ved_megamenu_title', true );
			$this->menu_megamenu_widgetarea	 = get_post_meta( $item->ID, '_menu_item_ved_megamenu_widgetarea', true );
                        $this->menu_megamenu_label	 = get_post_meta( $item->ID, '_menu_item_ved_megamenu_label', true );
			$this->menu_megamenu_icon	 = get_post_meta( $item->ID, '_menu_item_ved_megamenu_icon', true );
			//For MegaMenu thumbnail
            $ved_img_id			 = get_post_meta( $item->ID, '_menu_item_ved_megamenu_thumbnail', true );
			$this->menu_megamenu_thumbnail = '';
			if ( $ved_img_id ) {
				$ved_img_src			 = wp_get_attachment_image_src( $ved_img_id, 'full' );
				$this->menu_megamenu_thumbnail	 = $ved_img_src[ 0 ];
			}
			//For MegaMenu banner
			$ved_banner_img_id			 = get_post_meta( $item->ID, '_menu_item_ved_megamenu_banner', true );
			$this->menu_megamenu_banner = '';
			if ( $ved_banner_img_id ) {
				$ved_banner_img_src			 = wp_get_attachment_image_src( $ved_banner_img_id, 'full' );
				$this->menu_megamenu_banner	 = $ved_banner_img_src[ 0 ];
			}
			/* we are inside a mega menu */
			if ( $depth === 1 && $this->menu_megamenu_status == "enabled" ) {

				$this->num_of_columns ++;
				$this->total_num_of_columns ++;

				/* check if we need to start a new row */
				if ( $this->num_of_columns > $this->max_num_of_columns ) {
					$this->num_of_columns	 = 1;
					$this->num_of_rows ++;
					$output			 .= "\n</ul>\n<ul class=\"ved-megamenu ved-megamenu-row-" . esc_attr($this->num_of_rows) . " {row_number_" . $this->num_of_rows . "}\" {row_width_" . esc_attr($this->num_of_rows) . "}>\n";
				}

				$this->submenu_matrix[ $this->num_of_rows ] = $this->num_of_columns;

				if ( $this->max_num_of_columns < $this->num_of_columns ) {
					$this->max_num_of_columns = $this->num_of_columns;
				}

				$title = apply_filters( 'the_title', $item->title, $item->ID );

				if ( ! (
				( empty( $item->url ) || $item->url == "#" || $item->url == 'http://' ) &&
				$this->menu_megamenu_title == 'disabled'
				)
				) {
					$heading	 = do_shortcode( $title );
					$link		 = '';
					$link_closing	 = '';

					if ( ! empty( $item->url ) &&
					$item->url != "#" &&
					$item->url != 'http://'
					) {
						$link		 = '<a href="' . esc_url($item->url) . '">';
						$link_closing	 = '</a>';
					}

					/* check if we need to set an image */
					$title_enhance = '';
					if ( ! empty( $this->menu_megamenu_thumbnail ) ) {
						$title_enhance = '<span class="ved-megamenu-icon"><img src="' . esc_url($this->menu_megamenu_thumbnail) . '"></span>';
					} elseif ( ! empty( $this->menu_megamenu_icon ) ) {
						$title_enhance = '<span class="ved-megamenu-icon"><i class="fa ' . esc_attr(get_post_meta( $item->ID, '_menu_item_ved_megamenu_icon', true )) . '"></i></span>';
					} elseif ( $this->menu_megamenu_title == 'disabled' &&  $this->menu_megamenu_icon ) {
						$title_enhance = '<span class="ved-megamenu-bullet"></span>';
					}

					$heading = sprintf( '%s%s%s%s', $link, $title_enhance, $title, $link_closing );

					if ( ! empty( $this->menu_megamenu_banner ) ) {
						$item_output .= $link.'<img alt src="' . esc_url($this->menu_megamenu_banner) . '">'.$link_closing;
					} elseif ( $this->menu_megamenu_title != 'disabled' ) {
						$item_output .= "<h3 class='ved-megamenu-title'>" . $heading . "</h3>";
					} else {
						$item_output .= $heading;
					}
				}

				if ( $this->menu_megamenu_widgetarea &&
				is_active_sidebar( $this->menu_megamenu_widgetarea )
				) {
					$item_output .= '<div class="ved-megamenu-widgets-container second-level-widget">';
					ob_start();
					dynamic_sidebar( $this->menu_megamenu_widgetarea );

					$item_output .= ob_get_clean() . '</div>';
				}

				$class_columns = ' {current_row_' . $this->num_of_rows . '}';
			} else if ( $depth === 2 && $this->menu_megamenu_widgetarea && $this->menu_megamenu_status == "enabled" ) {

				if ( is_active_sidebar( $this->menu_megamenu_widgetarea ) ) {
					$item_output .= '<div class="ved-megamenu-widgets-container">';
					ob_start();
					dynamic_sidebar( $this->menu_megamenu_widgetarea );

					$item_output .= ob_get_clean() . '</div>';
				}
			} else {

				$atts		 = array();
				$atts[ 'title' ]	 = ! empty( $item->attr_title ) ? 'title="' . esc_attr( $item->attr_title ) . '"' : '';
				$atts[ 'target' ]	 = ! empty( $item->target ) ? 'target="' . esc_attr( $item->target ) . '"' : '';
				$atts[ 'rel' ]	 = ! empty( $item->xfn ) ? 'rel="' . esc_attr( $item->xfn ) . '"' : '';
				$atts[ 'url' ]	 = ! empty( $item->url ) ? 'href="' . esc_attr( $item->url ) . '"' : '';
				$attributes	 = implode( ' ', $atts );

				$item_output .= $args->before;
				/* check if we need to set an image */
				if ( $depth !== 0 && ! empty( $this->menu_megamenu_thumbnail ) && $this->menu_megamenu_status == "enabled" ) {
					$item_output .= '<a ' . $attributes . '><span class="ved-megamenu-bullet"></span>';
				} elseif ( $depth !== 0 && $this->menu_megamenu_icon && $this->menu_megamenu_status == "enabled" ) {
					$item_output .= '<a ' . $attributes . '><span class="ved-megamenu-bullet"></span>';
				} elseif ( ! empty( $this->menu_megamenu_thumbnail ) ) {
					$item_output .= '<a ' . $attributes . '><span class="ved-megamenu-icon"><img src="' . esc_url($this->menu_megamenu_thumbnail) . '"></span>';
				} elseif ( ! empty( $this->menu_megamenu_icon ) ) {
					$item_output .= '<a ' . $attributes . '><span class="ved-megamenu-icon text-menu-icon"><i class="fa ' . get_post_meta( $item->ID, '_menu_item_ved_megamenu_icon', true ) . '"></i></span>';
				} else {
					$item_output .= '<a ' . $attributes . '>';
				}

				if ( ! empty( $this->menu_megamenu_icon ) && $this->menu_megamenu_status == "enabled" ) {
					$item_output .= '<span class="menu-text">';
				}

				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

				if ( ! empty( $this->menu_megamenu_icon ) && $this->menu_megamenu_status == "enabled" ) {
					$item_output .= '</span>';
				}

                                if ( $this->menu_megamenu_label !== "none" ) {
					$item_output .= '<span class="ved-menu-label ved-menu-'. esc_attr($this->menu_megamenu_label) .'">'.esc_html($this->menu_megamenu_label).'</span>';
				}

				if ( $depth === 0 && $args->has_children ) {
					$item_output .= '</a>';
				} else {
					$item_output .= '</a>';
				}
				$item_output .= $args->after;
			}

			/* check if we need to apply a divider */
			if ( $this->menu_megamenu_status != "enabled" && ( ( strcasecmp( $item->attr_title, 'divider' ) == 0) ||
			( strcasecmp( $item->title, 'divider' ) == 0 ) )
			) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} else {

				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

				$class_names	 = $value		 = '';
				$classes	 = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[]	 = 'menu-item-' . $item->ID;

				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

				if ( $args->has_children ) {
					//For BootstrapMenu
					$class_names .= ' has-submenu';
				}

				if ( $depth === 0 && $args->has_children ) {
					if ( $this->menu_megamenu_status == "enabled" ) {
						$class_names .= ' ved-megamenu-menu';
						if ( $this->menu_megamenu_width == "fullwidth" ) {
							$class_names .= " ved-fullwidth";
						} else {
							$class_names .= " ved-columnwidth";
						}
					} else {
						$class_names .= ' ved-dropdown-menu';
					}
				}

				if ( $depth === 1 ) {
					if ( $this->menu_megamenu_status == "enabled" ) {
						$class_names .= ' ved-megamenu-submenu';
					} else {
						$class_names .= ' ved-dropdown-submenu';
					}
				}

				$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . $class_columns . '"' : '';

				$id	 = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
				$id	 = $id ? ' id="' . esc_attr( $id ) . '"' : '';

				$output .= $indent . '<li' . $id . $value . $class_names . '>';

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		}

		/**
		 * @see Walker::end_el()
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Page data object. Not used.
		 * @param int $depth Depth of page. Not Used.
		 */
		function end_el( &$output, $item, $depth = 0, $args = array() ) {
			$output .= "</li>\n";
		}

		/**
		 * Traverse elements to create list from elements.
		 *
		 * Display one element if the element doesn't have any children otherwise,
		 * display the element and its children. Will only traverse up to the max
		 * depth and no ignore elements under that depth.
		 *
		 * This method shouldn't be called directly, use the walk() method instead.
		 *
		 * @see Walker::start_el()
		 * @since 2.5.0
		 *
		 * @param object $element Data object
		 * @param array $children_elements List of elements to continue traversing.
		 * @param int $max_depth Max depth to traverse.
		 * @param int $depth Depth of current element.
		 * @param array $args
		 * @param string $output Passed by reference. Used to append additional content.
		 * @return null Null on failure with no changes to parameters.
		 */
		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			if ( ! $element )
				return;

			$id_field = $this->db_fields[ 'id' ];

			// Display this element.
			if ( is_object( $args[ 0 ] ) )
				$args[ 0 ]->has_children = ! empty( $children_elements[ $element->$id_field ] );

			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		/**
		 * Menu Fallback
		 * =============
		 * If this function is assigned to the wp_nav_menu's fallback_cb variable
		 * and a manu has not been assigned to the theme location in the WordPress
		 * menu manager the function with display nothing to a non-logged in user,
		 * and will add a link to the WordPress menu manager if logged in as an admin.
		 *
		 * @param array $args passed from the wp_nav_menu function.
		 *
		 */
		public static function fallback( $args ) {
			if ( current_user_can( 'manage_options' ) ) {

				extract( $args );

				$fb_output = null;

				return $fb_output;
			}
		}

	}

	// end vedCoreFrontendWalker() class
}

// Don't duplicate me!
if ( ! class_exists( 'vedCoreMegaMenus' ) ) {

	class vedCoreMegaMenus extends Walker_Nav_Menu {

		/**
		 * Starts the list before the elements are added.
		 *
		 * @see Walker_Nav_Menu::start_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 */
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			
		}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @see Walker_Nav_Menu::end_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 */
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			
		}

		/**
		 * Start the element output.
		 *
		 * @see Walker_Nav_Menu::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item   Menu item data object.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 * @param int    $id     Not used.
		 */
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $_wp_nav_menu_max_depth, $wp_registered_sidebars;
			$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

			ob_start();
			$item_id	 = esc_attr( $item->ID );
			$removed_args	 = array(
				'action',
				'customlink-tab',
				'edit-menu-item',
				'menu-item',
				'page-tab',
				'_wpnonce',
			);

			$original_title = '';
			if ( 'taxonomy' == $item->type ) {
				$original_title	 = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
				if ( is_wp_error( $original_title ) )
					$original_title	 = false;
			} elseif ( 'post_type' == $item->type ) {
				$original_object = get_post( $item->object_id );
				$original_title	 = get_the_title( $original_object->ID );
			}

			$classes = array(
				'menu-item menu-item-depth-' . $depth,
				'menu-item-' . esc_attr( $item->object ),
				'menu-item-edit-' . ( ( isset( $_GET[ 'edit-menu-item' ] ) && $item_id == $_GET[ 'edit-menu-item' ] ) ? 'active' : 'inactive'),
			);

			$title = $item->title;

			if ( ! empty( $item->_invalid ) ) {
				$classes[]	 = 'menu-item-invalid';
				/* translators: %s: title of menu item which is invalid */
				$title		 = sprintf( esc_html__( '%s (Invalid)', 'godecore' ), $item->title );
			} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
				$classes[]	 = 'pending';
				/* translators: %s: title of menu item in draft status */
				$title		 = sprintf( esc_html__( '%s (Pending)', 'godecore' ), $item->title );
			}

			$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

			$submenu_text	 = '';
			if ( 0 == $depth )
				$submenu_text	 = 'style="display: none;"';
			?>
			<li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo esc_attr(implode( ' ', $classes )); ?>">
				<dl class="menu-item-bar">
					<dt class="menu-item-handle">
			                        <span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo esc_attr($submenu_text); ?>><?php esc_html_e( 'sub item', 'godecore' ); ?></span></span>
			                        <span class="item-controls">
							<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
							<span class="item-order hide-if-js">
								<a href="<?php
								echo esc_url(wp_nonce_url(
								add_query_arg(
								array(
									'action'	 => 'move-up-menu-item',
									'menu-item'	 => $item_id,
								), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
								), 'move-menu_item'
								));
								?>" class="item-move-up"><abbr title="<?php esc_attr_e( 'Move up', 'godecore' ); ?>">&#8593;</abbr></a>
								|
								<a href="<?php
								echo esc_url(wp_nonce_url(
								add_query_arg(
								array(
									'action'	 => 'move-down-menu-item',
									'menu-item'	 => $item_id,
								), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
								), 'move-menu_item'
								));
								?>" class="item-move-down"><abbr title="<?php esc_attr_e( 'Move down', 'godecore' ); ?>">&#8595;</abbr></a>
							</span>
							<a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php esc_attr_e( 'Edit Menu Item', 'godecore' ); ?>" href="<?php echo ( isset( $_GET[ 'edit-menu-item' ] ) && $item_id == $_GET[ 'edit-menu-item' ] ) ? esc_url(admin_url( 'nav-menus.php' )) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, esc_url(admin_url( 'nav-menus.php#menu-item-settings-' . $item_id )) ) ); ?>"><?php esc_html_e( 'Edit Menu Item', 'godecore' ); ?></a>
			                        </span>
					</dt>
				</dl>

				<div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
					<?php if ( 'custom' == $item->type ) : ?>
						<p class="field-url description description-wide">
							<label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
								<?php esc_html_e( 'URL', 'godecore' ); ?><br />
				                                <input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
							</label>
						</p>
					<?php endif; ?>
					<p class="description description-thin">
			                        <label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Navigation Label', 'godecore' ); ?><br />
							<input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
			                        </label>
					</p>
					<p class="description description-thin">
			                        <label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Title Attribute', 'godecore' ); ?><br />
							<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
			                        </label>
					</p>
					<p class="field-link-target description">
			                        <label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
							<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
							<?php esc_html_e( 'Open link in a new window/tab', 'godecore' ); ?>
			                        </label>
					</p>
					<p class="field-css-classes description description-thin">
			                        <label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'CSS Classes (optional)', 'godecore' ); ?><br />
							<input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode( ' ', $item->classes ) ); ?>" />
			                        </label>
					</p>
					<p class="field-xfn description description-thin">
			                        <label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Link Relationship (XFN)', 'godecore' ); ?><br />
							<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
			                        </label>
					</p>
					<p class="field-description description description-wide">
			                        <label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Description', 'godecore' ); ?><br />
							<textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_textarea( $item->description ); ?></textarea>
							<span class="description"><?php esc_html_e( 'The description will be displayed in the menu if the current theme supports it.', 'godecore' ); ?></span>
			                        </label>
					</p>
					<div class="clear"></div>
					<div class="ved-mega-menu-options">
			                        <p class="field-megamenu-status description description-wide">
							<label for="edit-menu-item-megamenu-status-<?php echo esc_attr($item_id); ?>">
								<input type="checkbox" id="edit-menu-item-megamenu-status-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-megamenu-status" name="menu-item-ved-megamenu-status[<?php echo esc_attr($item_id); ?>]" value="enabled" <?php checked( $item->ved_megamenu_status, 'enabled' ); ?> />
								<strong><?php esc_html_e( 'Enable Vedanta Mega Menu', 'godecore' ); ?></strong>
							</label>
			                        </p>
			                        <p class="field-megamenu-width description description-wide">
							<label for="edit-menu-item-megamenu-width-<?php echo esc_attr($item_id); ?>">
								<input type="checkbox" id="edit-menu-item-megamenu-width-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-megamenu-width" name="menu-item-ved-megamenu-width[<?php echo esc_attr($item_id); ?>]" value="fullwidth" <?php checked( $item->ved_megamenu_width, 'fullwidth' ); ?> />
								<?php esc_html_e( 'Full Width Mega Menu', 'godecore' ); ?>
							</label>
			                        </p>
			                        <p class="field-megamenu-columns description description-wide">
							<label for="edit-menu-item-megamenu-columns-<?php echo esc_attr($item_id); ?>">
								<?php esc_html_e( 'Mega Menu Number of Columns', 'godecore' ); ?>
								<select id="edit-menu-item-megamenu-columns-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-megamenu-columns" name="menu-item-ved-megamenu-columns[<?php echo esc_attr($item_id); ?>]">
									<option value="auto" <?php selected( $item->ved_megamenu_columns, 'auto' ); ?>><?php esc_html_e( 'Auto', 'godecore' ); ?></option>
									<option value="1" <?php selected( $item->ved_megamenu_columns, '1' ); ?>>1</option>
									<option value="2" <?php selected( $item->ved_megamenu_columns, '2' ); ?>>2</option>
									<option value="3" <?php selected( $item->ved_megamenu_columns, '3' ); ?>>3</option>
									<option value="4" <?php selected( $item->ved_megamenu_columns, '4' ); ?>>4</option>
								</select>
							</label>
			                        </p>
			                        <p class="field-megamenu-title description description-wide">
							<label for="edit-menu-item-megamenu-title-<?php echo esc_attr($item_id); ?>">
								<input type="checkbox" id="edit-menu-item-megamenu-title-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-megamenu-title" name="menu-item-ved-megamenu-title[<?php echo esc_attr($item_id); ?>]" value="disabled" <?php checked( $item->ved_megamenu_title, 'disabled' ); ?> />
								<?php esc_html_e( 'Disable Mega Menu Column Title', 'godecore' ); ?>
							</label>
			                        </p>
			                        <p class="field-megamenu-widgetarea description description-wide">
							<label for="edit-menu-item-megamenu-widgetarea-<?php echo esc_attr($item_id); ?>">
								<?php esc_html_e( 'Mega Menu Widget Area', 'godecore' ); ?>
								<select id="edit-menu-item-megamenu-widgetarea-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-megamenu-widgetarea" name="menu-item-ved-megamenu-widgetarea[<?php echo esc_attr($item_id); ?>]">
									<option value="0"><?php esc_html_e( 'Select Widget Area', 'godecore' ); ?></option>
									<?php
									if ( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ):
										foreach ( $wp_registered_sidebars as $sidebar ):
											?>
                                                                        <option value="<?php echo esc_attr($sidebar[ 'id' ]); ?>" <?php selected( $item->ved_megamenu_widgetarea, $sidebar[ 'id' ] ); ?>><?php echo esc_attr($sidebar[ 'name' ]); ?></option>
											<?php
										endforeach;
									endif;
									?>
								</select>
							</label>
			                        </p>
                                                <p class="field-megamenu-columns description description-wide">
							<label for="edit-menu-item-megamenu-label-<?php echo esc_attr($item_id); ?>">
								<?php esc_html_e( 'Mega Menu Label', 'godecore' ); ?>
								<select id="edit-menu-item-megamenu-label-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-megamenu-label" name="menu-item-ved-megamenu-label[<?php echo esc_attr($item_id); ?>]">
									<option value="none" <?php selected( $item->ved_megamenu_label, 'none' ); ?>><?php esc_html_e( 'None', 'godecore' ); ?></option>
									<option value="new" <?php selected( $item->ved_megamenu_label, 'new' ); ?>><?php esc_html_e( 'New', 'godecore' ); ?></option>
									<option value="sale" <?php selected( $item->ved_megamenu_label, 'sale' ); ?>><?php esc_html_e( 'Sale', 'godecore' ); ?></option>
									<option value="hot" <?php selected( $item->ved_megamenu_label, 'hot' ); ?>><?php esc_html_e( 'Hot', 'godecore' ); ?></option>
								</select>
							</label>
			                        </p>
			                        <p class="field-megamenu-icon description description-wide">
							<label for="edit-menu-item-megamenu-icon-<?php echo esc_attr($item_id); ?>">
								<?php esc_html_e( 'Mega Menu Icon (use full font awesome or glyphicon name)', 'godecore' ); ?>
								<input type="text" id="edit-menu-item-megamenu-icon-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-megamenu-icon" name="menu-item-ved-megamenu-icon[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item->ved_megamenu_icon); ?>" />
							</label>
			                        </p>
			                        <!--set thumbnail-->
						<?php
						$ved_upload_link = esc_url( get_upload_iframe_src( 'image', $item_id ) );
						$ved_img_id	 = get_post_meta( $item_id, '_menu_item_ved_megamenu_thumbnail', true );
						$ved_img_src	 = wp_get_attachment_image_src( $ved_img_id, 'full' );
						$ved_have_img	 = is_array( $ved_img_src );
						?>
			                        <div id="thumbnail-custom-img-container-<?php echo esc_attr($item_id); ?>" class="custom-img-container">
							<?php if ( $ved_have_img ) : ?>
				                                <img src="<?php echo esc_url($ved_img_src[ 0 ]); ?>" class="ved-megamenu-thumbnail-image" style="width:30px; height:30px; display: inline;" />
							<?php endif; ?>
			                        </div>
			                        <p class="field-megamenu-thumbnail description description-wide hide-if-no-js">
							<a id="ved-media-thumbnail-upload-<?php echo esc_attr($item_id); ?>" data-media-id="<?php echo esc_attr($item_id); ?>" class="ved-open-media button button-primary ved-megamenu-upload-thumbnail upload-custom-img <?php
							if ( $ved_have_img ) {
								echo 'hidden';
							}
							?>" 
							   href="<?php echo esc_url($ved_upload_link) ?>">
								   <?php esc_html_e( 'Set Thumbnail', 'godecore' ) ?>
							</a>
							<a id="ved-media-thumbnail-remove-<?php echo esc_attr($item_id); ?>" data-media-id="<?php echo esc_attr($item_id); ?>" class="remove-ved-megamenu-thumbnail delete-custom-img <?php
							if ( ! $ved_have_img ) {
								echo 'hidden';
							}
							?>" 
							   href="#">
								   <?php esc_html_e( 'Remove image', 'godecore' ) ?>
							</a>
			                        </p>
			                        <input id="edit-menu-item-megamenu-thumbnail-<?php echo esc_attr($item_id); ?>" class="ved-new-media-image widefat code edit-menu-item-megamenu-thumbnail" name="menu-item-ved-megamenu-thumbnail[<?php echo esc_attr($item_id); ?>]" type="hidden" value="<?php echo esc_attr($ved_img_id); ?>" />

                                                <!--set MegaMenu Banner-->
						<?php
						$ved_banner_upload_link = esc_url( get_upload_iframe_src( 'image', $item_id ) );
						$ved_banner_img_id	 = get_post_meta( $item_id, '_menu_item_ved_megamenu_banner', true );
						$ved_banner_img_src	 = wp_get_attachment_image_src( $ved_banner_img_id, 'full' );
						$ved_have_banner_img	 = is_array( $ved_banner_img_src );
						?>
			                        <div id="banner-custom-img-container-<?php echo esc_attr($item_id); ?>" class="custom-img-container">
							<?php if ( $ved_have_banner_img ) : ?>
				                                <img src="<?php echo esc_url($ved_banner_img_src[ 0 ]); ?>" class="ved-megamenu-banner-image" style="width:30px; height:30px; display: inline;" />
							<?php endif; ?>
			                        </div>
			                        <p class="field-megamenu-banner description description-wide hide-if-no-js">
							<a id="ved-media-banner-upload-<?php echo esc_attr($item_id); ?>" data-media-id="<?php echo esc_attr($item_id); ?>" class="ved-open-media button button-primary ved-megamenu-upload-banner upload-custom-img <?php
							if ( $ved_have_banner_img ) {
								echo 'hidden';
							}
							?>" 
							   href="<?php echo esc_url($ved_banner_upload_link) ?>">
								   <?php esc_html_e( 'Set Banner', 'godecore' ) ?>
							</a>
							<a id="ved-media-banner-remove-<?php echo esc_attr($item_id); ?>" data-media-id="<?php echo esc_attr($item_id); ?>" class="remove-ved-megamenu-banner delete-custom-img <?php
							if ( ! $ved_have_banner_img ) {
								echo 'hidden';
							}
							?>" 
							   href="#">
								   <?php esc_html_e( 'Remove image', 'godecore' ) ?>
							</a>
			                        </p>
			                        <input id="edit-menu-item-megamenu-banner-<?php echo esc_attr($item_id); ?>" class="ved-new-media-image widefat code edit-menu-item-megamenu-banner" name="menu-item-ved-megamenu-banner[<?php echo esc_attr($item_id); ?>]" type="hidden" value="<?php echo esc_attr($ved_banner_img_id); ?>" />

                                                
					</div><!-- .ved-mega-menu-options-->
					<p class="field-move hide-if-no-js description description-wide">
			                        <label>
							<span><?php esc_html_e( 'Move', 'godecore' ); ?></span>
							<a href="#" class="menus-move-up"><?php esc_html_e( 'Up one', 'godecore' ); ?></a>
							<a href="#" class="menus-move-down"><?php esc_html_e( 'Down one', 'godecore' ); ?></a>
							<a href="#" class="menus-move-left"></a>
							<a href="#" class="menus-move-right"></a>
							<a href="#" class="menus-move-top"><?php esc_html_e( 'To the top', 'godecore' ); ?></a>
			                        </label>
					</p>

					<div class="menu-item-actions description-wide submitbox">
						<?php if ( 'custom' != $item->type && $original_title !== false ) : ?>
							<p class="link-to-original">
								<?php printf( esc_html__( 'Original: %s', 'godecore' ), '<a href="' . esc_url( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
							</p>
						<?php endif; ?>
			                        <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
						echo esc_url(wp_nonce_url(
						add_query_arg(
						array(
							'action'	 => 'delete-menu-item',
							'menu-item'	 => $item_id,
						), admin_url( 'nav-menus.php' )
						), 'delete-menu_item_' . $item_id
						));
						?>"><?php esc_html_e( 'Remove', 'godecore' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
						?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e( 'Cancel', 'godecore' ); ?></a>
					</div>

					<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
					<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
					<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
					<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
					<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
					<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
					<div class="clear"></div>        
				</div><!-- .menu-item-settings-->
				<ul class="menu-item-transport"></ul>
				<?php
				$output .= ob_get_clean();
			}

		}

		// end vedCoreMegaMenus() class
	}


// Don't duplicate me!
	if ( ! class_exists( 'vedMegaMenu' ) ) {

		/**
		 * Class to manipulate menus
		 *
		 * @since 3.4
		 */
		class vedMegaMenu extends vedMegaMenuFramework {

			function __construct() {

				add_action( 'wp_update_nav_menu_item', array( $this, 'save_custom_fields' ), 10, 3 );

				add_filter( 'wp_edit_nav_menu_walker', array( $this, 'add_custom_fields' ) );
				add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_data_to_menu' ) );
			}

// end __construct();

			/**
			 * Function to replace normal edit nav walker for ved core mega menus
			 *
			 * @return string Class name of new navwalker
			 */
			function add_custom_fields() {

				return 'vedCoreMegaMenus';
			}

			/**
			 * Add the custom fields menu item data to fields in database
			 *
			 * @return void
			 */
			function save_custom_fields( $menu_id, $menu_item_db_id, $args ) {

				$field_name_suffix = array( 'status', 'width', 'columns', 'title', 'widgetarea', 'label', 'icon', 'thumbnail', 'banner' );

				foreach ( $field_name_suffix as $key ) {
					if ( ! isset( $_REQUEST[ 'menu-item-ved-megamenu-' . $key ][ $menu_item_db_id ] ) ) {
						$_REQUEST[ 'menu-item-ved-megamenu-' . $key ][ $menu_item_db_id ] = '';
					}

					$value = sanitize_text_field($_REQUEST[ 'menu-item-ved-megamenu-' . $key ][ $menu_item_db_id ]);
					update_post_meta( $menu_item_db_id, '_menu_item_ved_megamenu_' . $key, $value );
				}
			}

			/**
			 * Add custom fields data to the menu
			 *
			 * @return object Add custom fields data to the menu object
			 */
			function add_data_to_menu( $menu_item ) {
				if ( isset( $menu_item->ID ) && $menu_item->ID != '' ) {
					$menu_item->ved_megamenu_status		 = get_post_meta( $menu_item->ID, '_menu_item_ved_megamenu_status', true );
					$menu_item->ved_megamenu_width		 = get_post_meta( $menu_item->ID, '_menu_item_ved_megamenu_width', true );
					$menu_item->ved_megamenu_columns	 = get_post_meta( $menu_item->ID, '_menu_item_ved_megamenu_columns', true );
					$menu_item->ved_megamenu_label           = get_post_meta( $menu_item->ID, '_menu_item_ved_megamenu_label', true );
					$menu_item->ved_megamenu_title		 = get_post_meta( $menu_item->ID, '_menu_item_ved_megamenu_title', true );
					$menu_item->ved_megamenu_widgetarea	 = get_post_meta( $menu_item->ID, '_menu_item_ved_megamenu_widgetarea', true );
					$menu_item->ved_megamenu_icon		 = get_post_meta( $menu_item->ID, '_menu_item_ved_megamenu_icon', true );
					$menu_item->ved_megamenu_thumbnail	 = get_post_meta( $menu_item->ID, '_menu_item_ved_megamenu_thumbnail', true );
					$menu_item->ved_megamenu_banner          = get_post_meta( $menu_item->ID, '_menu_item_ved_megamenu_banner', true );
				}
				return $menu_item;
			}

		}

		// end vedMegaMenu() class
	}

	function add_custom_js() {
		?>
	        <script>
			/*add mega-menu set-thumbnail js*/
			jQuery(document).ready(function ($) {

				var frame;
				jQuery('.ved-megamenu-upload-thumbnail').on('click', function (event) {

					event.preventDefault();
					var item_id = jQuery(this).attr('data-media-id');

					frame = wp.media({
						title: 'Select or Upload Media Of Your mega menu thumbnail',
						button: {
							text: 'Use this image'
						},
						multiple: false,
						//item_id: jQuery(this).attr('data-media-id')
					});

					frame.on('select', function () {

						//item_id = frame.options.item_id;

						var attachment = frame.state().get('selection').first().toJSON();

						jQuery('#thumbnail-custom-img-container-' + item_id).append('<img src="' + attachment.url + '" alt="' + attachment.name + '" class="ved-megamenu-thumbnail-image" style="width:30px; height:30px; display:inline;"/>');

						jQuery('#edit-menu-item-megamenu-thumbnail-' + item_id).val(attachment.id);
						jQuery('#ved-media-thumbnail-upload-' + item_id).addClass('hidden');
						jQuery('#ved-media-thumbnail-remove-' + item_id).removeClass('hidden');
					});

					frame.open();
				});
                                
                                jQuery('.ved-megamenu-upload-banner').on('click', function (event) {

					event.preventDefault();
					var item_id = jQuery(this).attr('data-media-id');

					frame = wp.media({
						title: 'Select or Upload Media Of Your mega menu thumbnail',
						button: {
							text: 'Use this image'
						},
						multiple: false,
						//item_id: jQuery(this).attr('data-media-id')
					});

					frame.on('select', function () {

						//item_id = frame.options.item_id;

						var attachment = frame.state().get('selection').first().toJSON();

						jQuery('#banner-custom-img-container-' + item_id).append('<img src="' + attachment.url + '" alt="' + attachment.name + '" class="ved-megamenu-banner-image" style="width:30px; height:30px; display:inline;"/>');

						jQuery('#edit-menu-item-megamenu-banner-' + item_id).val(attachment.id);
						jQuery('#ved-media-banner-upload-' + item_id).addClass('hidden');
						jQuery('#ved-media-banner-remove-' + item_id).removeClass('hidden');
					});

					frame.open();
				});

				jQuery('.remove-ved-megamenu-thumbnail').on('click', function (event) {

					event.preventDefault();
					var item_id = jQuery(this).attr('data-media-id');
					jQuery('#thumbnail-custom-img-container-' + item_id).html('');

					jQuery('#edit-menu-item-megamenu-thumbnail-' + item_id).val('');

					jQuery('#ved-media-thumbnail-upload-' + item_id).removeClass('hidden');

					jQuery('#ved-media-thumbnail-remove-' + item_id).addClass('hidden');
				});
                                
                                jQuery('.remove-ved-megamenu-banner').on('click', function (event) {

					event.preventDefault();
					var item_id = jQuery(this).attr('data-media-id');
					jQuery('#banner-custom-img-container-' + item_id).html('');

					jQuery('#edit-menu-item-megamenu-banner-' + item_id).val('');

					jQuery('#ved-media-banner-upload-' + item_id).removeClass('hidden');

					jQuery('#ved-media-banner-remove-' + item_id).addClass('hidden');
				});

			});
	        </script>
		<?php
	}

	global $pagenow;

	if ( $pagenow == 'nav-menus.php' ) {

		add_action( 'admin_footer', 'add_custom_js' );

		function load_wp_media_files() {
			wp_enqueue_media();
		}

		add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );
	}
