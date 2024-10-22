<?php

/**
 * Hooks - WP vedanta's hook system
 *
 * @package WPvedanta
 * @subpackage WP_vedanta
 */

/**
 * vedanta_hook_before_html() short description.
 *
 * Long description.
 *
 * @since 0.3
 * @hook action vedanta_hook_before_html
 */
function vedanta_hook_before_html() {
    do_action('vedanta_hook_before_html');
}

/**
 * vedanta_hook_after_html() short description.
 *
 * Long description.
 *
 * @since 0.3
 * @hook action vedanta_hook_after_html
 */
function vedanta_hook_after_html() {
    do_action('vedanta_hook_after_html');
}

