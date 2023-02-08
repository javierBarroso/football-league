<?php

$fl_admin = new Football_League_Admin(FOOTBALL_LEAGUE_NAME, FOOTBALL_LEAGUE_VERSION);

$teams = $fl_admin->get_teams();

$add_team = 'admin.php?page=fl&action=add';

$edit_team = 'admin.php?page=fl&team=';

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
                    <td id="cb" class="manage-column column-cb check-column">
                        <label class="screen-reader-text" for="cb-select-all-1">Select All</label>
                        <input id="cb-select-all-1" type="checkbox">
                    </td>
                    <th scope="col" id="title" class="manage-column column-title column-primary sortable desc">
                        <span>Name</span>
                    </th>
                    <th scope="col" id="author" class="manage-column column-author">NickName</th>
                    <th scope="col" id="shortcode" class="manage-column column-shortcode">League</th>
                    <!-- <th scope="col" id="shortcode" class="manage-column column-shortcode">Logo</th> -->
                    <!-- <th scope="col" id="date" class="manage-column column-date sortable asc">
                        <a href="javascript:void(0)">
                            <span>Date</span><span class="sorting-indicator"></span>
                        </a>
                    </th> -->
                </tr>
            </thead>
            <tbody id="the-list">
                <?php
                $html = '';
                foreach ($teams as $key => $team) {

                    $html .= '<tr ' . esc_attr( 'id=' . $key ) . ' class="iedit author-self level-0 post-1 type-post status-publish format-standard hentry category-Dummy category">';
                    $html .= '<th scope="row" class="check-column">
                                    <label class="screen-reader-text" for="cb-select-1">Select Post #1</label>
                                    <input id="cb-select-1" type="checkbox" name="post[]" value="1">
                                    <div class="locked-indicator">
                                        <span class="locked-indicator-icon" aria-hidden="true"></span>
                                        <span class="screen-reader-text">
                                            “Post #' . esc_html( $key ) . '” is locked
                                        </span>
                                    </div>
                                </th>';
                    $html .= '<td class="title column-title has-row-actions column-primary page-title" data-colname="name">' . esc_html( $team->name ) . ' <div class="row-actions">
                    <span class="edit"><a ' . esc_attr( 'href=' . $edit_team . $team->ID ) . ' aria-label="Edit “Post #1”">Edit</a> | </span>
                    <span class="trash"><a href="javascript:void(0)" class="submitdelete" aria-label="Move “Post #1” to the Trash">Trash</a></div></td>';
                    $html .= '<td class="title column-title has-row-actions column-primary page-title" data-colname="nickname">' . esc_html( $team->nickname) . '</td>';
                    $html .= '<td class="title column-title has-row-actions column-primary page-title" data-colname="league">' . esc_html( $fl_admin->get_league( $team->league_id )['name'] ) . '</td>';
                    // $html .= '<td>' . $ticker['date'] . '</td>';
                    $html .= '</tr>';
                    echo $html;
                    $html = '';
                }
                ?>
                <tfoot>
                    <tr>
                        <td id="cb" class="manage-column column-cb check-column">
                            <label class="screen-reader-text" for="cb-select-all-1">Select All</label>
                            <input id="cb-select-all-1" type="checkbox">
                        </td>
                        <th scope="col" id="title" class="manage-column column-title column-primary sortable desc">
                            <span>Name</span>
                        </th>
                        <th scope="col" id="author" class="manage-column column-author">NickName</th>
                        <th scope="col" id="shortcode" class="manage-column column-shortcode">League</th>
                        <!-- <th scope="col" id="date" class="manage-column column-date sortable asc">
                            <a href="javascript:void(0)">
                                <span>Date</span><span class="sorting-indicator"></span>
                            </a>
                        </th> -->
                    </tr>
                </tfoot>
            </tbody>
        </table>
    </div>
</div>

