<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdutosController extends Controller
{
    
    public function index()
    {
        $produtos = Produto::orderBy('id', 'desc')->get();

        return view('produtos.index', ['prods' => $produtos, 'pagina' => 'produtos']);
    }

    public function show(Produto $prod)
    {
        return view('produtos.show', ['prod' => $prod, 'pagina' => 'produtos']);
    }

    public function create()
    {
        return view('produtos.create', ['pagina' => 'produtos']);
    }

    public function insert(Request $form)
    {
        $prod = new Produto();

        $imagemCaminho = $form->file('imagem')->store('', 'imagens');
        $prod = new Produto();

        $prod->nome = $form->nome;
        $prod->preco = $form->preco;
        $prod->descricao = $form->descricao;
        $prod->imagem = $imagemCaminho;

        $prod->save();

        return redirect()->route('produtos');
    }

    public function edit(Produto $prod)
    {
        return view('produtos.edit', ['prod' => $prod, 'pagina' => 'produtos']);
    }

    public function update(Request $form, Produto $prod)
    {
        $prod->nome = $form->nome;
        $prod->preco = $form->preco;
        $prod->descricao = $form->descricao;

        $prod->save();

        return redirect()->route('produtos');
    }

    public function remove(Produto $prod)
    {
        if(Auth::user() && Auth::user()->admin){
            return view('produtos.remove', ['prod' => $prod, 'pagina' => 'produtos']);
        }else{
            return redirect()->route('login');
        }
    }

    public function delete(Produto $prod)
    {
        $prod->delete();

        return redirect()->route('produtos');
    }

}
