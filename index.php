<?php

    include "core/php/controller.php";
    include "core/php/view.php";
    include "core/php/model.php";

    use model\calcClient;

    $area = ["flooring","brick"];
    $calc = new calcClient($area,1111);
    $calc->echoP();

?>