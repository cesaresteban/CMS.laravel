<?php

namespace App\Http\Controllers;
use App\Models\Noticia;

class AppController extends Controller
{
    public function index()
    {
        //Obtengo las Noticias a mostrar en la home
        $rowset = Noticias::where('activo', 1)->where('home', 1)->orderBy('fecha', 'DESC')->get();

        return view('app.index',[
            'rowset' => $rowset,
        ]);
    }

    public function Noticias()
    {
        //Obtengo las Noticias a mostrar en el listado de Noticias
        $rowset = Noticias::where('activo', 1)->orderBy('fecha', 'DESC')->get();

        return view('app.Noticias',[
            'rowset' => $rowset,
        ]);
    }

    public function Noticia($slug)
    {
        //Obtengo la Noticias o muestro error
        $row = Noticias::where('activo', 1)->where('slug', $slug)->firstOrFail();

        return view('app.Noticias',[
            'row' => $row,
        ]);
    }

    public function acercade()
    {
        return view('app.acerca-de');
    }

    //Métodos para la API (podrían ir en otro controlador)

    public function mostrar(){

        //Obtengo las Noticias a mostrar en el listado de Noticias
        $rowset = Noticias::where('activo', 1)->orderBy('fecha', 'DESC')->get();

        //Opción rápida (datos completos)
        //$Noticias = $rowset;

        //Opción personalizada
        foreach ($rowset as $row){
            $Noticias[] = [
                'titulo' => $row->titulo,
                'entradilla' => $row->entradilla,
                'autor' => $row->autor,
                'fecha' => date("d/m/Y", strtotime($row->fecha)),
                'enlace' => url("Noticias/".$row->slug),
                'imagen' => asset("img/".$row->imagen)
            ];
        }

        //Devuelvo JSON
        return response()->json(
            $Noticias, //Array de objetos
            200, //Tipo de respuesta
            [], //Headers
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE //Opciones de escape
        );

    }

    public function leer(){

        //Url de destino

        //Parseo datos a un array
        $rowset = json_decode(file_get_contents($url), true);

        //LLamo a la vista
        return view('api.leer',[
            'rowset' => $rowset,
        ]);

    }
}
