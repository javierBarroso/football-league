<?php
/**
 * @since      1.0.0
 * @package    Football_League
 * @subpackage Football_League/includes
 * @author     Javier Barroso <abby.javi.infox5@gmail.com>
 */



class Football_League_Admin
{

    /**
     * The ID of this plugin.
    *
    * @since    1.0.0
    * @access   private
    * @var      string    $plugin_name    The ID of this plugin.
    */
    private $plugin_name;

    /**
     * The version of this plugin.
    *
    * @since    1.0.0
    * @access   private
    * @var      string    $version    The current version of this plugin.
    */
    private $version;

    /**
     * Initialize the class and set its properties.
    *
    * @since    1.0.0
    * @param      string    $plugin_name       The name of this plugin.
    * @param      string    $version    The version of this plugin.
    */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        add_action('admin_menu', array($this, 'add_admin_menu'));

        add_filter('plugin_action_links_' . FOOTBALL_LEAGUE_NAME, array($this, 'settings_link'));
    }

    function settings_link($links)
    {
        $settings_link = '<a href="admin.php?page=bnt">Settings</a>';

        array_push($links, $settings_link);

        return $links;
    }


    /* Create admin menu pages */
    function add_admin_menu()
    {
        add_menu_page(
            'Teams',
            'Football Leagues',
            'manage_options',
            'fl',
            array($this, 'teams_list'),
            null,
            3
        );
        add_submenu_page(
            'fl',
            'Teams',
            'Teams',
            'manage_options',
            'fl',
            array($this, 'teams_list'),
        );
        add_submenu_page(
            'fl',
            'Leagues',
            'Leagues',
            'manage_options',
            'fl-leagues',
            array($this, 'leagues_list'),
        );
        // add_submenu_page(
        //     'fl',
        //     'Add New Team',
        //     'Add New Team',
        //     'manage_options',
        //     'fl-add',
        //     array($this, 'team_add'),
        // );
    }

    function teams_list()
    {
        $action = isset($_GET['action']) ? sanitize_text_field($_GET['action']) : '';

        switch( $action ){
            case 'add':
            case 'edit':
                require_once FOOTBALL_LEAGUE_PATH . 'admin/partials/page-team-add.php';
                break;
            case 'delete':
                $this->delete_team($_GET['team']);
                break;
            default:
                require_once FOOTBALL_LEAGUE_PATH . 'admin/partials/page-teams-list.php';
                break;
                
        }
    }

    function leagues_list()
    {
        $action = isset($_GET['action']) ? sanitize_text_field($_GET['action']) : '';

        switch ($action) {
            case 'add':
            case 'edit':
                require_once FOOTBALL_LEAGUE_PATH . 'admin/partials/page-league-add.php';
                break;
            case 'delete':
                $this->delete_league($_GET['league']);
                break;
            default:
                require_once FOOTBALL_LEAGUE_PATH . 'admin/partials/page-leagues-list.php';
                break;
        }
    }

    public function get_team($team_id){

        global $wpdb;

        $query_get_team = "SELECT * FROM " . TEAMS_TABLE . " WHERE ID = " . $team_id;

        $team = $wpdb->get_results($query_get_team);

        /* if(empty($team)){
            $team = array(null);
        } */
        
        return $team[0];

    }



    /**
     * get the stored teams
    * 
    * @since 1.0.0
    */

    public function get_teams()
    {

        global $wpdb;

        $query_get_teams = "SELECT * FROM " . TEAMS_TABLE;

        $teams = $wpdb->get_results($query_get_teams);

        return $teams;

    }

    function delete_team($team_id){

        global $wpdb;

        $wpdb->delete(TEAMS_TABLE, array('ID' => $team_id));
        print('<script>window.location.href="admin.php?page=fl"</script>');

    }

    //TODO: function get_team 

    public function get_league( $league_id ){

        global $wpdb;

        $query_get_league = "SELECT * FROM " . LEAGUES_TABLE . " WHERE ID = " . $league_id;

        $league = $wpdb->get_results($query_get_league);

        return $league[0];
    }

    public function delete_league($league_id){

        global $wpdb;

        if(!$wpdb->delete(LEAGUES_TABLE, array('ID' => $league_id))){

            print('<script>window.location.href="admin.php?page=fl-leagues&delete_error=1"</script>');
        }
        print('<script>window.location.href="admin.php?page=fl-leagues"</script>');
    }
    /**
     * get stored leagues
     * 
     * @since 1.0.0
     */

    public function get_leagues()
    {

        global $wpdb;
        
        $query_get_leagues = "SELECT * FROM " . LEAGUES_TABLE;

        $leagues = $wpdb->get_results($query_get_leagues);

        return $leagues;

    }

    /**
     * Get ticker news
    * 
    * @since 1.0.1
    */

    //TODO: get leags width its teams and team with its league
    // public function get_ticker_and_news($id)
    // {

    //     global $wpdb;

    //     $query_get_ticker = 'SELECT * FROM ' . TICKERS_TABLE . ' WHERE ID = ' . $id;

    //     $query_get_news = 'SELECT * FROM ' . NEWS_TABLE . ' WHERE ticker_id = ' . $id;

    //     $ticker = $wpdb->get_results($query_get_ticker, ARRAY_A);

    //     $news = $wpdb->get_results($query_get_news, ARRAY_A);

    //     return [$ticker[0], $news];
    // }


    public function store_league($data, $league = null){

        global $wpdb;

        if(isset($data['save-league'])){

            //TODO: add Logo
            $league_data = [
                'ID' => $league,
                'name' => $data['name'],
                'logo' => $data['logo']
            ];

            if($league){
                $wpdb->update(LEAGUES_TABLE, $league_data, array('ID' => $league));
                print('<script>window.location.href="admin.php?page=fl-leagues"</script>');
                return true;
            }
            
            $wpdb->insert(LEAGUES_TABLE, $league_data);

            print('<script>window.location.href="admin.php?page=fl-leagues"</script>');
            return true;
            
        }
        return false;
    }

    /**
     * Save new ticker
    * 
    * @since 1.0.0
    */
    public function store_team($data, $team = null)
    {
        global $wpdb;

        if (isset($data['save-team'])) {
            //TODO: add nickname and logo
            $team_data = [
                'ID' => $team,
                'league_id' => $data['league_id'],
                'name' => $data['name'],
                'nickname' => $data['nickname'],
                'history' => $data['history'],
                'logo' => $data['logo'],
            ];

            if ($team) {

                $wpdb->update(TEAMS_TABLE, $team_data, array('ID' => $team));
                print('<script>window.location.href="admin.php?page=fl"</script>');
                return true;
                
            } 
            $wpdb->insert(TEAMS_TABLE, $team_data);
            print('<script>window.location.href="admin.php?page=fl"</script>');
            return true;
        }

        return false;
    }


    /**
     * Register the stylesheets for the admin area.
    *
    * @since    1.0.0
    */
    public function enqueue_styles()
    {
        /**
         * This function is provided for demonstration purposes only.
        *
        * An instance of this class should be passed to the run() function
        * defined in Plugin_Name_Loader as all of the hooks are defined
        * in that particular class.
        *
        * The Plugin_Name_Loader will then create the relationship
        * between the defined hooks and the functions defined in this
        * class.
        */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/football-league-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
    *
    * @since    1.0.0
    */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
        *
        * An instance of this class should be passed to the run() function
        * defined in Plugin_Name_Loader as all of the hooks are defined
        * in that particular class.
        *
        * The Plugin_Name_Loader will then create the relationship
        * between the defined hooks and the functions defined in this
        * class.
        */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/football-league-admin.js', array('jquery'), $this->version, false);
    }
}

?>