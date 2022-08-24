<?php

    include_once "core/php/controller.php";
    include_once "core/php/model.php";
    include_once "core/php/view.php";

    use view\error;

    $error = new error();
    $error->addNew("997","Psy jadą");
    $error->show();
    // use model\calcClient;
    use controller\routing;
    $routing = new routing();
    $routing->changeUrl("http://127.0.0.1/strony/praca/aha");
    $routing->launch();
    // $area = ["flooring","brick"];
    // $calc = new calcClient($area,1111);
    // $calc->echoP(); 
?>