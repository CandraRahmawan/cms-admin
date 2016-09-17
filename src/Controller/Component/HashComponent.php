<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class HashComponent extends Component {

    public function setPassword($password) {
        $count_password = strlen($password);
        $random_password = strtoupper($password);

        //random password
        for ($i = 0; $i < $count_password; $i++) {
            if ($random_password[$i] === "A") {
                $random_password[$i] = "B";
            } elseif ($random_password[$i] === "B") {
                $random_password[$i] = "C";
            } elseif ($random_password[$i] === "C") {
                $random_password[$i] = "D";
            } elseif ($random_password[$i] === "D") {
                $random_password[$i] = "E";
            } elseif ($random_password[$i] === "E") {
                $random_password[$i] = "F";
            } elseif ($random_password[$i] === "F") {
                $random_password[$i] = "G";
            } elseif ($random_password[$i] === "G") {
                $random_password[$i] = "H";
            } elseif ($random_password[$i] === "H") {
                $random_password[$i] = "I";
            } elseif ($random_password[$i] === "I") {
                $random_password[$i] = "J";
            } elseif ($random_password[$i] === "J") {
                $random_password[$i] = "K";
            } elseif ($random_password[$i] === "K") {
                $random_password[$i] = "L";
            } elseif ($random_password[$i] === "L") {
                $random_password[$i] = "M";
            } elseif ($random_password[$i] === "M") {
                $random_password[$i] = "N";
            } elseif ($random_password[$i] === "N") {
                $random_password[$i] = "O";
            } elseif ($random_password[$i] === "O") {
                $random_password[$i] = "P";
            } elseif ($random_password[$i] === "P") {
                $random_password[$i] = "Q";
            } elseif ($random_password[$i] === "Q") {
                $random_password[$i] = "R";
            } elseif ($random_password[$i] === "R") {
                $random_password[$i] = "S";
            } elseif ($random_password[$i] === "S") {
                $random_password[$i] = "T";
            } elseif ($random_password[$i] === "T") {
                $random_password[$i] = "U";
            } elseif ($random_password[$i] === "U") {
                $random_password[$i] = "V";
            } elseif ($random_password[$i] === "V") {
                $random_password[$i] = "W";
            } elseif ($random_password[$i] === "W") {
                $random_password[$i] = "X";
            } elseif ($random_password[$i] === "X") {
                $random_password[$i] = "Y";
            } elseif ($random_password[$i] === "Y") {
                $random_password[$i] = "Z";
            } elseif ($random_password[$i] === "Z") {
                $random_password[$i] = "A";
            } elseif ($random_password[$i] === "0") {
                $random_password[$i] = "1";
            } elseif ($random_password[$i] === "1") {
                $random_password[$i] = "2";
            } elseif ($random_password[$i] === "2") {
                $random_password[$i] = "3";
            } elseif ($random_password[$i] === "3") {
                $random_password[$i] = "4";
            } elseif ($random_password[$i] === "4") {
                $random_password[$i] = "5";
            } elseif ($random_password[$i] === "5") {
                $random_password[$i] = "6";
            } elseif ($random_password[$i] === "6") {
                $random_password[$i] = "7";
            } elseif ($random_password[$i] === "7") {
                $random_password[$i] = "8";
            } elseif ($random_password[$i] === "8") {
                $random_password[$i] = "9";
            } elseif ($random_password[$i] === "9") {
                $random_password[$i] = "0";
            }
        }

        //encrypt password
        $hash = hash("whirlpool", $random_password);
        $hash_uppercase = strtoupper($hash);
        //random hash
        for ($i = 0; $i < 128; $i++) {
            if ($hash_uppercase[$i] === "A") {
                $hash_uppercase[$i] = "B";
            } elseif ($hash_uppercase[$i] === "B") {
                $hash_uppercase[$i] = "C";
            } elseif ($hash_uppercase[$i] === "C") {
                $hash_uppercase[$i] = "D";
            } elseif ($hash_uppercase[$i] === "D") {
                $hash_uppercase[$i] = "E";
            } elseif ($hash_uppercase[$i] === "E") {
                $hash_uppercase[$i] = "F";
            } elseif ($hash_uppercase[$i] === "F") {
                $hash_uppercase[$i] = "G";
            } elseif ($hash_uppercase[$i] === "G") {
                $hash_uppercase[$i] = "H";
            } elseif ($hash_uppercase[$i] === "H") {
                $hash_uppercase[$i] = "I";
            } elseif ($hash_uppercase[$i] === "I") {
                $hash_uppercase[$i] = "J";
            } elseif ($hash_uppercase[$i] === "J") {
                $hash_uppercase[$i] = "K";
            } elseif ($hash_uppercase[$i] === "K") {
                $hash_uppercase[$i] = "L";
            } elseif ($hash_uppercase[$i] === "L") {
                $hash_uppercase[$i] = "M";
            } elseif ($hash_uppercase[$i] === "M") {
                $hash_uppercase[$i] = "N";
            } elseif ($hash_uppercase[$i] === "N") {
                $hash_uppercase[$i] = "O";
            } elseif ($hash_uppercase[$i] === "O") {
                $hash_uppercase[$i] = "P";
            } elseif ($hash_uppercase[$i] === "P") {
                $hash_uppercase[$i] = "Q";
            } elseif ($hash_uppercase[$i] === "Q") {
                $hash_uppercase[$i] = "R";
            } elseif ($hash_uppercase[$i] === "R") {
                $hash_uppercase[$i] = "S";
            } elseif ($hash_uppercase[$i] === "S") {
                $hash_uppercase[$i] = "T";
            } elseif ($hash_uppercase[$i] === "T") {
                $hash_uppercase[$i] = "U";
            } elseif ($hash_uppercase[$i] === "U") {
                $hash_uppercase[$i] = "V";
            } elseif ($hash_uppercase[$i] === "V") {
                $hash_uppercase[$i] = "W";
            } elseif ($hash_uppercase[$i] === "W") {
                $hash_uppercase[$i] = "X";
            } elseif ($hash_uppercase[$i] === "X") {
                $hash_uppercase[$i] = "Y";
            } elseif ($hash_uppercase[$i] === "Y") {
                $hash_uppercase[$i] = "Z";
            } elseif ($hash_uppercase[$i] === "Z") {
                $hash_uppercase[$i] = "A";
            } elseif ($hash_uppercase[$i] === "0") {
                $hash_uppercase[$i] = "1";
            } elseif ($hash_uppercase[$i] === "1") {
                $hash_uppercase[$i] = "2";
            } elseif ($hash_uppercase[$i] === "2") {
                $hash_uppercase[$i] = "3";
            } elseif ($hash_uppercase[$i] === "3") {
                $hash_uppercase[$i] = "4";
            } elseif ($hash_uppercase[$i] === "4") {
                $hash_uppercase[$i] = "5";
            } elseif ($hash_uppercase[$i] === "5") {
                $hash_uppercase[$i] = "6";
            } elseif ($hash_uppercase[$i] === "6") {
                $hash_uppercase[$i] = "7";
            } elseif ($hash_uppercase[$i] === "7") {
                $hash_uppercase[$i] = "8";
            } elseif ($hash_uppercase[$i] === "8") {
                $hash_uppercase[$i] = "9";
            } elseif ($hash_uppercase[$i] === "9") {
                $hash_uppercase[$i] = "0";
            }
        }

        $result = $hash_uppercase;
        return $result;
    }

}
