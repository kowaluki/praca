<?php
    namespace model;

    class mojSql {

    }

    class calcClient {
        private array $area; #Powierzchnia
        private int $measurement; #metraż
        private int $percentage; #procent zabrudzenia
        private array $calculations; #ostateczne kalkulacje

        function __construct(int $percentage) {
            $percentage < 0 ? $percentage = 0: $percentage = $percentage;
            $percentage > 100 ? $percentage = 100: $percentage = $percentage;
            $this->percentage = $percentage;
        }
        function echoP() {
            echo $this->percentage;
        }
    }


?>