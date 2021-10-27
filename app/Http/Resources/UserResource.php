<?php

namespace App\Http\Resources;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'email'        => $this->email,
            'company'      => $this->company,
            'inventaries'  => $this->inventaries,
            'role'         => User::role($this->roles_id),   
            'permisions'   => $this->permissions(),
        ];
    }

    protected function permissions()
    {
        return [
            'viewAny' => Gate::allows('viewAny', $this->resource),
            'view'    => Gate::allows('view',    $this->resource),
            'create'  => Gate::allows('create',  $this->resource),
            'update'  => Gate::allows('update',  $this->resource),
            'delete'  => Gate::allows('delete',  $this->resource),
        ];
    }
}
