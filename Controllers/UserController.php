<?php
namespace controllers;

use APIController;

class UserController
{
    protected $apiController;

    public function __construct(){
        $this->apiController = new APIController();
    }

    public function getClients(){
        $url = $this->apiController->getFUllUrl(APIController::GET_CLIENTS_PATH);

        return $this->apiController->apiCall('get', $url);

    }

    public function getClientByID($id){
        $url = $this->apiController->getFUllUrl(APIController::GET_ONE_CLIENT_PATH) . $id;

        return $this->apiController->apiCall('get', $url);
    }

    public function getClientSearch($search){

        $url = $this->apiController->getFUllUrl(APIController::GET_CLIENTS_SEARCH_PATH). '/' . $search;

        return $this->apiController->apiCall('get', $url);
    }

    public function postClient($cliendData){

        $encodeDataBody = json_encode($clientData);
        $url = $this->apiController->getFUllUrl(APIController::POST_CLIENTS_PATH);

        return $this->apiController->apiCall('post', $url, $encodeDataBody);

    }
    public function putClient($clientData)
    {
        $encodeDataBody = json_encode($clientData);
        $url = $this->apiController->getFUllUrl(APIController::PUT_CLIENTS_PATH);

        return $this->apiController->apiCall('put', $url, $encodeDataBody);
    }

    public function deleteClient($id)
    {
        $url = $this->apiController->getFUllUrl(APIController::DELETE_CLIENT_PATH) . $id;

        return $this->apiController->apiCall('delete', $url);
    }
}
