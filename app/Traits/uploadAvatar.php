<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 09/02/2019
 * Time: 18:40
 */

namespace App\Traits;


use App\Models\User;
use Illuminate\Http\Request;

trait uploadAvatar
{
    public function uploadMainImage(Request $request, User $user)
    {
        $path = '';

        //test si il y une image dans la requete
        if($request->file('avatar'))
        {
            try {

                $path = $request->file('avatar')->store('public/users/'.$user->id);

            }catch (\Exception $exception){
                //si exception : message d'erreur
                throw new \Exception($exception->getMessage());
            }

            $array = explode('/', $path);
            return $array[1].'/'.$array[2].'/'.$array[3];
        }

        return $path;
    }
}