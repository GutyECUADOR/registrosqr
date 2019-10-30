<?php

namespace App\Http\Controllers;

use App\Inscrito;
use Illuminate\Http\Request;
use Validator;

class InscritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inscritos = Inscrito::all();
        return response()->json($inscritos, 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        //var_dump($params);
        //die();

        if(empty($params)){
            $respuesta = array(
                'status' => 'fail',
                'code'   => 400,
                'message'=> 'El json enviado no es valido'
            );
        }else{

            $validacion  = Validator::make($params_array, [
                'nombre' => 'required|alpha',
                'qr' => 'integer'
            ]);

            if ($validacion->fails()) {

                $respuesta = array(
                    'status' => 'fail',
                    'code'   => 400,
                    'message'=> 'Los valores ingresados no pasaron la validacion',
                    'errors' => $validacion->errors()
                );

            }else{
                $inscrito = new Inscrito();
                $inscrito->nombre = $params->nombre;
                $inscrito->apellido = $params->apellido;
                $inscrito->descripcion = $params->qr;
                $inscrito->save();

                $respuesta = array(
                    'status' => 'ok',
                    'code'   => 201,
                    'message'=> 'El registro se realizo correctamente',
                    'inscrito' => $inscrito
                );
            }




        }

        return response()->json($respuesta, $respuesta['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inscrito  $inscrito
     * @return \Illuminate\Http\Response
     */
    public function show(Inscrito $inscrito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inscrito  $inscrito
     * @return \Illuminate\Http\Response
     */
    public function edit(Inscrito $inscrito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inscrito  $inscrito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inscrito $inscrito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inscrito  $inscrito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inscrito $inscrito)
    {
        //
    }
}
