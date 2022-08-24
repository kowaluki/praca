<?php

    namespace controller;

    class routing {
        private string $url;
        function __contruct() {
            $this->url = $_SERVER['REQUEST_URI'];
        }
        function launch() {
            
        }
    }

?>