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
    class error {
        private $errors = array (
            [404, "not found"]
        );
        function __construct($number = "") {
            if(strlen($number)==0) {
                echo "nie";
            }
            else {
                foreach($this->errors as $error) {
                    if($number==$error[0]) {
                        echo $error[0]." - ".$error[1];
                    }
                }
            }
            
        }
        function addNew($name,$description) {
            $nowy = array(
                [$name, $description]
            );
            $array = $this->errors;
            array_push($array,$nowy);
            $this->errors = $array;
        }
        function show() {
            echo json_encode($this->errors);
        }
    }


    class userView {
        
    }

    class showRequest {

    }



?>