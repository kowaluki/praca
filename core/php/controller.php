<?php
    namespace controller;
    include_once "view.php";
    use view\websiteFiles;
    use view\error;


    //Routing - checking url and redirecting 

    class routing {
        private array $url;
        private string $error = "";
        function __construct(string $url = "") {
            strlen($url)==0 ? $url = $_SERVER['REQUEST_URI']: $url; #if you have given no value for url, it autmatically assigns the url from the server.   
            $this->uta($url); #uta = Url to array
        }
        public function changeUrl(string $url) {
           $this->uta($url);
        }

        private function uta($url) { # URL to array
            if(strpos($url,'/')!== false) { # does the url string have slash inside?
                $url = explode("/",$url); # yes, he does! split it.
                $this->url = $url;
            } else {
                $this->error = "Not explodable url."; #no, he doesn't --> ERROR
            }
        }
        function launch() { #Launch means redirecting for inividual classess and functions.
            if(strlen($this->error)!= 0) {
                echo "Error: ".$this->error;
            }
            else {
                $url = $this->url;
                switch($url[3]) {
                    case "":
                    $website = new websiteFiles("index.html","html","text/html");
                    break;
                    default:
                        $error = new error(404);

                }
            }
            
        }
    }

?>