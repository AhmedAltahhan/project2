<?php


namespace App\Services;

use App\Models\Purchase;

class PurchaseService
{
    public function all($user)
    {

        $purchase = Purchase::whereId($user->id)->with('user')->get();
        return $purchase;
    }

    public function store($id,array $data,$user)
    {
        $purchase = Purchase::updateOrCreate(['id' =>$id],[
            'user_id' => $user->id,
            'purchaseable_type' => $data['purchaseable_type'],
            'purchaseable_id' => $data['purchaseable_id'],
        ]);
        return $purchase;
    }
}
