<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\allCompanies;
use App\Models\User;


class CompanyController extends Controller
{
    public function index()
    {
       if(Auth::user()->roles_id === User::ADMIN_ROLE){
        return CompanyResource::collection(Company::with(['users'])->orderBy('updated_at', 'DESC')->paginate(10));
       } else {
         return CompanyResource::collection(Company::where('id', Auth::user()->company_id)->paginate());
       }
    }

    public function store(CompanyRequest $request)
    {
        Gate::authorize('create', Auth::user());
        return new CompanyResource(Company::create($request->validated()));
    }

    public function update(CompanyRequest $request, Company $company)
    {
        Gate::authorize('update', $company);
        $company->update($request->validated());
        return new CompanyResource($company);
    }

    public function destroy(Company $company)
    {
        Gate::authorize('delete', $company);
        $company->delete();
        return response('Deleted successfully', 201);
    }

    public function show(Company $company)
    {
        Gate::authorize('view', $company);
        return new CompanyResource(Company::with('users')->where('id', $company->id)->firstOrFail());
    }

    public function allCompanies()
    {
        // TODO add all lazy loading for all users
        return allCompanies::collection(Company::all());
    }
}
