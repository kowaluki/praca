<?php
    namespace model;

    //Special calculator to calculate the valuation for the cleaned area

    class calcClient {
        private string $surface; #Powierzchnia
        private int $measurement; #metraż
        private int $percentage; #procent zabrudzenia
        private int $calculations; #ostateczne kalkulacje

        function __construct($surfaces, $percentage) {
            //Valid percentage (0 -100)
            $percentage < 0 ? $percentage = 0: $percentage = $percentage;
            $percentage > 100 ? $percentage = 100: $percentage = $percentage;
            $this->percentage = $percentage;
            //Valid area
            $this->surface = $this->validSurfaces($surfaces);
            unset($percentage, $surfaces);
        }
        private function validSurfaces($surfaces) { //Valid surface

            //Value depends on the selected surface

            $multiplier = 0;
            foreach($surfaces as $surface) {
                switch($surface) {
                    case "flooring":    #posadzka
                    case "lawn":        #trawnik
                        $multiplier += 1;
                    break;
                    case "concrete":    #beton
                    case "paved":       #bruk
                    case "brick":       #mur
                        $multiplier += 2;
                    break;
                    case "asphalt":     #asfalt
                    case "agricult":    #pole rolne
                        $multiplier += 3;
                    break;
                }
            }
            unset($surfaces);
            return $multiplier;
        }
        // private function calc() :void {
        //     $this->calculations = $this->measurement * $this->percentage;
        // }

        // public function  oblicz() {
        //     calc();
        // }
    }
    
    function httpPost($url, $data)
    {
        //$data = array('key1' => 'value1', 'key2' => 'value2');
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    namespace model\modules;

    class myMenu {
        protected string $firstMarkup = "ul";
        protected string $secondMarkup = "li";
        protected string $thirdMarkup = "a";

        //Example menu
        protected array $menu = array(
            ["Home page","noMore","http://127.0.0.1/strony/praca/"],
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
                ],
            ["Portfolio","noMore","http://127.0.0.1/strony/praca/portfolio"],
            
        );

        //Add menu or update
        public function addMenu(array $menu, bool $add = false) :void {
            $add === true ? array_push($this->menu, $menu): $this->menu = $menu;
        }

        //Download menu from other source: GET or POST
        public function downloadMenu(string $url = "/downloadData", bool $add = false, array $data = []) :void {
            count($data)==0 ? $response = http_get($url): $response = httpPost($url, $data);
            $this->addMenu($response,$add);
        }

        //Changing default markups for presenting data in other ways (default: ul, li), examples in index.php
        public function changeMarkups(string $check, string $newValue = "") {
            switch($check) {
                case "first":
                    $this->firstMarkup = $newValue;
                break;
                case "second":
                    $this->secondMarkup = $newValue;
                break;
                case "third":
                    $this->thirdMarkup = $newValue;
                break;
                case "default":
                    $this->firstMarkup = "ul";
                    $this->secondMarkup = "li";
                    $this->thirdMarkup = "a";
            }
        }

        //Creating menu from Array to String
        public function createMenu(string $type = "numeric") { //CSS
            $first = "<$this->firstMarkup style='list-style-type:$type;'>";
            $menu = $first;
            $menu .= $this->subset($this->menu,1);
            $menu .= "</$this->firstMarkup>";
            return $menu;
        }

        //List nesting
        protected function subset($menu, $order) { //
            $i = 0;
            $return = "";
            foreach($menu as $subset) {
                if($subset[1]==="more") {
                    $return .= "<div class='order' id='$order' tabindex='0'><$this->secondMarkup>$subset[0]</$this->secondMarkup>";
                    $return .= "<$this->firstMarkup>";
                    $order = $order.$i;
                    $return .= $this->subset($subset[2],$order);
                    $return .= "</$this->firstMarkup>";
                    $return .= "</div>";
                }
                elseif($subset[1]==="noMore") {
                    $return .= "<$this->thirdMarkup href='$subset[2]'><$this->secondMarkup>$subset[0]</$this->secondMarkup></$this->thirdMarkup>";
                }
                $i++;
            }
            return $return;
        }
    }

    class myFooter extends myMenu {

        protected array $address = array(
            "companyName" => "nazwa firmy",
            "companyAddress" => ["miasto, ul./al. nazwa nr.dom./nr.miesz.","kod pocztowy, miasto","nip","regon"],
            "companyContact" => array("tel" => ["numer","kod kraju"], "E-mail" => "email@email.com")
        );
        protected string $error;
        function __construct(array $address = ["companyName" => "companyName",
        "companyAddress" => ["miasto","ul./al. nazwa","nr.dom","nr.miesz.","kod pocztowy","miasto","nip","regon"],
        "companyContact" => array("tel" => ["numer","EN"], "E-mail" => "email@email.com")]) {
            if(
                isset($address['companyName']) &&
                isset($address['companyAddress']) &&
                count($address['companyAddress'])==8 &&
                isset($address['companyContact']['tel'])&&
                isset($address['companyContact']['E-mail']) && 
                count($address['companyContact']['tel'])==2 &&
                strlen($address['companyContact']['tel'][1])==2
            )
            {
                $this->address = $address;
            }
            else {
                $this->error = "conditions not met";
            }
        }
        public function changeAddress(string $type, $data) {
            if(isset($this->address[$type])) {
                if(is_array($this->address[$type])) {
                    if(array_equal($data,$this->address[$type])) {
                        $this->address[$type] = $data;
                        return true;    
                    }
                    else {
                        $this->error = "not equal arrays";
                        return false;
                    }
                }
                elseif(is_array($data)) {

                    $this->error = "not recomended array";
                    return false;
                }
                elseif(is_string($data) && is_string($this->address[$type])) {
                   return true;
                }
            }
            else {
                $this->error = "Not found this type.";
                return false;
            }
        }
        public function getError() {
            return $this->error;
        }

    }

    function array_equal($a, $b) {
        return (
             is_array($a) 
             && is_array($b) 
             && count($a) == count($b) 
        );
    }
?>