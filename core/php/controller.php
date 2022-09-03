<?php
    namespace controller;
    
    include "view.php";

    use view\websiteFiles;
    use view\erroring;
    use view\modules;

    //Routing - checking url and redirecting 

    class routing {
        private array $url;
        private string $error = "";
        function __construct(string $url = "") {
            strlen($url)==0 ? $url = $_SERVER['REQUEST_URI']: $url;
            // if you have given no value for url, it automatically assigns the url from the server.   
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
                $urlLower = strtolower($url[3]);
                switch($urlLower) { #MODIFY IN PRODUCTION ($url[3])
                    case "": //blank
                        $website = new websiteFiles("index.html","html","text/html");
                        // if($website->error()) {
                        //     $error = new erroring(404);
                        //     unset($error);
                        // }
                        unset($website);
                    break;
                    case "websites":
                        if(isset($url[4])) {
                            $html = new websiteFiles($url[4].".html","html","text/html"); # *
                            if($html->error()) {
                                $error = new erroring(404);
                                unset($error);
                            }
                            unset($html);
                        }
                    break;
                    case "scripts":
                        if(isset($url[4])) {
                            $js = new websiteFiles($url[4].".js","js","application/javascript"); # *
                            if($js->error()) {
                                $error = new erroring(404);
                                unset($error);
                            }
                            unset($js);
                        }
                    break;
                    case "styles":
                        if(isset($url[4])) {
                            $css = new websiteFiles($url[4].".css","css","text/css");  # *
                            if($css->error()) {
                                $error = new erroring(404);
                                unset($error);
                            }
                            unset($css);
                        }
                    break;
                    case "maps":
                        if(isset($url[4])) {
                            $js = new websiteFiles($url[4].".map","css","text/css"); # *
                            if($js->error()) {
                                $error = new erroring(404);
                                unset($error);
                            }
                            unset($js);
                        }
                    break;
                    case "xml":
                        if(isset($url[4])) {
                            $xml = new websiteFiles($url[4].".xml","xml","text/xml");  # *
                            if($xml->error()) {
                                $error = new erroring(404);
                                unset($error);
                            }
                            unset($xml);
                        }
                    break;
                    case "modules":  //Static for now
                        if(isset($url[4])) {
                            $modules = new modules($url[4]);
                            unset($modules);
                        }
                    // * - we don't use file extension, because we know it has to be js,css, etc.
                    break;
                    default:
                        $error = new erroring(404); //not found
                        unset($error);
                    break;
                    case "downloadmenu":
                        $newMenuAddSecond = array(
                            ["Start:", "more", 
                                [
                                    ["How to start","noMore","#start"],
                                    ["FAQ","noMore","#FAQ"]
                                ]
                                ],
                                ["Something other","noMore","#other"],
                            ["About:", "more",
                                [
                                    ["About Us","noMore","http://127.0.0.1/strony/praca/AboutUs"],
                                    ["About App","noMore","http://127.0.0.1/strony/praca/AboutApp"],
                                ],
                            ],
                            ["Contact:","more",
                                [
                                    ["Via e-mail","noMore","mailto:kowaluki1@gmail.com"],
                                    ["Via phone","noMore","tel:+48795397851"],
                                ]
                            ]
                        );
                        echo json_encode($newMenuAddSecond);
                    break;
                    case "app":
                        switch($url[4]) {
                            case "":
                                $html = new websiteFiles("app".".html","html","text/html"); # *
                                if($html->error()) {
                                    $error = new erroring(404);
                                    unset($error);
                                }
                                unset($html);
                            break;
                        }
                }
                unset($url);
                exit();
            }
            
        }
    }

?>