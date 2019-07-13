<?php
/**
 * Plugin Name: Wordpress Poll
 * Description: Plugin for polling a survey
 * Plugin URI:https://www.commandmedia.net/
 * Author: Mukh. Kurniawan
 * Author URI: https://www.commandmedia.net/
 * Version: 1.0.0
 * License: GNU General Public License v2.0
 * Text Domain: cst-poll
 *
 * @package cst-poll
 */


defined( 'ABSPATH' ) or die( 'Not Authorized!' );

class Cst_Poll {

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {

        // Register cst_poll CPT
        add_action('init', array($this, 'register_cst_poll_cpt'));
        // Add meta boxes
        add_action('add_meta_boxes', array($this, 'add_cst_poll_meta_boxes'));
        // Save cst_poll data
        add_action('save_post_cst_poll', array($this, 'save_cst_poll'));
        // Backend css and js
        add_action('admin_enqueue_scripts', array($this, 'enqueue_backend_css_js'));
        // Frontend css and js
        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_css_js'));

        // Active Plugin Hook
        register_activation_hook(__FILE__, array($this, 'plugin_activate'));
        // Deactive Plugin Hook
        register_deactivation_hook(__FILE__, array($this, 'plugin_deactivate'));
    }

    /**
     * Register cst_poll CPT
     *
     * @since 1.0.0
     */
    public function register_cst_poll_cpt()
    {
        //Labels for post type
        $labels = array(
            'name' => 'Polls',
            'singular_name' => 'Poll',
            'menu_name' => 'Poll',
            'name_admin_bar' => 'Poll',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Poll',
            'new_item' => 'New Poll',
            'edit_item' => 'Edit Poll',
            'view_item' => 'View Poll',
            'all_items' => 'All Poll',
            'search_items' => 'Search Poll',
            'parent_item_colon' => 'Parent Poll:',
            'not_found' => 'No Poll found.',
            'not_found_in_trash' => 'No Poll found in Trash.',
        );
        //arguments for post type
        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_nav' => true,
            'query_var' => true,
            'hierarchical' => false,
            'supports' => array('title'),
            'has_archive' => true,
            'menu_position' => 20,
            'show_in_admin_bar' => true,
            'menu_icon' => 'dashicons-marker',
            'rewrite' => array('slug' => 'cst_poll', 'with_front' => 'true')
        );
        //register post type
        register_post_type('cst_poll', $args);
    }

    /**
     * Add cst_poll Metabox
     *
     * @since 1.0.0
     */
    public function add_cst_poll_meta_boxes()
    {

        add_meta_box(
            'cst_poll_meta_box', //id
            'Details', //name
            array($this, 'cst_poll_meta_box_display'), //display function
            'cst_poll', //post type
            'normal', //location
            'default' //priority
        );
    }

    /**
     * Display cst_poll Metabox
     *
     * @since 1.0.0
     */
    public function cst_poll_meta_box_display($post)
    {

        ?>
        <table width="100%">
            <tr>
                <td width="20%">Option 1</td>
                <td><input style="width: 70%;" placeholder="Option 1" type="text" name="cst_poll_option1" id="cst_poll_option1" value="" />
                </td>
            </tr>
            <tr>
                <td>Option 2</td>
                <td><input style="width: 70%;" placeholder="Option 2"  type="text" name="cst_poll_option2" id="cst_poll_option1" value="" /></td>
            </tr>
            <tr>
                <td>Result</td>
                <td><input style="width: 70%;" placeholder="Result"  type="text" name="cst_poll_result" id="cst_poll_result" value="" /></td>
            </tr>
            <tr>
                <td>Active Date</td>
                <td><input style="width: 100px;" placeholder="Active Date"  type="text" name="cst_poll_active_date" id="cst_poll_active_date" value="" /></td>
            </tr>

        </table>

        <?php

    }

    /**
     * Save cst_poll
     *
     * @since 1.0.0
     * @param  string $post_id.
     * @return string
     */
    public function save_cst_poll($post_id){

    }

    /**
     * Add Backend CSS and JS
     *
     * @since 1.0.0
     */
    public function enqueue_backend_css_js()
    {

        wp_register_style('cst_poll_backend_css', plugin_dir_url(__FILE__) . '/assets/css/admin.css', array(), null);
        wp_register_script( 'cst_poll_backend_js', plugin_dir_url(__FILE__) . '/assets/js/admin.js', array(), null, true );
        wp_enqueue_script('jquery');
        wp_enqueue_style('cst_poll_backend_css');
        wp_enqueue_script('cst_poll_backend_js');
    }

    /**
     * Add Frontend CSS and JS
     *
     * @since 1.0.0
     */
    public function enqueue_frontend_css_js()
    {

        wp_register_style('cst_poll_frontend_css', plugin_dir_url(__FILE__) . '/assets/css/style.css', array(), null);
        wp_register_script( 'cst_poll_frontend_js', plugin_dir_url(__FILE__) . '/assets/js/main.js', array(), null, true );
        wp_enqueue_script('jquery');
        wp_enqueue_style('cst_poll_frontend_css');
        wp_enqueue_script('cst_poll_frontend_js');
    }

    /**
     * Plugin Activation
     *
     * @since 1.0.0
     */
    public function plugin_activate()
    {
        $this->register_cst_poll_cpt();
        flush_rewrite_rules();
    }

    /**
     * Plugin Deactivation
     *
     * @since 1.0.0
     */
    public function plugin_deactivate()
    {
        flush_rewrite_rules();
    }

}

new Cst_Poll();