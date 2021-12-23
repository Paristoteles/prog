<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::orderBy('id', 'asc')->get();

        return view('usuarios.index', ['usuarios' => $usuarios, 'pagina' => 'usuarios']);
    }

    public function create()
    {
        return view('usuarios.create', ['pagina' => 'usuarios']);
    }

    public function insert(Request $form)
    {
        $usuario = new Usuario();

        $usuario->name = $form->name;
        $usuario->email = $form->email;
        $usuario->username = $form->username;
        $usuario->password = Hash::make($form->password);

        $usuario->save();
        event(new Registered($usuario));

        Auth::login($usuario);

        return redirect()->route('verification.notice');
    }

    // Ações de login
    public function login(Request $form)
    {
        // Está enviando o formulário
        if ($form->isMethod('POST'))
        {

            $credenciais = $form->validate([
                'username' => ['required'],
                'password' => ['required']
            ]);

            $remember = $form->remember;

            if(Auth::attempt($credenciais, $remember)){
                session()->regenerate();
                return redirect()->route('home');
            }else{
                return redirect()->route('login')->with('erro', 'Usuário ou senha inválidos.');
            }
        }

        return view('usuarios.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function usuarios(){
        return view('usuarios.perfil', ['pagina' => 'usuarios']);
    }

    public function edit(){
        return view('usuarios.edit', ['pagina' => 'usuarios']);
    }

    public function alterar(Request $form){
        $usuario = Usuario::where('id', Auth::user()->id)->first();

        $validate = $form->validate([
            'name' => ['required'],
            'email' => ['required']
        ]);

        $usuario->name = $form->name;
        if($usuario->email != $form->email){
            $usuario->email = $form->email;
            $usuario->email_verified_at = null;
            $usuario->sendEmailVerificationNotification();
        }

        $usuario->save();

        return redirect()->route('usuarios.perfil');
    }

    public function password(Request $form)
    {
        if ($form->isMethod('POST'))
        {
            $usuario = Auth::user();
         
            if (!Hash::check($form->oldPassword, Auth::user()->password))
            {
                return view('usuarios.password', ['pagina' => 'password', 'erro' => "A senha antiga não está correta!"]);
            }

            if ($form->newPassword != $form->newPasswordConfirm)
            {
                return view('usuarios.password', ['pagina' => 'password', 'erro' => "As senhas digitadas não são iguais!"]);
            }

            $usuario->password = Hash::make($form->newPassword);         
            $usuario->save();

            return view('usuarios.perfil', ['pagina' => 'usuarios']);
        } else {
            return view('usuarios.password', ['pagina' => 'usuarios', 'erro' => "A senha antiga não está correta!"]);
        }
    }
}

