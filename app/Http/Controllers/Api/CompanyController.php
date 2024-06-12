<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Job;
use App\Models\MemberCompany;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    public function listCompany(request $request): JsonResponse
    {
        $userId = $request->input('userId');
        $searchString = $request->input('searchString');
        $take = $request->input('take', 10);

        $finalCompanys = [];

        try {
            $user = User::where('id', $userId)
                ->select('id', 'role')
                ->first();

            if ($user && $user->role === 'GOD') {
                $whereSearch = $searchString ? ['name', 'LIKE', "%$searchString%"] : [];

                $company_List = Company::where($whereSearch)
                    ->take($take)
                    ->select('id', 'name', 'slug', 'logo')
                    ->orderBy('slug', 'asc')
                    ->get();

                $finalCompanys = $company_List->map(function ($company) {
                    return [
                        'value' => $company->id,
                        'label' => $company->name,
                        'company' => [
                            'id' => $company->id,
                            'name' => $company->name,
                            'slug' => $company->slug,
                            'logo' => $company->logo,
                            'role' => 'GOD MODE',
                        ],
                    ];
                });
            } else {
                $whereSearch = $searchString ? ['name', 'LIKE', "%$searchString%"] : [];


                $userCompany = MemberCompany::where('userId', $userId)
                    ->orderBy('updated_at', 'asc')
                    ->first();
                if (empty($userCompany)) {
                    $finalCompanys = collect([]);
                } else {
                    $company_List = Company::where('id', $userCompany->companyId)
                        ->where($whereSearch)
                        ->take($take)
                        ->select('id', 'name', 'slug', 'logo')
                        ->orderBy('slug', 'asc')
                        ->get();

                    $finalCompanys = $company_List->map(function ($company) use ($userCompany) {
                        return [
                            'value' => $company->id,
                            'label' => $company->name,
                            'company' => [
                                'id' => $company->id,
                                'name' => $company->name,
                                'slug' => $company->slug,
                                'logo' => $company->logo,
                                'role' => $userCompany->role,
                            ],
                        ];
                    });
                }
            }

            return response()->json($finalCompanys);
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
                'message' => 'Error occurred while fetching company_'
            ], 400);
        }
    }

    public function jobsCompany(Request $request): JsonResponse
    {

        try {
            $company = Company::all();
            return response()->json($company);
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
                'message' => 'Error occurred while fetching companies'
            ], 400);
        }
    }

    public function getListCompanies(Request $request): JsonResponse
    {
        $skip = $request->input("skip", 0);
        $take = $request->input("take", 10);
        $searchText = $request->input("searchText", '');
        $whereSearch = $searchText
            ? [['name', 'like', '%' . $searchText . '%']]
            : [];
        try {
            $query = Company::query();
            if (!empty($searchText)) {
                $query->where('name', 'like', '%' . $searchText . '%');
            }
            $companies = $query->where($whereSearch)->skip($skip)->take($take)->get();
            $totalCompany = $query->count();
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
                'message' => 'Error occurred while fetching companies'
            ], 400);
        }

        return response()->json(["total" => $totalCompany, "data" => $companies]);
    }

    public function createCompany(request $request): JsonResponse
    {
        $data = $request->validate([
            'userId' => ['required'],
            'name' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'slug' => ['required', 'unique:companies', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'logo' => ['required', 'string',],
            'url' => ['required', 'string'],
            'industry' => ['string'],
            'twitter' => ['string'],
            'bio' => ['string'],
        ]);

        try {
            if ($request->user()->id != $request->userId) {
                throw new \Exception('Error');
            }

            $company = Company::create($data);

            MemberCompany::create([
                'userId' => $request->user()->id,
                'companyId' => $company->id,
                'role' => 'ADMIN',
            ]);

            User::where('id', $data['userId'])->update([
                'currentCompanyId' => $company->id,
            ]);

            return response()->json($company, 200);
        } catch (\Exception $error) {
            Log::error('Error occurred: ' . $error->getMessage());
            return response()->json([
                'error' => $error->getMessage(),
                'message' => 'Error occurred while adding a new company.',
            ], 400);
        }
    }

    public function updateCompany(Request $request): JsonResponse
    {
        $id = $request->input("id");
        $data = $request->all();

        try {
            DB::beginTransaction();

            $company = Company::findOrFail($id);

            $company->update($data);

            DB::commit();

            return response()->json(["company" => $company]);
        } catch (\Exception $error) {
            DB::rollBack();
            Log::error('Error occurred: ' . $error->getMessage());
            return response()->json([
                'error' => $error->getMessage(),
                'message' => 'An error occurred while updating the company.',
            ], 400);
        }
    }

    public function deleteCompany(Request $request): JsonResponse
    {
        $companyId = $request->input('companyId');

        try {
            $company = Company::find($companyId);
            if (!$company) {
                return response()->json(['error' => 'Company not found.'], 404);
            }

            $company->delete();

            return response()->json(['message' => 'Company deleted successfully.']);
        } catch (\Exception $error) {
            Log::error('Error occurred: ' . $error->getMessage());
            return response()->json(['error' => $error->getMessage(), 'message' => 'Error occurred while deleting company.'], 400);
        }
    }
}
