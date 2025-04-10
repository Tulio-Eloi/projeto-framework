<?php

namespace App\Controllers;



class Cidades extends BaseController
{
    public function index()
    {   
        $data['titulo'] = "Cidades";
        $data["form"] = "Listar";
        $data['cidades'] = array(
            ['id'=>'1', 'cidade'=>'Ceres','uf'=>'Go'],
            ['id'=>'2', 'cidade'=>'Rialma','uf'=>'Go'],
            ['id'=>'3', 'cidade'=>'Rubiataba','uf'=>'Go'],
            ['id'=>'4', 'cidade'=>'São Paulo','uf'=>'SP'],
            ['id'=>'5', 'cidade'=>'Rio de Janeiro','uf'=>'RJ']

        );

        return view('cidades/index',$data);
    }
    public function new(){
        $data['titulo'] = 'Nova cidade';
        $data['form'] = 'Cadastrar';
        $data['cidades'] = [
            'cidades_id' =>'',
            'cidades_nome' => '',
            'cidades_uf' => ''
        ];
        return view('cidades/form',$data);

    } //resolve o problema do new quando chama o mesmo formulario
    public function create(){
        $data['titulo'] = 'Cidades';
        $data['form'] = 'listar';
        $cidade = [
            'id' => 6,
            'cidade' => $_POST['cidades_nome'], //pega o valor la do formulario
            'uf' => $_POST['cidades_uf']
        ];

        $data['cidades'] = array(
            ['id'=>'1', 'cidade'=>'Ceres','uf'=>'Go'],
            ['id'=>'2', 'cidade'=>'Rialma','uf'=>'Go'],
            ['id'=>'3', 'cidade'=>'Rubiataba','uf'=>'Go'],
            ['id'=>'4', 'cidade'=>'São Paulo','uf'=>'SP'],
            ['id'=>'5', 'cidade'=>'Rio de Janeiro','uf'=>'RJ'],
            

        );

        array_push($data['cidades'], $cidade);
        return view('cidades/index',$data);

    }
    //fazer o chamado do formulario edit
    public function edit($id){
        $data['titulo'] = 'Cidades';
        $data['form'] = 'alterar';
        $data['cidades'] = array(
            ['id'=>'1', 'cidade'=>'Ceres','uf'=>'Go'],
            ['id'=>'2', 'cidade'=>'Rialma','uf'=>'Go'],
            ['id'=>'3', 'cidade'=>'Rubiataba','uf'=>'Go'],
            ['id'=>'4', 'cidade'=>'São Paulo','uf'=>'SP'],
            ['id'=>'5', 'cidade'=>'Rio de Janeiro','uf'=>'RJ'],
            

        );
        $data['cidade'] = $data['cidades'][$id-1];
        return view('cidades/form', $data);

    }
}