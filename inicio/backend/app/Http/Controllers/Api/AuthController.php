<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    //Inicio de sesion
    public function login(Request $request){
        $response = ["success"=>false];
        //validacion
       $validator = Validator::make($request->all(),[
           'email' => 'required|email',
           'password' => 'required',
       ]);

       if($validator->fails()){
           $response = ["error"=>$validator->errors()];
           return response()->json($response, 200);
       }

       if(auth()->attempt(['email' => $request->email, 'password' => $request->password])){
        $user = auth()->user();
        $user->hasRole('user');

        $response['token'] = $user->createToken("codea.app")->plainTextToken;
        $response['user'] = $user;
        $response['message'] = "Logueado";
        $response['success'] = true;

       }
       return response()->json($response,200);

    }
    

    //register User
    public function register(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Crear el usuario
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole($request->roles);

            return response()->json([
                'success' => true,
                'user' => $user
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating user: ' . $e->getMessage()
            ], 500);
        }
    }


public function logout()
  {
      $response = ["success" => false];

      if (auth()->user()) {
          auth()->user()->tokens()->delete();
          $response = [
              "success" => true,
              "message" => "Session closed"
          ];
      }

      return response()->json($response);
  }
}
