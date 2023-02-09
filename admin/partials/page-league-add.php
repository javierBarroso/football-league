<?php
$fl_admin = new Football_League_Admin(FOOTBALL_LEAGUE_NAME, FOOTBALL_LEAGUE_VERSION);

$data = null;

if(isset($_GET['league'])){
    $title = 'Edit League';
    $data = $fl_admin->get_league($_GET['league']);
}
else{
    $title = 'Add League';
}


if(isset($_POST['save-league'])){
    $fl_admin->store_league($_POST, isset($_GET['league']) ? $_GET['league'] : null);
}

if ( ! did_action( 'wp_enqueue_media' ) ) {
    wp_enqueue_media();
}

//TODO: styel admin page 
?>

<div class="team-admin-page wrap">

    
    <h2><?= esc_html( $title ) ?></h2>
    <form method="post">
    
        <div class="group">
    
            <table class="form-table">
                <tbody id="news-container">
                    <tr>
                        <th scope="row"><label for="name">Name</label></th>
                        <td><input required value="<?= isset($_GET['league']) ? esc_attr( $data->name ) : '' ?>" type="text" name="name" id="name" class="regular-text"><p>Enter league name</p></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="logo">Logo</label></th>
                        <td>
                            <div class="wnpoll_featured_image_uploader">
                                <a href="#" class="upload_image_button button button-primary" onclick="select_logo();"><?= esc_html('Select Team Logo') ?></a>
                                <br><br>
                                <div id="logo-preview-container"><?php echo '<img src="' . esc_attr( isset($data) ? $data->logo : FOOTBALL_LEAGUE_URL . 'admin/img/logo_placeholder.svg' ) . '" style="object-fit:contain" width=200 height=200 name="logo-preview" id="logo-preview" style="object-fit: cover;">'; ?></div>
                                <input style="display:none;" type="text" name="logo" id="logo" value="<?= isset($_GET['team']) ? esc_attr($data->logo) : '' ?>"/>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>
                            <button type="submit" class="button button-primary" name="save-league">Save League</button>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </form>
</div>