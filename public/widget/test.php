<?php 

function loco(){
    echo 'Estoy loco';
}

if($_POST['action'] == 'loco'){
    loco();
    var_dump(loco());
}

echo 'Hola Mundo';

