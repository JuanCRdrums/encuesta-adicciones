<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuestas extends Model
{
    protected $table = 'respuestas_adicciones';

    protected $fillable = ['id','datos_usuario','puntuaciones','pregunta_1',
    'pregunta_2','pregunta_3','pregunta_4','pregunta_5','pregunta_6','pregunta_7',
    'pregunta_8','intervenciones', 'created_at','updated_at'];


    public static function getComboDrogas()
    {
        return Config('options.drogas');
    }

    public static function getComboDrogasCorto()
    {
        return Config('options.drogas_corto');
    }

    public static function getComboFrecuencia()
    {
        return Config('options.frecuencia');
    }

    public static function getComboAfirmacion()
    {
        return Config('options.afirmacion');
    }

    public static function getComboSignificados()
    {
        return Config('options.significados');
    }

    public function getConsumidasAttribute()
    {
        return json_decode($this->pregunta_1);
    }

    public function getSegundaAttribute()
    {
        return json_decode($this->pregunta_2);
    }

    public function getTerceraAttribute()
    {
        return json_decode($this->pregunta_3);
    }

    public function getCuartaAttribute()
    {
        return json_decode($this->pregunta_4);
    }

    public function getQuintaAttribute()
    {
        return json_decode($this->pregunta_5);
    }

    public function getSextaAttribute()
    {
        return json_decode($this->pregunta_6);
    }

    public function getSeptimaAttribute()
    {
        return json_decode($this->pregunta_7);
    }

    public function getUsuarioAttribute()
    {
        return json_decode($this->datos_usuario);
    }


    public static function calculatePoints(Respuestas $respuesta)
    {
        $results = [];
        $drogas = self::getComboDrogas();
        foreach($drogas as $key => $value)
            $results[$key] = 0;

        $pregunta_2 = json_decode($respuesta->pregunta_2);
        $pregunta_3 = json_decode($respuesta->pregunta_3);
        $pregunta_4 = json_decode($respuesta->pregunta_4);
        $pregunta_5 = json_decode($respuesta->pregunta_5);
        $pregunta_6 = json_decode($respuesta->pregunta_6);
        $pregunta_7 = json_decode($respuesta->pregunta_7);

        foreach($respuesta->consumidas as $key => $consumida)
        {
            if($consumida != 0)
            {
                if(!empty($pregunta_2))
                {
                    switch($pregunta_2->$key)
                    {
                        case 2:
                            $results[$key] += 2;
                            break;

                        case 3:
                            $results[$key] += 3;
                            break;

                        case 4:
                            $results[$key] += 4;
                            break;
                        
                        case 5:
                            $results[$key] += 6;
                            break;
                        
                        default:
                            $results[$key] += 0;
                    }
                }

                if(!empty($pregunta_3))
                {
                    switch($pregunta_3->$key)
                    {
                        case 2:
                            $results[$key] += 3;
                            break;

                        case 3:
                            $results[$key] += 4;
                            break;

                        case 4:
                            $results[$key] += 5;
                            break;
                        
                        case 5:
                            $results[$key] += 6;
                            break;
                        
                        default:
                            $results[$key] += 0;
                    }
                }

                if(!empty($pregunta_4))
                {
                    switch($pregunta_4->$key)
                    {
                        case 2:
                            $results[$key] += 4;
                            break;

                        case 3:
                            $results[$key] += 5;
                            break;

                        case 4:
                            $results[$key] += 6;
                            break;
                        
                        case 5:
                            $results[$key] += 7;
                            break;
                        
                        default:
                            $results[$key] += 0;
                    }
                }

                if(!empty($pregunta_5))
                {
                    switch($pregunta_5->$key)
                    {
                        case 2:
                            $results[$key] += 5;
                            break;

                        case 3:
                            $results[$key] += 6;
                            break;

                        case 4:
                            $results[$key] += 7;
                            break;
                        
                        case 5:
                            $results[$key] += 8;
                            break;
                        
                        default:
                            $results[$key] += 0;
                    }
                }


                if(!empty($pregunta_6))
                {
                    switch($pregunta_6->$key)
                    {
                        case 2:
                            $results[$key] += 6;
                            break;

                        case 3:
                            $results[$key] += 3;
                            break;
                        
                        default:
                            $results[$key] += 0;
                    }
                }

                if(!empty($pregunta_7))
                {
                    switch($pregunta_7->$key)
                    {
                        case 2:
                            $results[$key] += 6;
                            break;

                        case 3:
                            $results[$key] += 3;
                            break;
                        
                        default:
                            $results[$key] += 0;
                    }
                }
            }
        }

        return $results;
    }


    public function getResultsAttribute()
    {
        return json_decode($this->puntuaciones);
    }

    public function getRiesgoAttribute()
    {
        $riesgo = [];
        $drogas = self::getComboDrogas();
        foreach($drogas as $key => $value)
        {
            if($key == 2)
            {
                if($this->results->$key <= 10)
                    $riesgo[$key] = "Bajo";

                if($this->results->$key >= 11 && $this->results->$key <= 26)
                    $riesgo[$key] = "Moderado";

                if($this->results->$key >= 27)
                    $riesgo[$key] = "Alto";
            }
            else
            {
                if($this->results->$key <= 3)
                    $riesgo[$key] = "Bajo";

                if($this->results->$key >= 4 && $this->results->$key <= 26)
                    $riesgo[$key] = "Moderado";

                if($this->results->$key >= 27)
                    $riesgo[$key] = "Alto";
            }
        }

        return $riesgo;
    }
}
