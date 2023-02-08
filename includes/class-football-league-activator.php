<?php
/**
 * @since      1.0.0
 * @package    Football_League
 * @subpackage Football_League/includes
 * @author     Javier Barroso <abby.javi.infox5@gmail.com>
 */


 class Football_League_Activator{

    public static function activate(){
        
        global $wpdb;

        $query_create_league_table = "CREATE TABLE IF NOT EXISTS `" . LEAGUES_TABLE . "`(
            `ID` INT NOT NULL AUTO_INCREMENT,
            `name` TEXT NOT NULL, 
            `logo` TEXT, 
            PRIMARY KEY (`ID`)
        );";
        $wpdb->query($query_create_league_table);

        $query_create_team_table = "CREATE TABLE IF NOT EXISTS `" . TEAMS_TABLE . "`(
            `ID` INT NOT NULL AUTO_INCREMENT, 
            `league_id` INT NOT NULL ,  
            `name` TEXT NOT NULL ,  
            `nickname` TEXT NOT NULL ,  
            `history` TEXT NOT NULL ,  
            `logo` TEXT NULL ,  
            PRIMARY KEY (`ID`),
            FOREIGN KEY (league_id) REFERENCES " . LEAGUES_TABLE . "(ID)
        );";
        $wpdb->query($query_create_team_table);

        flush_rewrite_rules();

    }

 }
?>