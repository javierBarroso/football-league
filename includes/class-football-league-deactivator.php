<?php
/**
 * @since      1.0.0
 * @package    Football_League
 * @subpackage Football_League/includes
 * @author     Javier Barroso <abby.javi.infox5@gmail.com>
 */


 class Football_League_Deactivator{

    public static function deactivate(){

        flush_rewrite_rules();

    }

 }
?>