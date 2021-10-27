<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CompanyUsersResource;
use Illuminate\Support\Facades\Gate;

class CompanyResource extends JsonResource
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
            'id'   => $this->id,
            'name' => $this->name,
            'users' => CompanyUsersResource::collection($this->users),
            'permisions' => $this->permissions(),
        ];
    }

    protected function permissions()
    {
        return [
            'view'    => Gate::allows('view',    $this->resource),
            'create'  => Gate::allows('create',  $this->resource),
            'update'  => Gate::allows('update',  $this->resource),
            'delete'  => Gate::allows('delete',  $this->resource),
        ];
    }
}
