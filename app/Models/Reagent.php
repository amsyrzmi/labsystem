<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reagent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'molar_mass',
        'density',
        'formula',
    ];

    /**
     * Calculate amount needed for solid reagent
     * 
     * @param float $concentration Target concentration in mol/dm³
     * @param float $volume Volume in cm³
     * @return float Mass in grams
     */
    public function calculateSolid($concentration, $volume)
    {
        // Formula: mass = concentration × molar_mass × (volume/1000)
        return $concentration * $this->molar_mass * ($volume / 1000);
    }

    /**
     * Calculate volume needed for liquid reagent
     * 
     * @param float $concentration Target concentration in mol/dm³
     * @param float $volume Volume in cm³
     * @param float $purity Purity as percentage (e.g., 69 for 69%)
     * @return array ['volume' => float, 'details' => array]
     */
    public function calculateLiquid($concentration, $volume, $purity)
    {
        // Step 1: Calculate mass of solution
        $massOfSolution = $volume * $this->density; // g
        
        $actualmass = $massOfSolution * ($purity / 100);
        $moleconverted = $actualmass / $this->molar_mass;
        $targetvolume = ($concentration * $volume) / ($moleconverted / ($volume / 1000));
        
        
        return [
            'volume' => round($targetvolume, 2),
            'details' => [
                'mass_of_solution' => round($massOfSolution, 2),
                'mass_of_pure_reagent' => round($actualmass, 2),
                'molarity_concentrated' => round($moleconverted, 2),
            ]
        ];
    }
}