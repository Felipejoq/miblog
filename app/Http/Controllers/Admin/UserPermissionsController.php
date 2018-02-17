<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserPermissionsController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->permissions()->detach();

        if ($request->filled('permissions')){
            $user->givePermissionTo($request->permissions);
        }

        return back()->withFlash('Los permisos fueron actualizados.');
    }

}
