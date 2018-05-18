<?php

namespace SenseBook\Http\Controllers\BackOffice;

use Baraear\ThaiAddress\Models\District;
use Baraear\ThaiAddress\Models\PostalCode;
use Baraear\ThaiAddress\Models\Province;
use Baraear\ThaiAddress\Models\SubDistrict;
use http\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SenseBook\Http\Controllers\Controller;
use SenseBook\Http\Requests\BackOffice\AddressRequest;
use SenseBook\Models\Address;
use SenseBook\User;

class AddressController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param AddressRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        try {
            $authUser = Auth::user();
            $user = User::find($authUser->id);

            $address = new Address();
            $address->fill($request->all());
            $address->full_name = $user->full_name;
            $address->save();

            Session::flash('success', "New address has been added.");
        } catch (Exception $e) {
            Session::flash('failure', "Something went wrong, please try again.");
            return redirect()->route('profile.index');
        }

        return redirect()->route('profile.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::withTrashed()->where('id', '=', $id)->first();

        try {
            if (!$address->trashed()) {
                $address->delete();
                Session::flash('success', "The address has been deleted.");
            } else {
                $address->forceDelete();
                Session::flash('success', "The address has been deleted forever.");
            }
        } catch (Exception $e) {
            Session::flash('failure', "Something went wrong, please try again.");
            return redirect()->route('profile.index');
        }

        return redirect()->route('profile.index');
    }

    public function getAllSubDistricts()
    {
        return response()->json(SubDistrict::all());
    }

    public function getSubDistrict($id)
    {
        return response()->json(SubDistrict::findOrFail($id));
    }

    public function searchSubDistrict($query)
    {
        return response()->json(SubDistrict::query()->search($query, 'name')->get());
    }

    public function getAllDistricts()
    {
        return response()->json(District::all());
    }

    public function getDistrict($id)
    {
        return response()->json(District::findOrFail($id));
    }

    public function searchDistrict($query)
    {
        return response()->json(District::query()->search($query, 'name')->get());
    }

    public function getAllProvinces()
    {
        return response()->json(Province::all());
    }

    public function getProvince($id)
    {
        return response()->json(Province::findOrFail($id));
    }

    public function searchProvince($query)
    {
        return response()->json(Province::query()->search($query, 'name')->get());
    }

    public function getAllPostalCodes()
    {
        return response()->json(PostalCode::all());
    }

    public function getPostalCode($id)
    {
        return response()->json(PostalCode::findOrFail($id));
    }

    public function searchPostalCode($query)
    {
        return response()->json(PostalCode::query()->search($query, 'code')->get());
    }

    public function search($query)
    {
        $postalCodes = PostalCode::query()
            ->whereHas('sub_district', function ($q) use ($query) {
                $q->search($query, 'name');
            })
            ->orWhereHas('district', function ($q) use ($query) {
                $q->search($query, 'name');
            })
            ->orWhereHas('province', function ($q) use ($query) {
                $q->search($query, 'name');
            })
            ->orWhere('code', 'like', "%{$query}%")
            ->get();

        $autoComplete = array();
        $autoComplete['items'] = array();
        foreach ($postalCodes as $postalCode) {
            $transferData = [
                'sub_district' => $postalCode->sub_district->name,
                'sub_district_id' => $postalCode->sub_district->id,
                'district' => $postalCode->district->name,
                'district_id' => $postalCode->district->id,
                'province' => $postalCode->province->name,
                'province_id' => $postalCode->province->id,
                'postal_code' => $postalCode->code,
                'postal_code_id' => $postalCode->id,
            ];
            array_push($autoComplete['items'], json_encode($transferData));
        }
        $autoComplete['inputPhrase'] = $query;
        return response()->json($autoComplete);
    }

    public function getDistrictByProvince($id)
    {
        return response()->json(District::query()->where('province_id', $id)->get());
    }

    public function getSubDistrictByDistrict($id)
    {
        return response()->json(SubDistrict::query()->where('district_id', $id)->get());
    }

    public function getPostalCodeBySubDistrict($id)
    {
        return response()->json(PostalCode::query()->where('sub_district_id', $id)->get());
    }

    public function getUserAddresses($id)
    {
        $user = User::query()->withTrashed()->where('id', $id)
            ->with(['billingAddress', 'shippingAddress'])
            ->first();

        $response = [
            'full_name' => $user->full_name,
            'billing_address' => [
                'address_line_1' => '',
                'address_line_2' => '',
                'sub_district' => '',
                'sub_district_id' => '',
                'district' => '',
                'district_id' => '',
                'province' => '',
                'province_id' => '',
                'postal_code' => '',
                'postal_code_id' => ''
            ],
            'shipping_address' => [
                'address_line_1' => '',
                'address_line_2' => '',
                'sub_district' => '',
                'sub_district_id' => '',
                'district' => '',
                'district_id' => '',
                'province' => '',
                'province_id' => '',
                'postal_code' => '',
                'postal_code_id' => ''
            ]
        ];

        if($user->billingAddress){
            if($billing_addresses = PostalCode::query()->find($user->billingAddress->postal_code_id)){
                $response['billing_address'] = [
                    'address_line_1' => $user->billingAddress->address_line_1,
                    'address_line_2' => $user->billingAddress->address_line_2,
                    'sub_district' => $billing_addresses->sub_district->name,
                    'sub_district_id' => $billing_addresses->sub_district->id,
                    'district' => $billing_addresses->district->name,
                    'district_id' => $billing_addresses->district->id,
                    'province' => $billing_addresses->province->name,
                    'province_id' => $billing_addresses->province->id,
                    'postal_code' => $billing_addresses->code,
                    'postal_code_id' => $billing_addresses->id
                ];
            }
        }

        if($user->shippingAddress){
            if($shipping_addresses = PostalCode::query()->find($user->shippingAddress->postal_code_id)){
                $response['shipping_address'] = [
                    'address_line_1' => $user->shippingAddress->address_line_1,
                    'address_line_2' => $user->shippingAddress->address_line_2,
                    'sub_district' => $shipping_addresses->sub_district->name,
                    'sub_district_id' => $shipping_addresses->sub_district->id,
                    'district' => $shipping_addresses->district->name,
                    'district_id' => $shipping_addresses->district->id,
                    'province' => $shipping_addresses->province->name,
                    'province_id' => $shipping_addresses->province->id,
                    'postal_code' => $shipping_addresses->code,
                    'postal_code_id' => $shipping_addresses->id
                ];
            }
        }
        
        return response()->json(collect($response)->toArray());
    }
}
