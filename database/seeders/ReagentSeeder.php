<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reagent;

class ReagentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reagents = [
        
        // Acids
        [
            'name' => 'Nitric Acid',
            'type' => 'liquid',
            'molar_mass' => 63.01,
            'density' => 1.42,
            'formula' => 'HNO₃',
        ],
        [
            'name' => 'Sulphuric Acid',
            'type' => 'liquid',
            'molar_mass' => 98.08,
            'density' => 1.84,
            'formula' => 'H₂SO₄',
        ],
        [
            'name' => 'Hydrochloric Acid',
            'type' => 'liquid',
            'molar_mass' => 36.46,
            'density' => 1.18,
            'formula' => 'HCl',
        ],
        [
            'name' => 'Acetic Acid',
            'type' => 'liquid',
            'molar_mass' => 60.05,
            'density' => 1.05,
            'formula' => 'CH₃COOH',
        ],

        // Bases
        [
            'name' => 'Ammonia',
            'type' => 'liquid',
            'molar_mass' => 17.03,
            'density' => 0.91,
            'formula' => 'NH₃',
        ],
        [
            'name' => 'Sodium Hydroxide',
            'type' => 'solid',
            'molar_mass' => 40.00,
            'density' => null,
            'formula' => 'NaOH',
        ],
        [
            'name' => 'Potassium Hydroxide',
            'type' => 'solid',
            'molar_mass' => 56.11,
            'density' => null,
            'formula' => 'KOH',
        ],
        [
            'name' => 'Barium Hydroxide',
            'type' => 'solid',
            'molar_mass' => 171.34,
            'density' => null,
            'formula' => 'Ba(OH)₂',
        ],
        [
            'name' => 'Calcium Hydroxide',
            'type' => 'solid',
            'molar_mass' => 74.09,
            'density' => null,
            'formula' => 'Ca(OH)₂',
        ],

        // Ammonium salts
        [
            'name' => 'Ammonium Chloride',
            'type' => 'solid',
            'molar_mass' => 53.49,
            'density' => null,
            'formula' => 'NH₄Cl',
        ],
        [
            'name' => 'Ammonium Acetate',
            'type' => 'solid',
            'molar_mass' => 77.08,
            'density' => null,
            'formula' => 'NH₄CH₃COO',
        ],
        [
            'name' => 'Ammonium Nitrate',
            'type' => 'solid',
            'molar_mass' => 80.04,
            'density' => null,
            'formula' => 'NH₄NO₃',
        ],
        [
            'name' => 'Ammonium Sulphate',
            'type' => 'solid',
            'molar_mass' => 132.14,
            'density' => null,
            'formula' => '(NH₄)₂SO₄',
        ],
        [
            'name' => 'Ammonium Thiocyanate',
            'type' => 'solid',
            'molar_mass' => 76.12,
            'density' => null,
            'formula' => 'NH₄SCN',
        ],

        // Aluminium
        [
            'name' => 'Aluminium Nitrate',
            'type' => 'solid',
            'molar_mass' => 212.99,
            'density' => null,
            'formula' => 'Al(NO₃)₃',
        ],
        [
            'name' => 'Aluminium Sulphate',
            'type' => 'solid',
            'molar_mass' => 342.15,
            'density' => null,
            'formula' => 'Al₂(SO₄)₃',
        ],

        // Barium
        [
            'name' => 'Barium Chloride',
            'type' => 'solid',
            'molar_mass' => 208.23,
            'density' => null,
            'formula' => 'BaCl₂',
        ],
        [
            'name' => 'Barium Nitrate',
            'type' => 'solid',
            'molar_mass' => 261.34,
            'density' => null,
            'formula' => 'Ba(NO₃)₂',
        ],

        // Calcium
        [
            'name' => 'Calcium Chloride',
            'type' => 'solid',
            'molar_mass' => 110.98,
            'density' => null,
            'formula' => 'CaCl₂',
        ],
        [
            'name' => 'Calcium Nitrate',
            'type' => 'solid',
            'molar_mass' => 164.10,
            'density' => null,
            'formula' => 'Ca(NO₃)₂',
        ],

        // Transition metals
        [
            'name' => 'Cobalt(II) Chloride',
            'type' => 'solid',
            'molar_mass' => 129.84,
            'density' => null,
            'formula' => 'CoCl₂',
        ],
        [
            'name' => 'Cobalt(II) Nitrate',
            'type' => 'solid',
            'molar_mass' => 182.94,
            'density' => null,
            'formula' => 'Co(NO₃)₂',
        ],
        [
            'name' => 'Copper(II) Sulphate',
            'type' => 'solid',
            'molar_mass' => 159.61,
            'density' => null,
            'formula' => 'CuSO₄',
        ],
        [
            'name' => 'Copper(II) Nitrate',
            'type' => 'solid',
            'molar_mass' => 187.56,
            'density' => null,
            'formula' => 'Cu(NO₃)₂',
        ],
        [
            'name' => 'Copper(II) Chloride',
            'type' => 'solid',
            'molar_mass' => 134.45,
            'density' => null,
            'formula' => 'CuCl₂',
        ],
        [
            'name' => 'Iron(III) Chloride',
            'type' => 'solid',
            'molar_mass' => 162.20,
            'density' => null,
            'formula' => 'FeCl₃',
        ],
        [
            'name' => 'Iron(II) Sulphate',
            'type' => 'solid',
            'molar_mass' => 151.91,
            'density' => null,
            'formula' => 'FeSO₄',
        ],

        // Lead
        [
            'name' => 'Lead Acetate',
            'type' => 'solid',
            'molar_mass' => 325.29,
            'density' => null,
            'formula' => 'Pb(CH₃COO)₂',
        ],
        [
            'name' => 'Lead(II) Nitrate',
            'type' => 'solid',
            'molar_mass' => 331.21,
            'density' => null,
            'formula' => 'Pb(NO₃)₂',
        ],

        // Magnesium
        [
            'name' => 'Magnesium Bromide',
            'type' => 'solid',
            'molar_mass' => 184.11,
            'density' => null,
            'formula' => 'MgBr₂',
        ],
        [
            'name' => 'Magnesium Chloride',
            'type' => 'solid',
            'molar_mass' => 95.21,
            'density' => null,
            'formula' => 'MgCl₂',
        ],
        [
            'name' => 'Magnesium Nitrate',
            'type' => 'solid',
            'molar_mass' => 148.31,
            'density' => null,
            'formula' => 'Mg(NO₃)₂',
        ],
        [
            'name' => 'Magnesium Sulphate',
            'type' => 'solid',
            'molar_mass' => 120.37,
            'density' => null,
            'formula' => 'MgSO₄',
        ],

        // Manganese / Mercury / Nickel / Zinc
        [
            'name' => 'Manganese(II) Chloride',
            'type' => 'solid',
            'molar_mass' => 125.84,
            'density' => null,
            'formula' => 'MnCl₂',
        ],
        [
            'name' => 'Manganese(II) Sulphate',
            'type' => 'solid',
            'molar_mass' => 151.00,
            'density' => null,
            'formula' => 'MnSO₄',
        ],
        [
            'name' => 'Mercury(II) Chloride',
            'type' => 'solid',
            'molar_mass' => 271.50,
            'density' => null,
            'formula' => 'HgCl₂',
        ],
        [
            'name' => 'Nickel Chloride',
            'type' => 'solid',
            'molar_mass' => 129.60,
            'density' => null,
            'formula' => 'NiCl₂',
        ],
        [
            'name' => 'Nickel Nitrate',
            'type' => 'solid',
            'molar_mass' => 182.70,
            'density' => null,
            'formula' => 'Ni(NO₃)₂',
        ],
        [
            'name' => 'Nickel Sulphate',
            'type' => 'solid',
            'molar_mass' => 154.75,
            'density' => null,
            'formula' => 'NiSO₄',
        ],
        [
            'name' => 'Zinc Nitrate',
            'type' => 'solid',
            'molar_mass' => 189.40,
            'density' => null,
            'formula' => 'Zn(NO₃)₂',
        ],
        [
            'name' => 'Zinc Sulphate',
            'type' => 'solid',
            'molar_mass' => 161.47,
            'density' => null,
            'formula' => 'ZnSO₄',
        ],

        // Alkali metal salts
        [
            'name' => 'Potassium Chloride',
            'type' => 'solid',
            'molar_mass' => 74.55,
            'density' => null,
            'formula' => 'KCl',
        ],
        [
            'name' => 'Potassium Bromide',
            'type' => 'solid',
            'molar_mass' => 119.00,
            'density' => null,
            'formula' => 'KBr',
        ],
        [
            'name' => 'Potassium Iodide',
            'type' => 'solid',
            'molar_mass' => 166.00,
            'density' => null,
            'formula' => 'KI',
        ],
        [
            'name' => 'Potassium Nitrate',
            'type' => 'solid',
            'molar_mass' => 101.10,
            'density' => null,
            'formula' => 'KNO₃',
        ],
        [
            'name' => 'Potassium Carbonate',
            'type' => 'solid',
            'molar_mass' => 138.21,
            'density' => null,
            'formula' => 'K₂CO₃',
        ],
        [
            'name' => 'Potassium Hydrogen Carbonate',
            'type' => 'solid',
            'molar_mass' => 100.12,
            'density' => null,
            'formula' => 'KHCO₃',
        ],
        [
            'name' => 'Potassium Sulphate',
            'type' => 'solid',
            'molar_mass' => 174.26,
            'density' => null,
            'formula' => 'K₂SO₄',
        ],
        [
            'name' => 'Potassium Thiocyanate',
            'type' => 'solid',
            'molar_mass' => 97.18,
            'density' => null,
            'formula' => 'KSCN',
        ],
        [
            'name' => 'Potassium Chromate',
            'type' => 'solid',
            'molar_mass' => 194.19,
            'density' => null,
            'formula' => 'K₂CrO₄',
        ],
        [
            'name' => 'Potassium Dichromate',
            'type' => 'solid',
            'molar_mass' => 294.18,
            'density' => null,
            'formula' => 'K₂Cr₂O₇',
        ],
        [
            'name' => 'Potassium Hexacyanoferrate(II)',
            'type' => 'solid',
            'molar_mass' => 368.35,
            'density' => null,
            'formula' => 'K₄[Fe(CN)₆]',
        ],
        [
            'name' => 'Potassium Hexacyanoferrate(III)',
            'type' => 'solid',
            'molar_mass' => 329.24,
            'density' => null,
            'formula' => 'K₃[Fe(CN)₆]',
        ],

        // Sodium salts
        [
            'name' => 'Sodium Chloride',
            'type' => 'solid',
            'molar_mass' => 58.44,
            'density' => null,
            'formula' => 'NaCl',
        ],
        [
            'name' => 'Sodium Acetate',
            'type' => 'solid',
            'molar_mass' => 82.03,
            'density' => null,
            'formula' => 'CH₃COONa',
        ],
        [
            'name' => 'Sodium Bicarbonate',
            'type' => 'solid',
            'molar_mass' => 84.01,
            'density' => null,
            'formula' => 'NaHCO₃',
        ],
        [
            'name' => 'Sodium Carbonate',
            'type' => 'solid',
            'molar_mass' => 105.99,
            'density' => null,
            'formula' => 'Na₂CO₃',
        ],
        [
            'name' => 'Sodium Nitrate',
            'type' => 'solid',
            'molar_mass' => 85.00,
            'density' => null,
            'formula' => 'NaNO₃',
        ],
        [
            'name' => 'Sodium Sulphate',
            'type' => 'solid',
            'molar_mass' => 142.04,
            'density' => null,
            'formula' => 'Na₂SO₄',
        ],
        [
            'name' => 'Sodium Thiosulfate',
            'type' => 'solid',
            'molar_mass' => 158.11,
            'density' => null,
            'formula' => 'Na₂S₂O₃',
        ],
        [
            'name' => 'Sodium Oxalate',
            'type' => 'solid',
            'molar_mass' => 134.00,
            'density' => null,
            'formula' => 'Na₂C₂O₄',
        ],
        [
            'name' => 'Sodium Silicate',
            'type' => 'solid',
            'molar_mass' => 122.06,
            'density' => null,
            'formula' => 'Na₂SiO₃',
        ],
        [
            'name' => 'Sodium Dichromate',
            'type' => 'solid',
            'molar_mass' => 261.97,
            'density' => null,
            'formula' => 'Na₂Cr₂O₇',
        ],
        [
            'name' => 'Sodium Fluoride',
            'type' => 'solid',
            'molar_mass' => 41.99,
            'density' => null,
            'formula' => 'NaF',
        ],
        [
            'name' => 'Sodium Peroxide',
            'type' => 'solid',
            'molar_mass' => 77.98,
            'density' => null,
            'formula' => 'Na₂O₂',
        ],

        // Silver
        [
            'name' => 'Silver Nitrate',
            'type' => 'solid',
            'molar_mass' => 169.87,
            'density' => null,
            'formula' => 'AgNO₃',
        ],

        ];

        foreach ($reagents as $reagent) {
            Reagent::create($reagent);
        }
    }
}