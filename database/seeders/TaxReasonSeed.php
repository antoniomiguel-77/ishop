<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaxReasonSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         $reasons = [
        'M00' => 'Regime transitório',
        'M02' => 'Transmissão de bens e serviço não sujeita',
        'M04' => 'IVA – Regime de não sujeição',
        'M10' => 'Isento nos termos da alínea a) do nº1 do artigo 12.º',
        'M11' => 'Isento nos termos da alínea b) do nº1 do artigo 12.º',
        'M12' => 'Isento nos termos da alínea c) do nº1 do artigo 12.º do CIVA',
        'M13' => 'Isento nos termos da alínea d) do nº1 do artigo 12.º do CIVA',
        'M14' => 'Isento nos termos da alínea e) do nº1 do artigo 12.º do CIVA',
        'M15' => 'Isento nos termos da alínea f) do nº1 do artigo 12.º do CIVA',
        'M16' => 'Isento nos termos da alínea g) do nº1 do artigo 12.º do CIVA',
        'M17' => 'Isento nos termos da alínea h) do nº1 do artigo 12.º do CIVA',
        'M18' => 'Isento nos termos da alínea i) do nº1 artigo 12.º do CIVA',
        'M19' => 'Isento nos termos da alínea j) do nº1 do artigo 12.º do CIVA',
        'M20' => 'Isento nos termos da alínea k) do nº1 do artigo 12.º do CIVA',
        'M21' => 'Isento nos termos da alínea l) do nº1 do artigo 12.º do CIVA',
        'M22' => 'Isento nos termos da alínea m) do artigo 12.º do CIVA',
        'M23' => 'Isento nos termos da alínea n) do artigo 12.º do CIVA',
        'M24' => 'Isento nos termos da alínea 0) do artigo 12.º do CIVA',
        'M80' => 'Isento nos termos da alinea a) do nº1 do artigo 14.º',
        'M81' => 'Isento nos termos da alinea b) do nº1 do artigo 14.º',
        'M82' => 'Isento nos termos da alinea c) do nº1 do artigo 14.º',
        'M83' => 'Isento nos termos da alinea d) do nº1 do artigo 14.º',
        'M84' => 'Isento nos termos da alínea e) do nº1 do artigo 14.º',
        'M85' => 'Isento nos termos da alinea a) do nº2 do artigo 14.º',
        'M86' => 'Isento nos termos da alinea b) do nº2 do artigo 14.º',
        'M30' => 'Isento nos termos da alínea a) do artigo 15.º do CIVA',
        'M31' => 'Isento nos termos da alínea b) do artigo 15.º do CIVA',
        'M32' => 'Isento nos termos da alínea c) do artigo 15.º do CIVA',
        'M33' => 'Isento nos termos da alínea d) do artigo 15.º do CIVA',
        'M34' => 'Isento nos termos da alínea e) do artigo 15.º do CIVA',
        'M35' => 'Isento nos termos da alínea f) do artigo 15.º do CIVA',
        'M36' => 'Isento nos termos da alínea g) do artigo 15.º do CIVA',
        'M37' => 'Isento nos termos da alínea h) do artigo 15.º do CIVA',
        'M38' => 'Isento nos termos da alínea i) do artigo 15.º do CIVA',
        'M90' => 'Isento nos termos da alinea a) do nº1 do artigo 16.º',
        'M91' => 'Isento nos termos da alinea b) do nº1 do artigo 16.º',
        'M92' => 'Isento nos termos da alinea c) do nº1 do artigo 16.º',
        'M93' => 'Isento nos termos da alinea d) do nº1 do artigo 16.º',
        'M94' => 'Isento nos termos da alinea e) do nº1 do artigo 16.º'

    ];

    if (isset($reasons) && is_array($reasons)) {
    foreach ($reasons as $code => $name) {
        \App\Models\ReasonTax::updateOrCreate(
            ['code' => $code],
            ['name' => $name]
        );

    }
       
    }      

}

}  
    
