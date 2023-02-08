<?php

if(isset($_GET['team'])){
    $title = 'Edit Team';
}
else{
    $title = 'Add Team';
}

$fl_admin = new Football_League_Admin(FOOTBALL_LEAGUE_NAME, FOOTBALL_LEAGUE_VERSION);

if(isset($_POST['save-team'])){
    $fl_admin->store_team($_POST, isset($_GET['team']) ? $_GET['team'] : null);
}

$leagues = $fl_admin->get_leagues();
//TODO: styel admin page 
?>

<div class="team-admin-page">

    
    <h2><?= isset($_GET['team']) ? 'Edit Team' : 'Add Team' ?></h2>
    <form method="post">
    
        <div class="group">
    
            <table class="form-table">
                <tbody id="news-container">
                    <tr>
                        <th scope="row"><label for="name">Name</label></th>
                        <td><input required value="<?= isset($_GET['team']) ? esc_attr( $data[0]['name'] ) : '' ?>" type="text" name="name" id="name" class="regular-text"><p>Enter team name</p></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="nickname">Nickname</label></th>
                        <td><input required value="<?= isset($_GET['team']) ? esc_attr( $data[0]['nickname'] ) : '' ?>" type="text" name="nickname" id="nickname" class="regular-text"><p>Enter team nickname</p></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="league_id">League</label></th>
                        <td><select name="league_id" id="league_id">
                            <?php
                            $html = '';
                            foreach ($leagues as $key => $league) {
                                $html .= '<option value="' . esc_attr( $league->ID ) . '">' . esc_html( $league->name ) . '</option>';
                            }
                            echo $html;
                            ?>
                        </select><p>Select team league</p></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="history">History</label></th>
                        <td><textarea class="regular-text" name="history" id="history" cols="30" rows="10"><?= isset($_GET['team']) ? esc_attr( $data[0]['history'] ) : '' ?></textarea>
                        <p>Enter team history</p></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="logo">Logo</label></th>
                        <!-- <td><input value="<?= isset($_GET['ticker']) ? esc_attr( $data[0]['scroll_speed'] ) : '10' ?>" min=5 max=30 type="number" name="scroll_speed" id="scroll_speed" class="regular-number"><p>Enter team logo</p></td> -->
                    </tr>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>
                            <button type="submit" class="button button-primary" name="save-team">Save Team</button>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </form>
</div>