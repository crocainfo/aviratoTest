<?php
namespace controllers;

class APIController
{
    //Otra manera que se me ocurre para guardar las url de las apis y que sea mas accessible seria mediante un fichero de configuración


    const MAIN_SERVER = 'https://examen.avirato.com';
    const AUTH_PATH = '/auth/login';
    const PUT_CLIENTS_PATH = '/client/put';
    const POST_CLIENTS_PATH = '/client/post';
    const GET_CLIENTS_PATH = '/client/get';
    const GET_ONE_CLIENT_PATH = '/client/get/one/';
    const GET_CLIENTS_SEARCH_PATH = '/client/get/search';
    const DELETE_CLIENT_PATH = '/client/delete/';

    const USER = 'crocainfo@gmail.com';
    const PASSWORD = '635584690';

    
    public function getAuth($usr, $pass){
        $body = json_encode(["email"=> $usr, "password" => $pass]);
        $url = $this->getUrlFromConstName(self::AUTH_PATH);

        
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL,            $url );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($curl, CURLOPT_POST,           1 );
        curl_setopt($curl, CURLOPT_POSTFIELDS,     $body ); 
        curl_setopt($curl, CURLOPT_HTTPHEADER,     array('Content-Type: text/plain')); 
        
        //Me falta testear que llega, asumo que es un Auth Token
        $result = curl_exec($curl);

        curl_close($curl);
        return $result;
    }


    public function apiCall($httpMethod, $url, $body = null){

        $token = $this->getAuth(self::USER, self::PASSWORD);

        if($token){
            $authorization = "Authorization: Bearer $token";
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, $url );
            curl_setopt($curl, CURLOPT_HTTPHEADER,     array('Content-Type: text/plain')); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

            if($body != null) curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

            


            
            switch($httpMethod){

                case 'post':

                    curl_setopt($curl, CURLOPT_POST, 1 );

                    break;

                case 'get':

                    curl_setopt($curl, CURLOPT_GET, 1 );

                    break;

                case 'put':
                   curl_setopt($curl, CURLOPT_PUT, 1 );

                    break;

                case 'delete':
                    curl_setopt($curl, CURLOPT_DELETE, 1 );
    
                        break;

            }


            $result = curl_exec($curl);

            curl_close($curl);
            return $result;


        }else{

            return;
        }


    }


    public function getFUllUrl($apiPath){
        return $url = self::MAIN_SERVER . $apiPath;
    }
}