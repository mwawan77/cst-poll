<?php

defined('ABSPATH') or die('Not Authorized!');

class Cst_Poll_Widget extends WP_widget
{

    /**
     * Constructor
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        //set base values for the widget (override parent)
        parent::__construct(
            'cst_poll_widget',
            'Poll Widget',
            array('description' => 'A widget that displays the polling')
        );
    }

    /**
     * handles the back-end admin of the widget
     * $instance - saved values for the form
     *
     * @since 1.0.0
     */
    public function form($instance)
    {
        ?>
        <p>Nothing to do here</p>
        <?php
    }

    /**
     * handles updating the widget
     * $new_instance - new values, $old_instance - old saved values
     *
     * @since 1.0.0
     */
    public function update($new_instance, $old_instance)
    {

        $instance = array();

        return $instance;
    }

    /**
     * handles public display of the widget
     * $args - arguments set by the widget area, $instance - saved values
     *
     * @since 1.0.0
     */
    public function widget($args, $instance)
    {

        //get the output
        $html = '';

        $html .= $args['before_widget'];
        $html .= $args['before_title'];
        $html .= 'Polling';
        $html .= $args['after_title'];
        //uses the main output function of the location class
        $html .= 'sorry still on progress';
        $html .= $args['after_widget'];

        echo $html;
    }

}
