<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;

class AuthenticationController extends BaseController
{
    //
    public function createAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone_number'=>'required',
            'trade_name'=>'required',
            'trade_license_number'=>'required',
            'drug_license_number'=>'required',
            'shop_district'=>'required',
            'shop_thana'=>'required',
            'shop_word_no'=>'required',
            'shop_road_no'=>'required',
            'shop_holding_no'=>'required',
        ]);

        if($validator->fails()){
            return $this->handleError($validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken;
        $success['name'] =  $user->name;


        return $this->sendResponse($success, 'User register successfully.');


    }
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
//        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
//            $user = Auth::user();
//            $success['name'] =  $user->name;
//
//            return $this->sendResponse($success, 'User login successfully.');
//        }
//        $credentials = [
//            'id' => $user_id,
//            'password' => $request['password'],
//        ];

        $user_id=str_replace("ediag","",$request->shop_id);

        if(Auth::attempt(['id' => $user_id, 'password' => $request->password])){
            $user = Auth::user();
         $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken;
            //$success['token']=$user->getRememberToken()
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }



    }




}
