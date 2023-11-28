<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\ShippingCharge;
use App\Models\PhilippineRegion;
use App\Models\PhilippineProvince;
use App\Models\PhilippineCity;
use App\Models\PhilippineBarangay;
use Illuminate\Support\Facades\Validator;

class ShippingController extends Controller
{
    //create
    public function create(){
        $countries = Country::get();
        $data['countries'] = $countries;

        //trial on the loactions

            
        /**Region Guide     =>  region_description
         * region_code
         * 
         */
        // $regions = PhilippineRegion::all();  
        $regions = PhilippineRegion::all();
        $data['regions'] = $regions;      
        
        /**Provinces Guide  =>  province_description
         * region_code
         * province_code
         * 
         */
        //$provinces = PhilippineProvince::all();
        // $provinces = PhilippineProvince::where('id','<',3)->get();      

        /**Cities Guide     => city_municipality_description
         * region_description -> is equal to region_code
         * province_code
         * city_municipality_code
        */
        // $cities = PhilippineCity::all();
        // $cities = PhilippineCity::where('id','<',3)->get();
        
        // /**Barangays Guide      => barangay_description
        //  * region_code
        //  * province_code
        //  * city_municipality_code
        //  * barangay_code
        //  */
        // $barangays = PhilippineBarangay::all();
        // $barangays = PhilippineBarangay::where('id','<',3)->get();
        
        

        // dd($regions);
        // dd($provinces);
        // dd($cities);
        // dd($barangays);


        //get shipping charges
        $shippingCharges = ShippingCharge::select('shipping_charges.*','countries.name','philippine_regions.region_description','philippine_provinces.province_description','philippine_cities.city_municipality_description','philippine_barangays.barangay_description')
                                ->leftJoin('countries','countries.id','shipping_charges.country_id')
                                ->leftJoin('philippine_regions','philippine_regions.region_code','shipping_charges.region_code')
                                ->leftJoin('philippine_provinces','philippine_provinces.province_code','shipping_charges.province_code')
                                ->leftJoin('philippine_cities','philippine_cities.city_municipality_code','shipping_charges.city_municipality_code')
                                ->leftJoin('philippine_barangays','philippine_barangays.barangay_code','shipping_charges.barangay_code')
                                ->get();
                                
        $data['shippingCharges'] = $shippingCharges;

        return view('admin.shipping.create',$data);
    }

    //store : post create
    public function store(Request $request){
        //dd($request->all());

        $validator = Validator::make($request->all(),[
            // 'country' => 'required',
            'region_code' => 'required',
            'province_code' => 'required',
            'city_municipality_code' => 'required',
            'barangay_code' => 'required|unique:shipping_charges',
            'amount' => 'required|numeric',
        ]);

        //dd($validator->errors());

        if($validator->passes()){ //if success

            //check if the country record of ammount already exists
            $count = ShippingCharge::where('country_id',$request->country)->count();
            if($count > 0){

                
                session()->flash('error','Shipping already added');
                //return a json error response
                return response()->json([
                    'status' => 'true',
                    'message' => 'Shipping already add'
                ]);

                //return redirect()->route('shipping.create')->with('error','Shipping already added');
            }


            //save
            $shipping = new ShippingCharge;
            $shipping->country_id = '170';
            $shipping->region_code = $request->region_code;
            $shipping->province_code = $request->province_code;
            $shipping->city_municipality_code = $request->city_municipality_code;
            $shipping->barangay_code = $request->barangay_code;
            $shipping->amount = $request->amount;
            $shipping->save();

            //return and show the json success response
            session()->flash('success','Shipping added successfully');
            return response()->json([
                'status' => true,
                
            ]);

        }else{// if failed
            //json fail response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }

    //edit
    public function edit($id){
        $shippingCharge = ShippingCharge::find($id);

        $countries = Country::get();
        $data['countries'] = $countries;

        $regions = PhilippineRegion::all();
        $data['regions'] = $regions;    

        $provinces = PhilippineProvince::select('province_description','region_code','province_code')
            ->where('region_code',$shippingCharge->region_code)
            ->limit(100)
            ->get();
        $data['provinces'] = $provinces;

        $city_municipality = PhilippineCity::select('city_municipality_description','province_code','city_municipality_code')
            ->where('province_code',$shippingCharge->province_code)
            ->limit(100)
            ->get();

        $data['city_municipality'] = $city_municipality;

        $barangays = PhilippineBarangay::select('barangay_description','city_municipality_code','barangay_code')
            ->where('city_municipality_code',$shippingCharge->city_municipality_code)
            ->limit(100)
            ->get();

        $data['barangays'] = $barangays;


        $data['shippingCharge'] = $shippingCharge;

        return view('admin.shipping.edit',$data);
    }

    //update : post update
    public function update($id,Request $request){
        //dd($request->all());

        $validator = Validator::make($request->all(),[
            'region_code' => 'required',
            'province_code' => 'required',
            'city_municipality_code' => 'required',
            'barangay_code' => 'required|unique:shipping_charges,barangay_code,'.$id.',id',
            'amount' => 'required|numeric',
        ]);

        //dd($validator->errors());

        if($validator->passes()){ //if success
            //save
            $shipping = ShippingCharge::find($id);
            $shipping->country_id = '170'; // default for PH
            $shipping->region_code = $request->region_code;
            $shipping->province_code = $request->province_code;
            $shipping->city_municipality_code = $request->city_municipality_code;
            $shipping->barangay_code = $request->barangay_code;
            $shipping->amount = $request->amount;
            $shipping->save();

            //return and show the json success response
            session()->flash('success','Shipping updated successfully');
            return response()->json([
                'status' => true,
            ]);

        }else{// if failed
            //json fail response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }

    //destroy
    public function destroy($id){
        $shippingCharge = ShippingCharge::find($id);

        if($shippingCharge == null){
            session()->flash('error','Shipping not found');
            return response()->json([
                'status' => true,
                'message' => 'Shipping not found'
            ]);
        }

        $shippingCharge->delete();


        session()->flash('success','Shipping deleted successfully');
        return response()->json([
            'status' => true,
        ]);

    }


    //ajax to return provinces based on the region_code passed
    public function getProvinces(Request $request){
        // dd($request->all());

        $provinces = PhilippineProvince::select('province_description','region_code','province_code')->where('region_code',$request->region_code)->get();

        if(empty($provinces)){
            //return a json error response

            return response()->json([
                'status' => false,
                'message' => "Provinces are not found on the region code"
            ]);
        }else{


            $html = "<option value=''>Select a Province </option>";

            foreach ($provinces  as $province) {
                $html .= "<option value=".$province->province_code.">".$province->province_description."</option>";
            }

            //return the provinces
            return response()->json([
                'status' => true,
                'html' => $html
            ]);

        }

    }

    //ajax to return the city or municipality based on the province_code
    public function getCityMunicipality(Request $request){
        //dd($request->all());

        $city_municipality = PhilippineCity::select('city_municipality_description','province_code','city_municipality_code')->where('province_code',$request->province_code)->get();

        if(empty($city_municipality)){
            //return a json error response

            return response()->json([
                'status' => false,
                'message' => "City or municipality are not found on the province code"
            ]);
        }else{


            $html = "<option value=''>Select a City || Municipality </option>";

            foreach ($city_municipality  as $city) {
                $html .= "<option value=".$city->city_municipality_code.">".$city->city_municipality_description."</option>";
            }

            //return the city_municipality
            return response()->json([
                'status' => true,
                'html' => $html
            ]);

        }


    }

    //ajax to return the barangays based on the city_municipality_code
    public function getBarangay(Request $request){
        //dd($request->all());

        $barangays = PhilippineBarangay::select('barangay_description','city_municipality_code','barangay_code')->where('city_municipality_code',$request->city_municipality_code)->get();

        if(empty($barangays)){
            //return a json error response

            return response()->json([
                'status' => false,
                'message' => "Barangays are not found on the city or municipality code"
            ]);
        }else{


            $html = "<option value=''>Select a Barangay </option>";

            foreach ($barangays  as $barangay) {
                $html .= "<option value=".$barangay->barangay_code.">".$barangay->barangay_description."</option>";
            }

            //return the city_municipality
            return response()->json([
                'status' => true,
                'html' => $html
            ]);

        }
    }


}
