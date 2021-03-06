<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditFormRequest;
use App\Http\Requests\UserFormRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use DataTables;
use Session;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function __construct()
    {
        $this->middleware('auth');
    }

   
    
     public function index(Request $request)
    {
        
        $request->user()->authorizeRoles(['administrador']);
        if ($request->ajax()) {
            $users = User::all();

            return DataTables::of($users)
                ->addColumn('rol', function($user){
                    foreach ($user->roles as $role){
                        return $role->name;
                    }
                })
                ->addColumn('imagen', function($user){
                    if (empty($user->imagen)){
                        return '';
                    }
                    return '<img src="imagenes/'.$user->imagen.'" height="40px" width="40px">';
                    
                })
                ->addColumn('action', 'usuarios.actions')
                ->rawColumns(['imagen', 'action'])
                ->make(true);

        }

        return view('usuarios.index');

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['administrador']);
        $roles = Role::all();
        return view ('usuarios.create', ['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $usuario = new User();
        $usuario->name = request('name');
        $usuario->email = request('email');
        $usuario->password = bcrypt(request('password'));
        if ($request->hasFile('imagen')){
            $file = $request->imagen;
            $file->move(public_path().'/imagenes', $file->getClientOriginalName());
            $usuario->imagen = $file->getClientOriginalName();
        }
        $usuario->save();

        $usuario->asignarRol($request->get('rol'));
        Session::flash('success', 'Usuario Agregado con exito');
        return redirect('/usuarios');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $request->user()->authorizeRoles(['administrador']);
        return view ('usuarios.show', ['user'=>User::findorFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit($id,  Request $request)
    {
        $request->user()->authorizeRoles(['administrador']);
        $user = User::findOrFail($id);
        
        $roles = Role::all();
        return view ('usuarios.edit', ['user'=>$user, 'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditFormRequest $request, $id)
    {
        $usuario = User::findOrFail($id);

        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');

        if ($request->hasFile('imagen')) {
            $file = $request->imagen;
            $file->move(public_path() . '/imagenes', $file->getClientOriginalName());
            $usuario->imagen = $file->getClientOriginalName();
        }
        $pass = $request->get('password');
        if ($pass != null) {
            $usuario->password = bcrypt($request->get('password'));
        } else {
            unset($usuario->password);
        }
        //modificamos esta parte para que actualice roles de usuarios
        //si tiene rol actualizamos el rol
        // si no tiene rol le asignamos un rol
        $role = $usuario->roles;
        if (count($role) > 0) {
            $role_id = $role[0]->id;
            User::find($id)->roles()->updateExistingPivot($role_id, ['role_id' => $request->get('rol')]);
        } else {
            $usuario->asignarRol($request->get('rol'));
        }

        $usuario->update();
        Session::flash('success', 'Usuario actualizado con exito');
        return redirect('/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::FindOrFail($id);
        $usuario->delete();
        return redirect('/usuarios');
    }
}
