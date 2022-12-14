<?php

    namespace view;

    include "model.php";

    use model\modules\myMenu;
    use model\modules\myFooter;

    class websiteFiles {
        // Open website files - html, css, js, sounds, pictures
        private bool $error;
        function __construct(string $fileName, string $location, string $header) {
            $this->launch($fileName,$location,$header); 
            unset($fileName,$location,$header);
        }
        private function launch($fileName, $location, $header) {
            if (!file_exists('core/'.$location.'/'.$fileName )) {
                $this->error = true;
            }
            else {
                header("Content-type: ".$header);
                try {
                    if(!require_once('core/'.$location.'/'.$fileName )) {
                        Throw new \Error ("Loading file problem");
                    }
                }
                catch (\Error $e) {
                    $this->error = $e;
                }
                $this->error = false;
            }
            unset($fileName,$location,$header);
        }
        public function error() {
            return $this->error;
        }
    }
    class erroring {
        // call a specific error.
        private $errors = array (
            [404, "not found"]
        );
        function __construct($number = "404") {
            if(strlen($number)==0) {
            }
            else {
                foreach($this->errors as $error) {
                    if($number==$error[0]) {
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <title>$error[0] - $error[1]</title>
</head>
<body>
<p>$error[0] - $error[1]</p>
<p>Back to <a href='http://127.0.0.1/strony/praca'>Home page</a>.</p> 
</body>
</html>";
//REMEMBER - IN PRODUCTION MODIFY LINK ADDRESS
                    }
                    unset($error);
                }
            }
            unset($number);
        }
    }


    class userView {
        
    }

    class showRequest {

    }

    class modules {
        function __construct(string $moduleName) {
            switch($moduleName) {
                case "navigation":
                    $menu = new myMenu();
                    $menu->downloadMenu("http://127.0.0.1/strony/praca/downloadmenu");
                    $show = $menu->createMenu();
                    echo $show;
                break;
                case "footer":
                    $footer = new myFooter();
                    $footer->downloadMenu("http://127.0.0.1/strony/praca/downloadmenu");
                    // if($footer->changeAddress("companyName",["aha"])) {
                    //     echo "tak";
                    // }
                    // else {
                    //     echo $footer->getError();
                    // }
                    $return = $footer->createFooter(['address','menu','social']);
                    echo $return;   
                break;
            }

            exit();
        }
    }



?>