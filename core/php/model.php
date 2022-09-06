<?php
    namespace model\functions;

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
                    case"flooring":    #posadzka
                    case"lawn":        #trawnik
                        $multiplier += 1;
                    break;
                    case"concrete":    #beton
                    case"paved":       #bruk
                    case"brick":       #mur
                        $multiplier += 2;
                    break;
                    case"asphalt":     #asfalt
                    case"agricult":    #pole rolne
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
    function array_equal($a, $b) {
        return (
             is_array($a) 
             && is_array($b) 
             && count($a) == count($b) 
        );
    }

    function domainToNumber($domain) {
        $domain = strtolower($domain);
        $code;
        switch($domain) {
            case"ac":$code="+247";break;
            case"ad":$code="+376";break;
            case"ae":$code="+971";break;
            case"af":$code="+93";break;
            case"ag":$code="+1268";break;
            case"ai":$code="+1264";break;
            case"al":$code="+355";break;
            case"am":$code="+374";break;
            case"ao":$code="+244";break;
            case"aq":$code="+672";break;
            case"ar":$code="+54";break;
            case"as":$code="+1684";break;
            case"at":$code="+43";break;
            case"au":$code="+61";break;
            case"aw":$code="+297";break;
            case"ax":$code="+358";break;
            case"pl":
                $code = "+48";
            break;
            case"en":
                $code = "+44";
            break;
            case"de":
                $code = "+49";
            break;
            case"cz":
                $code ="+420";
            break;
            case"sk":
                $code = "$421";
            break;
            case"si":
                $code = "+386";
            break;
            case"ru":
                $code = "+7";
            break;
            case"it":
                $code = "+39";
            break;
            case"fr":
                $code = "+33";
            break;
        }
        return $code;
    } 

    namespace model\modules;

    use function model\functions\httpPost;
    use function model\functions\domainToNumber;
    use function model\functions\array_equal;

    class myMenu {
        protected string $firstMarkup = "ul";
        protected string $secondMarkup = "li";
        protected string $thirdMarkup = "a";
        protected string $error;
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
        public function addMenu(array $menu, bool $add = false) {
            $add === true ? array_push($this->menu, $menu): $this->menu = $menu;
        }
        public function getError() {
            return $this->error;
        }
        //Download menu from other source: GET or POST
        public function downloadMenu(string $url = "/downloadData", bool $add = false, array $data = []) {
            $response;
            if(count($data)==0) {
                $response = httpPost($url, $data);
            }
            else {
                strtolower($data[0]);
                switch($data[0]){
                    case "get":
                        $response = http_get($url);
                    break;
                    case "post":
                        $response = httpPost($url, $data);
                    break;
                }
            }
            $response = json_decode($response);
            $this->addMenu($response,$add);
        }

        //Changing default markups for presenting data in other ways (default: ul, li), examples in index.php
        public function changeMarkups(string $check, string $newValue = "") {
            switch($check) {
                case"first":
                    $this->firstMarkup = $newValue;
                break;
                case"second":
                    $this->secondMarkup = $newValue;
                break;
                case"third":
                    $this->thirdMarkup = $newValue;
                break;
                case"default":
                    $this->firstMarkup = "ul";
                    $this->secondMarkup = "li";
                    $this->thirdMarkup = "a";
            }
        }

        //Creating menu from Array to String
        public function createMenu(string $type = "numeric") { //CSS
            $first = "<div class='menu'><$this->firstMarkup style='list-style-type:$type;'>";
            $menu = $first;
            $menu .= $this->subset($this->menu,1);
            $menu .= "</$this->firstMarkup></div>";
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
    class mySocial extends myMenu {
        protected array $social = array(
            ["social 1","https://www.social1.com/myAccount"],
            ["social 2","https://www.social2.com/myAccount"],
            ["social 3","https://www.social3.com/myAccount"]
        );
        function __construct(array $social = array()) {
            $flag = false;
            foreach($social as $soc) {
                if(count($soc)!=2) {
                    $flag = true;
                }
            }
            if($flag) {
                $this->error = "not recomended array";
            }
            else {
                $this->social = $social;
            }
        }
        protected function addSocial(string $name,string $link) {
            $new = array($name,$link);
            array_push($this->social,$new);
            unset($new,$name,$link);
        }
        protected function createSocial() {
            $soc = "";
            foreach($this->social as $social) {
                $soc .= "<div><$this->thirdMarkup href='$social[1]'>$social[0]</$this->thirdMarkup></div>";
            }
            return $soc;
        }
    }
    class myAddress extends mySocial {
         protected array $address = array(
            "companyName" => "COMPANY NAME",
            "companyAddress" => [
                "town",
                "street",
                "postalCode",
                "postalCity",
                "TIN",
                "REGON"
            ],
            "companyContact" => array(
                "tel" => ["numer","kod kraju"],
                "E-mail" => "email@email.com"
            )
        );
        function __construct(array $address = ["companyName" => "companyName",
        "companyAddress" => ["miasto","12345","kod pocztowy","miasto","nip","regon"],
        "companyContact" => array("tel" => ["numer","EN"], "E-mail" => "email@email.com")]) {
            if(
                isset($address['companyName']) &&
                isset($address['companyAddress']) &&
                count($address['companyAddress'])==6 &&
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
        protected function createAddress() {
            $address = $this->address;
            $tel = domainToNumber($address['companyContact']['tel'][1]);
            $return = "<address>";
            $return .= "<p>".$address['companyName']."</p>";
            $return .= "<p>".$address['companyAddress'][0].", ".$address['companyAddress'][1]."</p>";
            $return .= "<p>".$address['companyAddress'][2].", ".$address['companyAddress'][3]."</p>";
            $return .= "<p>E-mail:".$address['companyContact']['E-mail']."</p>";
            $return .= "<p>Phone number:".$tel.$address['companyContact']['tel'][0]."</p>";
            $return .= "<p>TIN: ".$address['companyAddress'][4]."</p>";
            $return .= "<p>REGON number: ".$address['companyAddress'][5]."</p>";
            return $return;
        }
    }

    class myFooter extends myAddress {
        public function createFooter(array $position) {
            $menu = $this->createMenu();
            $address = $this->createAddress();
            $social = $this->createSocial();    
            $footer = "<div class='footer row justify-content-md-around'>";
            foreach($position as $pos) {
                switch($pos) {
                    case"menu":
                        $footer.="<div class='col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3'>$menu</div>";
                    break;
                    case"address":
                        $footer.="<div class='col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3'>$address</div>";
                    break;
                    case"social":
                        $footer.="<div class='col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3'>$social</div>";
                    break;
                }
            }
            $footer .= "</div>";
            return $footer;
        }

        
    }

    
?>