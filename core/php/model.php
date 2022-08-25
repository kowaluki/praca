<?php
    namespace model;

    class mojSql {

    }

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
            return $multiplier;
        }
        // private function calc() :void {
        //     $this->calculations = $this->measurement * $this->percentage;
        // }

        // public function  oblicz() {
        //     calc();
        // }
    }


?>