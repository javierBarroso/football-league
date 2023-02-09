<?php

$fl_admin = new Football_League_Admin(FOOTBALL_LEAGUE_NAME, FOOTBALL_LEAGUE_VERSION);

$leagues = $fl_admin->get_leagues();

$add_league = 'admin.php?page=fl-leagues&action=add';

$edit_league = 'admin.php?page=fl-leagues&action=edit&league=';

$delete_league = 'admin.php?page=fl-leagues&action=delete&league=';

$delete_message = 'Are you sure you want to delete this team? All teams from this league will be deleted as well.';

if(isset($_GET['delete_error'])){
    $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor */
        esc_html__('You cannot "%1$s" a league that has associated "%2$s".'),
        '<strong>' . esc_html__('delete') . '</strong>',
        '<strong>' . esc_html__('teams') . '</strong>'
    );
    printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p><a id="btn_nuevo" class="button button-primary" href="admin.php?page=fl">Go to teams page</a><br><br></div>', $message);
}
?>

<div class="football-league-page wrap">
    <h2>Football Leagues</h2>
    <div class="group">
        <br>
        <a id="btn_nuevo" class="button button-primary" href="<?= esc_attr( $add_league ) ?>">Add New</a>
        <br>
        <br>
        <table class="wp-list-table widefat fixed striped posts">
            <thead>
                <tr>
                    <!-- <td id="cb" class="check-column">
                        
                        
                    </td> -->
                    <th scope="col" id="name" class="manage-column">
                        Name
                    </th>
                    <th scope="col" id="logo" class="manage-column">Logo</th>
                    
                </tr>
            </thead>
            <tbody id="the-list">
                <?php
                $html = '';
                foreach ($leagues as $key => $league) {

                    $html .= '<tr>';
                    $html .= '<td class="title column-title has-row-actions column-primary page-title" data-colname="name">' . esc_html( $league->name ) . ' <div class="row-actions">
                    <span class="edit"><a ' . esc_attr( 'href=' . $edit_league . $league->ID ) . ' aria-label="Edit “Post #1”">Edit</a> | </span>
                    <span class="trash"><a ' . esc_attr( 'href=' . 'javascript:httpGet("' . $delete_league . $league->ID . '")') . ' class="submitdelete" aria-label="Move “Post #1” to the Trash">Delete</a></div></td>';
                    $html .= '<td class="title column-title has-row-actions column-primary page-title" data-colname="logo"><img width=30px src="' . esc_html( $league->logo) . '"></td>';
                    $html .= '</tr>';
                    
                }
                echo $html;
                ?>
                <tfoot>
                    <tr>
                        <th scope="col" id="name" class="manage-column">
                            Name
                        </th>
                        <th scope="col" id="logo" class="manage-column">Logo</th>
                    </tr>
                </tfoot>
            </tbody>
        </table>
    </div>
</div>

