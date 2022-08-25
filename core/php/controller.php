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
            unset($url);
        }
        public function changeUrl(string $url) {
           $this->uta($url);
           unset($url);
        }

        private function uta($url) { # URL to array
            if(strpos($url,'/')!== false) { # does the url string have slash/es inside?
                $url = explode("/",$url); # yes, he does! split it.
                $this->url = $url;
            } else {
                $this->error = "Not explodable url."; #no, he doesn't --> ERROR
            }
            unset($url);
        }
        function launch() {
            //Launch means redirecting for inividual classess and functions.
            if(strlen($this->error)!= 0) {
                echo "Error: ".$this->error;
            }
            else {
                $url = $this->url;
                switch($url[3]) { #MODIFY IN PRODUCTION ($url[3])
                    case "": //blank
                        $website = new websiteFiles("index.html","html","text/html");
                        $unset($website);
                    break;
                    case "scripts":
                        if(isset($url[4])) {
                            $js = new websiteFiles($url[4].".js","js","application/javascript"); # *
                            if($js->error()) {
                                $error = new error(404);
                                unset($error);
                            }
                            unset($js);
                        }
                    break;
                    case "styles":
                        if(isset($url[4])) {
                            $css = new websiteFiles($url[4].".css","css","text/css");  # *
                            if($css->error()) {
                                $error = new error(404);
                                unset($error);
                            }
                            unset($css);
                        }
                    break;
                    case "xml":
                        if(isset($url[4])) {
                            $xml = new websiteFiles($url[4].".css","css","text/xml");  # *
                            if($xml->error()) {
                                $error = new error(404);
                                unset($error);
                            }
                            unset($xml);
                        }
                    break;
                    // * we don't use file extension, because we know it has to be js,css, etc.
                    default:
                        $error = new error(404); //not found
                        unset($error);
                }
                unset($url);
                exit();
            }
            
        }
    }

?>