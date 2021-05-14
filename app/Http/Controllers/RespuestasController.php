<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Respuestas;

class RespuestasController extends Controller
{
    private $resource = 'respuesta';

    public function getDataArray()
    {
        return [
            'drogas' => Respuestas::getComboDrogas(),
            'combo_frecuencia' => Respuestas::getComboFrecuencia(),
            'combo_afirmacion' => Respuestas::getComboAfirmacion(),
            'drogas_corto' => Respuestas::getComboDrogasCorto(),
            'combo_significados' => Respuestas::getComboSignificados(),
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->getDataArray();
        $respuestas = Respuestas::where('puntuaciones','!=','')->get();
        $data['respuestas'] = $respuestas;
        return view('respuestas.index',$data);
    }

    public function estadisticas()
    {
        $data = $this->getDataArray();
        $respuestas = Respuestas::where('puntuaciones','!=','')->get();
        $data['respuestas'] = $respuestas;
        return view('respuestas.graficos',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->getDataArray();
        return view('respuestas.create',$data);
    }


    public function store1(Request $request)
    {
        $data = $request->all();
        //dd($data);
        $answer = [];
        $drogas = Respuestas::getComboDrogas();
        $diligenciado = false;
        foreach($drogas as $key => $value)
        {
            if(!empty($data[$key]))
            {
                $answer[$key] = 1;
                $diligenciado = true;
            }
            else
                $answer[$key] = 0;
        }
        
        $respuesta = Respuestas::create();
        $respuesta->pregunta_1 = json_encode($answer);
        $respuesta->save();
        if($diligenciado)
            return redirect('/create-2/' . $respuesta->id);
        else
            return redirect('/final/' . $respuesta->id);
    }


    public function create2($id)
    {
        $data = $this->getDataArray();
        $respuesta = Respuestas::find($id);
        $data['respuesta'] = $respuesta;
        return view('respuestas.create2',$data);
    }


    public function store2(Request $request,$id)
    {
        $data = $request->all();
        unset($data['_token']);
        $continuar = false;
        foreach($data as $frecuencia)
        {
            if($frecuencia != 1)
                $continuar = true;
        }
        $respuesta = Respuestas::find($id);
        $respuesta->pregunta_2 = json_encode($data);
        $respuesta->save();

        if($continuar)
            return redirect('/create-3/' . $id);
        else
            return redirect('/create-6/' . $id);
    }

    public function create3($id)
    {
        $data = $this->getDataArray();
        $respuesta = Respuestas::find($id);
        $data['respuesta'] = $respuesta;
        return view('respuestas.create3',$data);
    }

    public function store3(Request $request,$id)
    {
        $data = $request->all();
        unset($data['_token']);
        $respuesta = Respuestas::find($id);
        $respuesta->pregunta_3 = json_encode($data);
        $respuesta->save();

        return redirect('/create-4/' . $id);
    }

    public function create4($id)
    {
        $data = $this->getDataArray();
        $respuesta = Respuestas::find($id);
        $data['respuesta'] = $respuesta;
        return view('respuestas.create4',$data);
    }

    public function store4(Request $request,$id)
    {
        $data = $request->all();
        unset($data['_token']);
        $respuesta = Respuestas::find($id);
        $respuesta->pregunta_4 = json_encode($data);
        $respuesta->save();

        return redirect('/create-5/' . $id);
    }

    public function create5($id)
    {
        $data = $this->getDataArray();
        $respuesta = Respuestas::find($id);
        $data['respuesta'] = $respuesta;
        return view('respuestas.create5',$data);
    }

    public function store5(Request $request,$id)
    {
        $data = $request->all();
        unset($data['_token']);
        $respuesta = Respuestas::find($id);
        $respuesta->pregunta_5 = json_encode($data);
        $respuesta->save();

        return redirect('/create-6/' . $id);
    }

    public function create6($id)
    {
        $data = $this->getDataArray();
        $respuesta = Respuestas::find($id);
        $data['respuesta'] = $respuesta;
        return view('respuestas.create6',$data);
    }

    public function store6(Request $request,$id)
    {
        $data = $request->all();
        unset($data['_token']);
        $respuesta = Respuestas::find($id);
        $respuesta->pregunta_6 = json_encode($data);
        $respuesta->save();

        return redirect('/create-7/' . $id);
    }

    public function create7($id)
    {
        $data = $this->getDataArray();
        $respuesta = Respuestas::find($id);
        $data['respuesta'] = $respuesta;
        return view('respuestas.create7',$data);
    }

    public function store7(Request $request,$id)
    {
        $data = $request->all();
        unset($data['_token']);
        $respuesta = Respuestas::find($id);
        $respuesta->pregunta_7 = json_encode($data);
        $respuesta->save();

        return redirect('/create-8/' . $id);
    }

    public function create8($id)
    {
        $data = $this->getDataArray();
        $respuesta = Respuestas::find($id);
        $data['respuesta'] = $respuesta;
        return view('respuestas.create8',$data);
    }

    public function store8(Request $request,$id)
    {
        $data = $request->all();
        unset($data['_token']);
        $respuesta = Respuestas::find($id);
        $respuesta->pregunta_8 = $data['respuesta'];
        $respuesta->save();

        return redirect('/final/' . $id);
    }

    public function finalForm($id)
    {
        $data = $this->getDataArray();
        $respuesta = Respuestas::find($id);
        $data['respuesta'] = $respuesta;
        return view('respuestas.final-form',$data);
    }

    public function finalStore(Request $request,$id)
    {
        $data = $request->all();     
        $v = Validator::make($data, [
            'nombre' => 'required',
            'documento' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'ciudad' => 'required',
            'empresa' => 'required',
            'cargo' => 'required',
          ],['nombre'.'.required' => "El nombre es obligatorio",
            'documento'.'.required' => "El documento es obligatorio",
            'telefono'.'.required' => "El teléfono es obligatorio",
            'email'.'.required' => "El correo elect´ronico es obligatorio",
            'ciudad'.'.required' => "La ciudad es obligatoria",
            'empresa'.'.required' => "La empresa es obligatorio",
            'cargo'.'.required' => "El cargo es obligatorio"]);
  
          if ($v->fails()) 
              return redirect()->back()
                          ->withErrors($v)
                          ->withInput();
        unset($data['_token']);
        $respuesta = Respuestas::find($id);
        $respuesta->datos_usuario = json_encode($data);
        $resultados = Respuestas::calculatePoints($respuesta);
        $respuesta->puntuaciones = json_encode($resultados);
        $respuesta->save();

        return redirect('/results/' . $id);
    }

    public function results($id)
    {
        $data = $this->getDataArray();
        $respuesta = Respuestas::find($id);
        $data['respuesta'] = $respuesta;
        return view('respuestas.results',$data);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->getDataArray();
        $respuesta = Respuestas::find($id);
        $data['respuesta'] = $respuesta;
        return view('respuestas.show',$data);
    }

}
