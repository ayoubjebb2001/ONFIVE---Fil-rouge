<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $request->validated();

        $keys =array_keys($request->safe()->only(['username','first_name','last_name','email']));

        foreach ($keys as $key ) {
                if($key == "email"){
                    $request->$key = Str::of($request->$key)->trim()->lower()->stripTags()->replaceMatches('/[^\p{L}\p{N}\s\-\.@]/u', '');
                }else if($key == "username"){
                    $request->$key = Str::of($request->$key)->trim()->stripTags()->replaceMatches('/[^\p{L}\p{N}\s\-\.\_]/u', '');
                }
                else{
                    $request->$key = Str::of($request->$key)->trim()->stripTags()->replaceMatches('/[^\p{L}\p{N}\s\-]/u', '');
                }
        }

        if($request->hasFile('profile_picture')) {
            //check if the file already exists in storage
            $existingFile = storage_path('app/profile_pictures/' . $request->username . '.' . $request->file('profile_picture')->extension());
            // if it exists, don't upload it again
            if (!file_exists($existingFile)) {
                $request->file('profile_picture')->storeAs('profile_pictures', $request->username . '.' . $request->file('profile_picture')->extension());
            }
        }
        $request->merge([
            'filename' => $request->username . '.' . $request->file('profile_picture')->extension(),
        ]);
        $user = User::create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'birth_date' => $request->birth_date,
            'profile_picture' => $request->filename,
        ]);



        if ($user) {
            $user->save();
            return redirect()->route('login')->with('success', 'Registration successful,Enter your Password to login')->withInput([
                'email' => $request->email,
            ]);
        } else {
            return redirect()->back()->with('error', 'Registration failed');
        }
    }
}
