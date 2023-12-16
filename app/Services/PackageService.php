<?php


namespace App\Services;

use App\Models\Package;

class PackageService
{
    public function all()
    {
        $package = Package::with(['media'])->get();
        return $package;
    }

    public function store($id,array $data)
    {
        $package = Package::updateOrCreate(['id' =>$id],[
            'name' => $data['name'],
        ]);
        return $package;
    }

    public function show(string $id)
    {
        $package = Package::with('media')->FindOrFail($id);
        return $package;
    }

    public function destroy($id)
    {
        Package::whereId($id)->delete();
    }
}
