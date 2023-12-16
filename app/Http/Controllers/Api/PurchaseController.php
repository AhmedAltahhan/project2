<?php

namespace App\Http\Controllers\Api;

use App\Events\PurchaseEventSubscriber;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use App\Services\PurchaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    public function __construct(private PurchaseService $purchaseService)
    {
    }

    public function all()
    {
        $user = auth()->user();
        $purchase = $this->purchaseService->all($user);
        return PurchaseResource::collection($purchase);
    }

    public function create(StorePurchaseRequest $request)
    {
        $user = auth()->user();
        $purchase = $this->purchaseService->store(['id' => $request?->purchase],$request->validated(),$user);
        event(new PurchaseEventSubscriber($purchase));
        Log::channel('logChannel')->info($purchase);
        return PurchaseResource::make($purchase);
    }
}
