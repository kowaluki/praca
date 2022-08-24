<?php
    namespace controller;
    include_once "view.php";
    use view\websiteFiles;
    use view\error;

    class routing {
        private array $url;
        private string $error = "";
        function __construct(string $url = "") {
            strlen($url)==0 ? $url = $_SERVER['REQUEST_URI']: $url;
            $this->uta($url); #Url to array
        }
        public function changeUrl(string $url) {
           $this->uta($url);
        }

        private function uta($url) {
            if(strpos($url,'/')!== false) {
                $url = explode("/",$url);
                $this->url = $url;
            } else {
                $this->error = "Not explodable url.";
            }
        }
        function launch() {
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
                        $error = error->show();
                }
            }
            
        }
    }

?>