<?php
    require_once('utils/session.php');
    require_once 'helper.php';

    if( Session::haveValue('calc_details') ){
        $netResult = Session::getValue('calc_details')['netResult'];
        $payload = Session::getValue('calc_details')['payload'];
        Session::clear('calc_details');
    }

    require_once 'view/form.php';
?>
