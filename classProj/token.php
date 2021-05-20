<?php 

  class Token{
    
    static $ciphering = "dekelmontilia";
    static $secret_key = "dekel123";
    static $encryption_iv ='Dd04061998';
   

   
    static function genToken($user_id, $expired = 60*60){
    
      $timeExpired = time()+$expired;
      $token = openssl_encrypt($user_id."---".$timeExpired, self::$ciphering,
           self::$secret_key, 0, self::$encryption_iv);
        return $token;
    }

   static function validateToken($token) {
      $decodeToken = openssl_decrypt($token, self::$ciphering,self::$secret_key, 0, self::$encryption_iv);
    
      $arToken = explode("---",$decodeToken);
      
      if(count($arToken) < 2){
        return NULL;
      }
      
      if($arToken[1] > time()){
        
        return $arToken[0];
      }
      else{
        return NULL;
      }
    }
  }