<?php
$title = '';
if(isset($_GET['league'])){
    $title = 'Edit League';
}
else{
    $title = 'Add League';
}

$fl_admin = new Football_League_Admin(FOOTBALL_LEAGUE_NAME, FOOTBALL_LEAGUE_VERSION);

if(isset($_POST['save-league'])){
    $fl_admin->store_league($_POST, isset($_GET['league']) ? $_GET['league'] : null);
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
                        <td><input required value="<?= isset($_GET['league']) ? esc_attr( $data[0]['name'] ) : '' ?>" type="text" name="name" id="name" class="regular-text"><p>Enter league name</p></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="logo">Logo</label></th>
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