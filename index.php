<?php

    include "core/php/controller.php";
    // include "core/php/model.php";

    // use model\calcClient;
    use controller\routing;
    $routing = new routing();
    // $routing->changeUrl("http://127.0.0.1/strony/praca/aha");
    $routing->launch();
    // $area = ["flooring","brick"];
    // $calc = new calcClient($area,1111);
    // $calc->echoP(); 
?>