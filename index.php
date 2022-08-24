<?php

    include "core/php/controller.php";
    include "core/php/view.php";
    include "core/php/model.php";

    use model\calcClient;

    $calc = new calcClient(1111);
    $calc->echoP();

?>