<?php

$fl_admin = new Football_League_Admin(FOOTBALL_LEAGUE_NAME, FOOTBALL_LEAGUE_VERSION);

$data = null;

if(isset($_GET['team'])){
    $title = 'Edit Team';
    $data = $fl_admin->get_team($_GET['team']);
    var_dump($data);
}
else{
    $title = 'Add Team';
}

if(isset($_POST['save-team'])){
    $fl_admin->store_team($_POST, isset($_GET['team']) ? $_GET['team'] : null);
}

$leagues = $fl_admin->get_leagues();

if (empty($leagues)){
    
    $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor */
        esc_html__('Creating a "%1$s" requires at least one "%2$s".'),
        '<strong>' . esc_html__('Team') . '</strong>',
        '<strong>' . esc_html__('League') . '</strong>'
    );
    printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p><a id="btn_nuevo" class="button button-primary" href="admin.php?page=fl-leagues&action=add">Add League</a><br><br></div>', $message);
}


if ( ! did_action( 'wp_enqueue_media' ) ) {
    wp_enqueue_media();
}
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
                        <td><input required value="<?= isset($_GET['team']) ? esc_attr( $data->name ) : '' ?>" type="text" name="name" id="name" class="regular-text"><p>Enter team name</p></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="nickname">Nickname</label></th>
                        <td><input required value="<?= isset($_GET['team']) ? esc_attr( $data->nickname ) : '' ?>" type="text" name="nickname" id="nickname" class="regular-text"><p>Enter team nickname</p></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="league_id">League</label></th>
                        <td><select name="league_id" id="league_id">
                            <?php
                            $html = '';
                            foreach ($leagues as $key => $league) {
                                $html .= '<option ' . esc_attr( isset($_GET['team']) ? ($data->league_id == $league->ID ? 'selected' : '' ) : '' ) . ' value="' . esc_attr( $league->ID ) . '">' . esc_html( $league->name ) . '</option>';
                            }
                            echo $html;
                            ?>
                        </select><p>Select team league</p></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="history">History</label></th>
                        <td><textarea required class="regular-text" name="history" id="history" cols="30" rows="10"><?= isset($_GET['team']) ? esc_attr( $data->history ) : '' ?></textarea>
                        <p>Enter team history</p></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="logo">Logo</label></th>
                        <td>
                            <div class="wnpoll_featured_image_uploader">
                                <a href="#" class="upload_image_button button button-primary" onclick="select_logo();"><?= esc_html('Select Team Logo') ?></a>
                                <br><br>
                                <div id="logo-preview-container"><?php echo '<img src="' . esc_attr( isset($data) ? $data->logo : FOOTBALL_LEAGUE_URL . 'admin/img/logo_placeholder.svg' ) . '" style="object-fit:contain" width=200 height=200 name="logo-preview" id="logo-preview" style="object-fit: cover;">'; ?></div>
                                <input required style="display:none;" type="text" name="logo" id="logo" value="<?= isset($_GET['team']) ? esc_attr($data->logo) : '' ?>"/>
                            </div>
                        </td>
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