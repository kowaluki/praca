<?php
    namespace model;

    class mojSql {

    }

    class calcClient {
        private string $area; #Powierzchnia
        private int $measurement; #metraż
        private int $percentage; #procent zabrudzenia
        private int $calculations; #ostateczne kalkulacje

        function __construct($areas, $percentage) {
            #valid $percentage
            // echo "aha";
            $percentage < 0 ? $percentage = 0: $percentage = $percentage;
            $percentage > 100 ? $percentage = 100: $percentage = $percentage;
            $this->percentage = $percentage;
            $this->area = $this->validArea($areas);
            echo $this->area;
        }
        #valid area
        private function validArea($areas) {
            $multiplier = 0;
            foreach($areas as $area) {
                switch($area) {
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