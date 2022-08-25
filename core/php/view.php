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
                    }
                }
            }
        }
    }


    class userView {
        
    }

    class showRequest {

    }



?>