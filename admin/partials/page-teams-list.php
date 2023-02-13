<?php

$fl_admin = new Football_League_Admin(FOOTBALL_LEAGUE_NAME, FOOTBALL_LEAGUE_VERSION);

$teams = $fl_admin->get_teams();



$add_team = 'admin.php?page=fl&action=add';

$edit_team = 'admin.php?page=fl&action=edit&team=';

$delete_team = 'admin.php?page=fl&action=delete&team=';

?>

<div class="football-league-page wrap">
    <h2>Football Teams</h2>
    <div class="group">
        <br>
        <a id="btn_nuevo" class="button button-primary" href="<?= esc_attr( $add_team ) ?>">Add New</a>
        <br>
        <br>
        <table class="wp-list-table widefat fixed striped posts">
            <thead>
                <tr>
                    <th scope="col" id="title" class="manage-column">
                        Name
                    </th>
                    <th scope="col" id="nickname" class="manage-column">NickName</th>
                    <th scope="col" id="league" class="manage-column">League</th>
                    <th scope="col" id="logo" class="manage-column">Logo</th>
                </tr>
            </thead>
            <tbody id="the-list">
                <?php
                $html = '';
                if(isset($teams)){

                    foreach ($teams as $key => $team) {
    
                        $html .= '<tr ' . esc_attr( 'id=' . $key ) . ' class="iedit author-self level-0 post-1 type-post status-publish format-standard hentry category-Dummy category">';
                        $html .= '<td class="title column-title has-row-actions column-primary page-title" data-colname="name">' . esc_html( $team->name ) . ' <div class="row-actions">
                        <span class="edit"><a ' . esc_attr( 'href=' . $edit_team . $team->ID ) . ' aria-label="Edit “Post #1”">Edit</a> | </span>
                        <span class="trash"><a  ' . esc_attr( 'href=' . 'javascript:httpGet("' . $delete_team . $team->ID .'")' ) . ' class="submitdelete" aria-label="Move “Post #1” to the Trash">Delete</a></div></td>';
                        $html .= '<td class="title column-title has-row-actions column-primary page-title" data-colname="nickname">' . esc_html( $team->nickname) . '</td>';
                        $html .= '<td class="title column-title has-row-actions column-primary page-title" data-colname="league">' . esc_html( $fl_admin->get_league( $team->league_id)->name ) . '</td>';
                        $html .= '<td><img width=50px height=50px style="object-fit:contain" src="' . esc_attr( $team->logo ) . '"></td>';
                        $html .= '</tr>';
                        echo $html;
                        $html = '';
                    }
                }
                ?>
                <tfoot>
                    <tr>
                        <th scope="col" id="name" class="manage-column">
                            Name
                        </th>
                        <th scope="col" id="nickname" class="manage-column">NickName</th>
                        <th scope="col" id="league" class="manage-column">League</th>
                        <th scope="col" id="logo" class="manage-column">Logo</th>
                        
                    </tr>
                </tfoot>
            </tbody>
        </table>
    </div>
</div>


<div class="eflw-teamcards-query">
    <div class="select-team-input">
        <span>Show teams</span>
        
        <label for="show-all">All</label>
        <input onclick="show_team_select()" type="radio" name="show-team-by" id="show-all" value="all">
        <label for="show-by-league">by League</label>
        <input type="radio" name="show-team-by" id="show-by-league" value="league">
        <label for="show-by-keyword">by Keyword</label>
        <input type="radio" name="show-team-by" id="show-by-keyword" value="keyword">

    </div>

    <div class="selection-criteria">
        <div class="select-league">

            <select name="" id="">
                <option value="">LaLiga</option>
                <option value="">Bundesliga</option>
            </select>
        </div>
    </div>
</div>
<section class="eflw-teamcards-container">
    <div class="eflw-team-card">
        <div class="imgbox">
            <img src="<?= FOOTBALL_LEAGUE_URL . 'admin/img/logo_placeholder.svg' ?>" alt="" srcset="">
        </div>
        <div class="content">
            <div class="header">
                <h2>Barcelona</h2><span>Barca</span>
            </div>
            
            <div class="footer">
                <h4>League</h4>
                <p>LaLiga</p>
                <br>
                <button>Show more</button>
            </div>
        </div>
    </div>
</section>