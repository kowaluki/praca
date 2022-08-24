<?php
    namespace view;

    class websiteFiles {
        function __construct(string $fileName, string $location, string $header) {
            $this->launch($fileName,$location,$header);
        }
        private function launch($fileName, $location, $header) {
            header("Content-type: ".$header);
            require_once "core/".$location."/".$fileName;
        }
    }


    class userView {
        
    }

    class showRequest {

    }



?>