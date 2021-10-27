<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryRequest;
use App\Models\Inventory;
use App\Models\Inventoryitem;
use App\Policies\InventoryItemPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Resources\UserInventoryResource;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Inventoryitem[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        // $user = Auth::user()->id;
        Gate::authorize('view' , Auth::user());
        return Inventoryitem::orderby('created_at', 'DESC')->get();
    }

    /**
     For searching Items
     */

    public function search($name)
    {
        $user = Auth::user()->id;

        return Inventoryitem::where('name', 'like' , '%'.$name.'%')->where('user_id', $user)->get();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventoryRequest $request)
    {
        Gate::authorize('create' , Auth::user());
        $attributes = $request->validated();
        return Inventoryitem::create($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('view' , Auth::user());
        return Inventoryitem::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(InventoryRequest $request, $id)
    {
        Gate::authorize('updateInventory' , Auth::user());

        $request->validated();
        Inventoryitem::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'user_id' => $request->input('user_id'),
                'serial_number' => $request->input('serial_number'),
                'price' => $request->input('price')
            ]);

        return $request;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return int
     */
    public function destroy($id)
    {
        Gate::authorize('deleteInventory' , Auth::user());
        return Inventoryitem::destroy($id);
    }
}
