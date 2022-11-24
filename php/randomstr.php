<?php
    function RandomString($length = 5, $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        $charactersLength = strlen($characters);
        $randstring = '';
        
        for ($i = 0; $i < $length; $i++) {
            $randstring .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randstring;
    }

    $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '0123456789';