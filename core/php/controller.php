<?php
    namespace controller;

    include "view.php";
    use view\websiteFiles;

    class routing {
        private string $url;
        function __construct() {
            $this->url = "1";
            $this->launch();
        }
        function launch() {
            $website = new websiteFiles("index.html","html","text/html");
            exit();
        }
    }

?>