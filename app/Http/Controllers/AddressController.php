<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\AddressClient;
use App\Models\Client;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AddressController extends Controller
{

    public function addAddress(AddressRequest $request){
        $request->validated();
        $address = Address::create([
            'address' => $request->address
        ]);

        $client_address = AddressClient::create([
            'client_id' => $request->client_id,
            'address_id' => $address->id
        ]);


    }
    public function showClientAddresses($id)
    {
        try {
            $clients = Client::find($id);
            return AddressResource::collection($clients->addresses);
        } catch (\Throwable $e) {
            throw new HttpException(500, $e->getCode());
        }
    }


}
