<?php

    require("model/CalculDistance.php");
    class CalculDistanceImpl implements CalculDistance{
        
        
        public function calculDistance2PointsGPS($lat1, $long1, $lat2, $long2){
            $R=6378.137;
            $lat1 = pi()*$lat1/180;
            $long1 = pi()*$long1/180;
            $lat2 = pi()*$lat2/180;
            $long2 = pi()*$long2/180;
            $d = $R*acos(sin($lat2)*sin($lat1)+cos($lat2)*cos($lat1)*cos($long2-$long1));
            
            return $d;
        }

        public function calculDistanceTrajet(Array $parcours){
            $distanceT = 0;
            for($i=1; $i<sizeof($parcours); $i++){
                $distanceT += $this->calculDistance2PointsGPS($parcours[$i-1]['latitude'], $parcours[$i-1]['longitude'], $parcours[$i]['latitude'], $parcours[$i]['longitude']);
            }

            return $distanceT;
        }
    }

?>