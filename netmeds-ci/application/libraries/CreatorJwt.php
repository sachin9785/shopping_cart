<?php
    //application/libraries/CreatorJwt.php
    require APPPATH . '/libraries/JWT.php';
    class CreatorJwt
    {
        /*************This function generate token private key**************/ 

        PRIVATE $key = "123a4a5678a90qweratyuiopmnbavcaxzaasdafghjkal"; 
        public function GenerateToken($data)
        {          
            $jwt = JWT::encode($data, $this->key);
            return $jwt;
        }
        
       /*************This function DecodeToken token **************/

        public function DecodeToken($token)
        {          
            $decoded = JWT::decode($token, $this->key, array('HS256'));
            $decodedData = (array) $decoded;
            return $decodedData;
        }
        
        public function getBearerToken($headers) {
            // HEADER: Get the access token from the header
            if (!empty($headers)) {
                if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                    return $matches[1];
                }
            }
            return null;
        }
    }