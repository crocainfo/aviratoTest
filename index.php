<?php

$userController = new UserController();

if(!isset($GET) || isset($GET['searchClients'])){

    $view = new SeeAllClients();
    $view->show(isset($GET['searchClients']) ? $userController->getClientSearch($GET['searchClients']) : $userController->getClients());

}elseif($GET['CreateClient']){

    $view = new CreateClient();

    //Si passo la id se muestra el mismo formulario pero ya rellenado con los datos para editar
    isset($GET["ClientID"]) ? $view->show($GET["ClientID"]) : $view->show();
}else {

    switch ($GET["apiCall"]){

        case 'createClient':
            $clientData = [
                'nombre' =>           $GET["name"],
                'telefono' =>         $GET["telf"],
                'correo' =>           $GET["email"],
                'fechaNacimiento' =>  $GET["date"],
            ];
            $userController->postClient($clientData);
            break;

        case 'updateClient':
            $clientData = [
                'nombre' =>           $GET["name"],
                'telefono' =>         $GET["telf"],
                'correo' =>           $GET["email"],
                'fechaNacimiento' =>  $GET["date"],
                'id' =>  $GET["ClientID"],
            ];
            $userController->putClient($clientData);
            break;

        case 'deleteClient':
            $userController->deleteClient($GET["ClientID"]);
            break;
    
        }

        //Redirecciona a la pagina principal una vez terminada la acción con la API
        header("Location: " . "http://" . $_SERVER['HTTP_HOST']);

}