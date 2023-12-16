<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePackageRequest;
use App\Http\Resources\PackageResource;
use Illuminate\Http\Request;
use App\Services\PackageService;

class PackageController extends Controller
{
    public function __construct(private PackageService $packageService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $package = $this->packageService->all();
        return PackageResource::collection($package);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageRequest $request)
    {
        $package = $this->packageService->store(['id' => $request?->package],$request->validated());
        if ($request->hasFile('image'))
        {
            $package->addMediaFromRequest('image')->toMediaCollection('package');
        }
        return response()->json(['data' => '' ,'message' => "Done"],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $package = $this->packageService->show($id);
        return PackageResource::make($package);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePackageRequest $request, string $id)
    {
        $package = $this->packageService->store(['id' => $request?->package],$request->validated());
        if ($request->hasFile('image'))
        {
            $package->addMediaFromRequest('image')->toMediaCollection('package');
        }
        return PackageResource::make($package);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->packageService->destroy($id);
        return response()->json(['data' => '' ,'message' => "Done"],200);
    }
}
