<?php
/**
 * Comments - functions that deal with comments
 *
 */

/**
 * vedanta_discussion_title()
 *
 * @filter vedanta_many_comments, vedanta_no_comments, vedanta_one_comment, vedanta_comments_number
 */
function vedanta_discussion_title( $type = NULL, $echo = true ) {
	if ( ! $type ) {
		return;
	}

	$discussion_title	 = '';
	$comment_count		 = vedanta_count( 'comment', false );
	$ping_count		 = vedanta_count( 'pings', false );

	switch ( $type ) {
		case 'comment' :
			$count	 = $comment_count;
			// Available filter: vedanta_many_comments
			$many	 = apply_filters( 'vedanta_many_comments', esc_html__( '% Comments', 'godecore' ) );
			// Available filter: vedanta_no_comments
			$none	 = apply_filters( 'vedanta_no_comments', esc_html__( 'No Comments Yet', 'godecore' ) );
			// Available filter: vedanta_one_comment
			$one	 = apply_filters( 'vedanta_one_comment', esc_html__( '1 Comment', 'godecore' ) );
			break;
		case 'pings' :
			$count	 = $ping_count;
			// Available filter: vedanta_many_pings
			$many	 = apply_filters( 'vedanta_many_pings', esc_html__( '% Pings/Trackbacks', 'godecore' ) );
			// Available filter: vedanta_no_pings
			$none	 = apply_filters( 'vedanta_no_pings', esc_html__( 'No Pings/Trackbacks Yet', 'godecore' ) );
			// Available filter: vedanta_one_comment
			$one	 = apply_filters( 'vedanta_one_ping', esc_html__( '1 Ping/Trackback', 'godecore' ) );
			break;
	}

	if ( $count > 1 ) {
		$number = str_replace( '%', number_format_i18n( $count ), $many );
	} elseif ( $count == 1 ) {
		$number = $one;
	} else {
		// it must be one
		$number = $none;
	}

	// Available filter: vedanta_discussion_title_tag
	$tag	 = apply_filters( 'vedanta_discussion_title_tag', (string) 'h5' );
	$class	 = 'text-title text-uppercase';

	if ( $number ) {
		$discussion_title = '<' . $tag . ' class="' . esc_attr($type . '-title ' . $class) . '">' . $number . '</' . $tag . '>';
	}

	// Available filter: vedanta_discussion_title
	$vedanta_discussion_title = apply_filters( 'vedanta_discussion_title', (string) $discussion_title );

        $allowed_html = array(
                'h5' => array(
                        'class' => array(),
                ),
        );
        
	return ( $echo ) ? print( wp_kses( $vedanta_discussion_title, $allowed_html ) ) : wp_kses( $vedanta_discussion_title, $allowed_html );
}

/**
 * vedanta_count()
 *
 * @since 0.3
 * @needsdoc
 */
function vedanta_count( $type = NULL, $echo = true ) {
	if ( ! $type ) {
		return;
	}

	global $wp_query;

	$comment_count	 = $wp_query->comment_count;
	$ping_count	 = count( $wp_query->comments_by_type[ 'pings' ] );

        $allowed_html = array(
                'a'   => array(
                        'href' => array(),
                )
        );
        
	switch ( $type ):
		case 'comment':
			return ( $echo ) ? print( wp_kses( $comment_count, $allowed_html ) ) : (int)$comment_count;
			break;
		case 'pings':
			return ( $echo ) ? print( wp_kses( $ping_count, $allowed_html ) ) : (int)$ping_count;
			break;
	endswitch;
}

/**
 * vedanta_comment_author() short description
 *
 * @since 0.3
 * @todo needs filter
 */
function vedanta_comment_author( $meta_format = '%avatar%' ) {
	// Available filter: vedanta_comment_author_meta_format
	$meta_format = apply_filters( 'vedanta_comment_author_meta_format', $meta_format );

	if ( ! $meta_format ) {
		return;
	}

	// No keywords to replace
	if ( strpos( $meta_format, '%' ) === false ) {
		echo wp_kses_post($meta_format);
	} else {
		$open	 = '<!--BEGIN .comment-author-->';
		$open	 .= '<div class="comment-avatar">';
		$close	 = '<!--END .comment-author-->';
		$close	 .= '</div>';

		// separate the %keywords%
		$meta_array = preg_split( '/(%.+?%)/', $meta_format, -1, PREG_SPLIT_DELIM_CAPTURE );

		// parse through the keywords
		foreach ( $meta_array as $key => $str ) {
			switch ( $str ) {
				case '%avatar%':
					$meta_array[ $key ] = vedanta_comment_avatar();
					break;

				case '%name%':
					$meta_array[ $key ] = vedanta_comment_name();
					break;
			}
		}

		$output = join( '', $meta_array );
		if ( $output ) {
			echo wp_kses_post($open . $output . $close);
		}
	}
}

/**
 * vedanta_comment_meta() short description
 *
 */
function vedanta_comment_meta( $meta_format = '%date% %reply%' ) {
	// Available filter: vedanta_comment_meta_format
	$meta_format = apply_filters( 'vedanta_comment_meta_format', $meta_format );

	if ( ! $meta_format ) {
		return;
	}

	// No keywords to replace
	if ( strpos( $meta_format, '%' ) === false ) {
		echo wp_kses_post($meta_format);
	} else {
		$open	 = '<!--BEGIN .comment-meta-->';
		$open	 .= '<div class="comment-tools">';
		$close	 = '<!--END .comment-meta-->';
		$close	 .= '</div>';

		// separate the %keywords%
		$meta_array = preg_split( '/(%.+?%)/', $meta_format, -1, PREG_SPLIT_DELIM_CAPTURE );

		// parse through the keywords
		foreach ( $meta_array as $key => $str ) {
			switch ( $str ) {
				case '%date%':
					$meta_array[ $key ] = vedanta_comment_date();
					break;

				case '%time%':
					$meta_array[ $key ] = vedanta_comment_time();
					break;

				case '%link%':
					$meta_array[ $key ] = vedanta_comment_link();
					break;

				case '%reply%':
					$meta_array[ $key ] = vedanta_comment_reply( true );
					break;

				case '%edit%':
					$meta_array[ $key ] = vedanta_comment_edit();
					break;
			}
		}
		$output = join( '', $meta_array );
		if ( $output )
			echo wp_kses_post($open . $output . $close);
	}
}

/**
 * vedanta_comment_text() short description
 *
 */
function vedanta_comment_text() {
	echo '<div class="comment-content">';
	echo '<h5>' . vedanta_comment_name() . '</h5>';
	echo '<p>' . comment_text() . '</p>';
	echo '</div>';
}

/**
 * vedanta_comment_moderation() short description
 *
 */
function vedanta_comment_moderation() {
	global $comment;
	if ( $comment->comment_approved == '0' )
		echo '<p class="comment-unapproved moderation alert">' . esc_html__( 'Your comment is awaiting moderation', 'godecore' ) . '</p>';
}

/**
 * vedanta_comment_navigation() paged comments
 *
 */
function vedanta_comment_navigation() {
	$num = get_comments_number() + 1;

// Available filter: vedanta_comment_navigation_tag
	$tag	 = apply_filters( 'vedanta_comment_navigation_tag', (string) 'div' );
	$open	 = "<!--BEGIN .navigation-links-->";
	$open	 .= "<" . $tag . " class=\"navigation-links comment-navigation\">";
	$close	 = "<!--END .navigation-links-->";
	$close	 .= "</" . $tag . ">";

	if ( $num > get_option( 'comments_per_page' ) ) {
		$paged_links = paginate_comments_links( array(
			'type'		 => 'array',
			'echo'		 => false,
			'prev_text'	 => '&laquo; Previous Page',
			'next_text'	 => 'Next Page &raquo;' ) );

		if ( $paged_links )
			$comment_navigation = $open . join( ' ', $paged_links ) . $close;
	}
	else {
		$comment_navigation = NULL;
	}

	// Available filter: vedanta_comment_navigation
	echo apply_filters( 'vedanta_comment_navigation', (string) $comment_navigation );
}

/**
 * vedanta_comments_callback() recreate the comment list
 *
 */
function vedanta_comments_callback( $comment, $args, $depth ) {
	$GLOBALS[ 'comment' ]		 = $comment;
	$GLOBALS[ 'comment_depth' ]	 = $depth;
	$tag				 = apply_filters( 'vedanta_comments_list_tag', (string) 'div' );
	?>

	<!--BEING .comment-->
        <<?php echo esc_html($tag); ?> class="<?php esc_attr(semantic_comments()); ?>" id="comment-<?php echo comment_ID(); ?>">
	<?php
	vedanta_hook_comments();
}

/**
 * vedanta_comments_endcallback() close the comment list
 *
 */
function vedanta_comments_endcallback() {
	// Available filter: vedanta_comments_list_tag
	$tag = apply_filters( 'vedanta_comments_list_tag', (string) 'div' );
	echo "<!--END .comment-->";
	echo "</" . esc_html($tag) . ">";
	// Available action: vedanta_hook_inside_comments_loop
	do_action( 'vedanta_hook_inside_comments_loop' );
}

/**
 * vedanta_pings_callback() recreate the comment list
 *
 */
function vedanta_pings_callback( $comment, $args, $depth ) {
	$GLOBALS[ 'comment' ]	 = $comment;
	// Available filter: vedanta_pings_callback_tag
	$tag			 = apply_filters( 'vedanta_pings_callback_tag', (string) 'div' );
	// Available filter: vedanta_pings_callback_time
	$time			 = apply_filters( 'vedanta_pings_callback_time', (string) ' on ' );
	// Available filter: vedanta_pings_callback_time
	$when			 = apply_filters( 'vedanta_pings_callback_when', (string) ' at ' );

	if ( $comment->comment_approved == '0' )
		echo '<p class="ping-unapproved moderation alert">' . esc_html__( 'Your trackback is awaiting moderation.', 'godecore' ) . '</p>';
	?>

	<!--BEING .pings-->
	<<?php echo esc_html($tag); ?> class="<?php echo esc_attr(semantic_comments()); ?>" id="ping-<?php echo esc_attr($comment->comment_ID); ?>">
	<?php
	comment_author_link();
	echo esc_html($time);
	?><a class="trackback-time" href="<?php comment_link(); ?>"><?php
		comment_date();
		echo esc_html($when);
		comment_time();
		?></a>
	<?php
}

/**
 * vedanta_pings_endcallback() close the comment list
 *
 */
function vedanta_pings_endcallback() {
	// Available filter: vedanta_pings_callback_tag
	$tag = apply_filters( 'vedanta_pings_callback_tag', (string) 'div' );
	echo "<!--END .pings-list-->";
	echo "</" . esc_html($tag) . ">";
	// Available action: vedanta_hook_inside_pings_list
	do_action( 'vedanta_hook_inside_pings_list' );
}

/**
 * vedanta_hook_comments() short description.
 *
 * Long description.
 *
 */
function vedanta_hook_comments( $callback = array( 'vedanta_comment_author', 'vedanta_comment_meta', 'vedanta_comment_moderation', 'vedanta_comment_text' ) ) {
	do_action( 'vedanta_hook_comments_open' ); // Available action: vedanta_comment_open
	do_action( 'vedanta_hook_comments' );

	$callback = apply_filters( 'vedanta_comments_callback', $callback ); // Available filter: vedanta_comments_callback
	// If $callback is an array, loop through all callbacks and call those functions if they exist
	if ( is_array( $callback ) ) {
		foreach ( $callback as $function ) {
			if ( function_exists( $function ) ) {
				call_user_func( $function );
			}
		}
	}

	// If $callback is a string, just call that function if it exist
	elseif ( is_string( $callback ) ) {
		if ( function_exists( $callback ) ) {
			call_user_func( $callback );
		}
	}
	do_action( 'vedanta_hook_comments_close' ); // Available action: vedanta_comment_close
}

function vedanta_custom_comment_form() {
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ) ? " aria-required='true'" : '';
	$html_req  = ( $req ) ? " required='required'" : '';
	$html5     = ( 'html5' === current_theme_supports( 'html5', 'comment-form' ) ) ? 'html5' : 'xhtml';

	$fields = array();

	$fields['author'] = '<div class="comment-form-author form-group row"><label class="col-sm-3 form-control-label required"><span class="required">*</span>Name:</label><div class="col-sm-9"><input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_attr__( 'Name*', 'godecore' ) . '" ' . $aria_req . $html_req . ' aria-label="' . esc_attr__( 'Name', 'godecore' ) . '"/></div></div>';
	$fields['email']  = '<div class="comment-form-email form-group row"><label class="col-sm-3 form-control-label required"><span class="required">*</span>E-mail:</label><div class="col-sm-9"><input id="email" class="form-control" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_attr__( 'Email*', 'godecore' ) . '" ' . $aria_req . $html_req . ' aria-label="' . esc_attr__( 'Email', 'godecore' ) . '"/></div></div>';
	$fields['url']    = '<div class="comment-form-url form-group row"><label class="col-sm-3 form-control-label required">Website:</label><div class="col-sm-9"><input id="url" class="form-control" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_attr__( 'Website', 'godecore' ) . '" aria-label="' . esc_attr__( 'URL', 'godecore' ) . '" /></div></div>';

	$comments_args = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'	 => '<div class="comment-form-comment form-group row"><label class="col-sm-3 form-control-label required"><span class="required">*</span>Comment:</label><div class="col-sm-9"><textarea id="comment" name="comment" placeholder="'.esc_attr__( 'Comment', 'godecore' ).'" class="form-control" rows="6" aria-required="true"></textarea></div></div>',
		'title_reply'          => esc_html__( 'Leave A Reply', 'godecore' ),
		'title_reply_to'       => esc_html__( 'Leave A Reply', 'godecore' ),
		/* translators: Opening and closing link tags. */
		'must_log_in'          => '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a comment.', 'godecore' ), '<a href="' . esc_url(wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )) . '">', '</a>' ) . '</p>',
		/* translators: %1$s: The username. %2$s and %3$s: Opening and closing link tags. */
		'comment_notes_before' => '',
		'id_submit'            => 'comment-submit',
		'class_submit'         => 'btn btn-lg btn-base',
		'label_submit'         => esc_html__( 'Submit', 'godecore' ),
	);

	return comment_form( $comments_args );
}
