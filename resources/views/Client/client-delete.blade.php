@include('layouts.delete-form', [
    'route' => ['client_remove', $client->id],
    'route_cxl' =>'clients',
    'form_title' => 'Supprimer un client',
    'method' => 'DELETE',
    'submit' => 'Modifier',
    'model_infos' =>$client->firstname.$client->lastname.'('.$client->email.')'
    ])

