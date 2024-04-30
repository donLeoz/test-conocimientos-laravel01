<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class benefitsController extends Controller
{


    public function index()
    {

        $beneficioResponse = Http::get('https://run.mocky.io/v3/399b4ce1-5f6e-4983-a9e8-e3fa39e1ea71')->json();
        $beneficios = collect($beneficioResponse['data']);

        $filtrosResponse = Http::get('https://run.mocky.io/v3/06b8dd68-7d6d-4857-85ff-b58e204acbf4')->json();
        $filtros = collect($filtrosResponse['data']);

        $fichasResponse = Http::get('https://run.mocky.io/v3/c7a4777f-e383-4122-8a89-70f29a6830c0')->json();
        $fichas = collect($fichasResponse['data']);

        $beneficios = collect($beneficios)
            ->map(function ($beneficio) {
                $beneficio['view'] = false; //agrego view false por defecto
                $beneficio['ano'] = date('Y', strtotime($beneficio['fecha']));
                return $beneficio;
            });

        // Asocia los filtros y fichas a cada beneficio
        $beneficiosConFichas = $beneficios->map(function ($beneficio) use ($filtros, $fichas) {
            $filtro = $filtros->firstWhere('id_programa', $beneficio['id_programa']);
            $ficha = $fichas->firstWhere('id', $filtro['ficha_id']);

            // aprovechamos el map y agregamos view true si cumple la condición que el monto del beneficio esté entre el min y el max del filtro
            if ($beneficio['monto'] <= $filtro['max'] && $beneficio['monto'] >= $filtro['min']) {
                $beneficio['view'] = true;
            }

            $beneficio['filtro'] = $filtro;
            $beneficio['ficha'] = $ficha;
            return $beneficio;
        })
            ->filter(function ($beneficio) {
                return $beneficio['view']; //filtro por los beneficios que cumplen la condición. view = true
            });

        // quitamos los filtros porque ya no los necesitamos para el resultado final
        $beneficiosConFichas = $beneficiosConFichas->map(function ($beneficio) {
            unset($beneficio['filtro']);
            return $beneficio;
        });

        // Agrupa los beneficios por año
        $beneficiosPorAno = $beneficiosConFichas->groupBy('ano');

        // Formatear la salida
        $resultado = $beneficiosPorAno->map(function ($beneficios, $ano) {
            return [
                'year' => $ano,
                'num' => count($beneficios),
                'beneficios' => $beneficios->all()
            ];
        })->values();

        return response()->json([
            'code' => 200,
            'success' => true,
            'data' => $resultado
        ]);
    }
}
