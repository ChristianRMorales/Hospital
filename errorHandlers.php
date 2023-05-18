<?php
    class err{


        public function isEmpty($variable){
            $result = null;

            if(!empty($variable)){
                $result = false;
            }else{
                $result = true;
            }

            return $result;
        }

        public function invalidId($variable){
            $result = null;

            if(preg_match("/^[0-9]*$/",$variable)){
                $result = false;
            }else{
                $result = true;
            }

            return $result;
        }

        public function isInt($variable){
            $result = null;

            if(preg_match("/^[0-9]*$/",$variable)){
                $result = false;
            }else{
                $result = true;
            }

            return $result;
        }

        public function invalidUId($variable){
            $result = null;

            if(preg_match("/^[a-zA-Z0-9]*$/",$variable)){
                $result = false;
            }else{
                $result = true;
            }

            return $result;
        }

        public function invalidEmail($variable){
            $result = null;

            if(!filter_var($variable, FILTER_VALIDATE_EMAIL)){
                $result = false;
            }else{
                $result = true;
            }

            return $result;
        }


        public function pwdMatch($variable, $variableRepeat){
            $result = null;

            if($variable !== $variableRepeat){
                $result = false;
            }else{
                $result = true;
            }

            return $result;
        }


    }



?>