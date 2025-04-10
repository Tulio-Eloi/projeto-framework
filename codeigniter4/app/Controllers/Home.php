<?php

namespace App\Controllers;



class Home extends BaseController
{
    public function index()
    {   
        $data['titulo'] = "Home";
        $data['conteudo'] = "Olá estamos usando as views";
        $data['cidades'] = array(
            ['id'=>'1', 'cidade'=>'Ceres','uf'=>'Go'],
            ['id'=>'2', 'cidade'=>'Rialma','uf'=>'Go'],
            ['id'=>'3', 'cidade'=>'Rubiataba','uf'=>'Go'],
            ['id'=>'4', 'cidade'=>'São Paulo','uf'=>'SP'],
            ['id'=>'5', 'cidade'=>'Rio de Janeiro','uf'=>'RJ']

        );

        return view('home',$data);
    }

}