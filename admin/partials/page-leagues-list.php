<?php

$fl_admin = new Football_League_Admin(FOOTBALL_LEAGUE_NAME, FOOTBALL_LEAGUE_VERSION);

$leagues = $fl_admin->get_leagues();

$add_league = 'admin.php?page=fl-leagues&action=add';

$edit_league = 'admin.php?page=fl-leagues&action=edit&league=';

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
                    <td id="cb" class="manage-column column-cb check-column">
                        <label class="screen-reader-text" for="cb-select-all-1">Select All</label>
                        <input id="cb-select-all-1" type="checkbox">
                    </td>
                    <th scope="col" id="title" class="manage-column column-title column-primary sortable desc">
                        <span>Name</span>
                    </th>
                    <th scope="col" id="logo" class="manage-column column-logo">Logo</th>
                    
                </tr>
            </thead>
            <tbody id="the-list">
                <?php
                $html = '';
                foreach ($leagues as $key => $league) {

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
                    $html .= '<td class="title column-title has-row-actions column-primary page-title" data-colname="name">' . esc_html( $league->name ) . ' <div class="row-actions">
                    <span class="edit"><a ' . esc_attr( 'href=' . $edit_league . $league->ID ) . ' aria-label="Edit “Post #1”">Edit</a> | </span>
                    <span class="trash"><a href="javascript:void(0)" class="submitdelete" aria-label="Move “Post #1” to the Trash">Trash</a></div></td>';
                    $html .= '<td class="title column-title has-row-actions column-primary page-title" data-colname="nickname">' . esc_html( $league->logo) . '</td>';
                    
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
                        <th scope="col" id="logo" class="manage-column column-logo">Logo</th>
                    </tr>
                </tfoot>
            </tbody>
        </table>
    </div>
</div>

