<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Experiment;

class ExperimentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chemistryf4 = [
            ['name' => 'Experiment 1.1 Temperature Effects on Solubility', 'topic_id' => 1],
            ['name' => 'Experiment 4.1 Chemical properties of Group 1', 'topic_id' => 4],
            ['name' => 'Experiment 4.2 Chemical properties of oxides of Period 3', 'topic_id' => 4],
            ['name' => 'Experiment 5.1 Properties of Ionic and Covalent Compounds', 'topic_id' => 5],
            ['name' => 'Experiment 6.1 Role of Water in Showing Acidic properties', 'topic_id' => 6],
            ['name' => 'Experiment 6.2 Role of Water in Showing Alkaline properties', 'topic_id' => 6],
            ['name' => 'Experiment 6.3 Hydrogen Ions and pH values', 'topic_id' => 6],
            ['name' => 'Experiment 6.4 Hydroxide Ions and pH values', 'topic_id' => 6],
            ['name' => 'Experiment 6.5 Solubility of Various Salts in Water', 'topic_id' => 6],
            ['name' => 'Experiment 6.6 Ionic Quation For Formation of Lead(II) Iodide', 'topic_id' => 6],
            ['name' => 'Experiment 6.7 Action of Heat on Carbonate Salts', 'topic_id' => 6],
            ['name' => 'Experiment 6.8 Action of Heat on Nitrate Salts', 'topic_id' => 6],
            ['name' => 'Experiment 6.9 Identification of Anions in Aqueous Solutions', 'topic_id' => 6],
            ['name' => 'Experiment 6.10 Identification of Cations in Aqueous Solutions', 'topic_id' => 6],
            ['name' => 'Experiment 6.11 Cations confirmation test(NH₄⁺,Fe³⁺,Fe²⁺ and Pb²⁺)', 'topic_id' => 6],
            ['name' => 'Experiment 7.1 Size of Reactants on Rate of Reaction', 'topic_id' => 7],
            ['name' => 'Experiment 7.2 Concentration of Reactants on Rate of Reaction', 'topic_id' => 7],
            ['name' => 'Experiment 7.3 Temperature of Reactants on Rate of Reaction', 'topic_id' => 7],
            ['name' => 'Experiment 7.4 Catalyst on Rate of Reaction', 'topic_id' => 7],
            ['name' => 'Experiment 8.1 Properties of Alloys and Pure Metals', 'topic_id' => 8],


        ];

        $chemistryf5 = [
            //chemistry form 5 experiments
            ['name' => 'Experiment 1A Voltage of a Voltaic Cell', 'topic_id' => 9],
            ['name' => 'Experiment 1B Selective Discharge of Ions in Hydrochloric Acid', 'topic_id' => 9],
            ['name' => 'Experiment 1C Effects of Electrode types on Selective Discharge of Ions in Hydrochloric Acid', 'topic_id' => 9],
            ['name' => 'Experiment 1D Corrosion of Copper and Iron', 'topic_id' => 9],
            ['name' => 'Experiment 1E Effects of Other Metals on Rusting', 'topic_id' => 9],
            ['name' => 'Experiment 2A Alkane and Alkene Comparisons', 'topic_id' => 10],
            ['name' => 'Experiment 3A Comparing Heat of Neutralisation', 'topic_id' => 11],
            ['name' => 'Experiment 3B Heat of Combustion of Various Alcohols', 'topic_id' => 11],
            ['name' => 'Experiment 4A Coagulation of Latex', 'topic_id' => 12],
            ['name' => 'Experiment 4B Elasticity of Vulcanised Rubber', 'topic_id' => 12],
            ['name' => 'Experiment 5A Cleansing Action of Soap and Detergent', 'topic_id' => 13],
        ];

        $sciencef1 = [
            //science form 1 experiments
            ['name' => 'Experiment 1.1 Length of Pendulum and Period of Oscillation', 'topic_id' => 74],
            ['name' => 'Experiment 2.1 Photosynthesis and Light', 'topic_id' => 75],
            ['name' => 'Experiment 2.2 Photosynthesis and Chlorophyll', 'topic_id' => 75],
            ['name' => 'Experiment 2.3 Photosynthesis and Carbon Dioxide', 'topic_id' => 75],
            ['name' => 'Experiment 2.4 Photosynthesis and Water', 'topic_id' => 75],
            ['name' => 'Experiment 3.1 Sweat and Temperature', 'topic_id' => 76],
            ['name' => 'Experiment 3.2 Pulse Count and Heavy Task', 'topic_id' => 76],
            ['name' => 'Experiment 4.1 Conditions of Germination', 'topic_id' => 77],
            ['name' => 'Experiment 5.1 Difference in Rate of Diffusions between Solids and Liquids', 'topic_id' => 78],
            ['name' => 'Experiment 6.2 Metal and Non-Metal Differences', 'topic_id' => 79],
            ['name' => 'Experiment 8.1 Relationship between Angle of Incidence and Angle of Reflection', 'topic_id' => 81],
            ['name' => 'Experiment 8.2 Relationship between Angle of Incidence and Angle of Refraction', 'topic_id' => 81],
        ];

        $sciencef2 = [
            //science form 2 experiments
            ['name' => 'Experiment 2.1 Factors affecting Distribution of Organisms', 'topic_id' => 84],
            ['name' => 'Experiment 3.1 Glucose Absorption through a Visking Tube', 'topic_id' => 85],
            ['name' => 'Experiment 5.1 Factors affecting Evaporation of Water', 'topic_id' => 87],
            ['name' => 'Experiment 5.2 Factors affecting Rate of Solubility', 'topic_id' => 87],
            ['name' => 'Experiment 7.1 Effects of Resistance and Voltage Changes on Electric Current', 'topic_id' => 89],
            ['name' => 'Experiment 7.2 Factors that Influences the Magnetic Field Strength', 'topic_id' => 89],
            ['name' => 'Experiment 8.1 Effect of Density on the Position of Object in Water', 'topic_id' => 90],
            ['name' => 'Experiment 8.2 Relationship between Surface Area and Pressure', 'topic_id' => 90],
            ['name' => 'Experiment 9.1 Usage of Different Materials as Heat Insulators', 'topic_id' => 91],
            ['name' => 'Experiment 9.2 Heat Radiation and Absorption of Dark and White Objects', 'topic_id' => 91],
            
        ];

        $sciencef3 = [
            //science form 3 experiments
            ['name' => 'Experiment 1.1 Response of Plants to Light', 'topic_id' => 97],
            ['name' => 'Experiment 2.1 Oxygen and Carbon Dioxide in Inhaled and Exhaled Air', 'topic_id' => 98],
            ['name' => 'Experiment 2.2 Effects of Smoking on The Lungs(Demonstration)', 'topic_id' => 98],
            ['name' => 'Experiment 3.1 Factors that Influence the Pulse Rate', 'topic_id' => 99],
            ['name' => 'Experiment 3.2 Effect of Light Intensity on the Rate of Transpiration', 'topic_id' => 99],
            ['name' => 'Experiment 3.3 Effect of Air Humidity on the Rate of Transpiration', 'topic_id' => 99],
            ['name' => 'Experiment 3.4 Effect of Air Movement on the Rate of Transpiration', 'topic_id' => 99],
            ['name' => 'Experiment 3.5 Effect of Temperature on the Rate of Transpiration', 'topic_id' => 99],
            ['name' => 'Experiment 5.1 Exothermic and Endothermic Reactions Comparisons', 'topic_id' => 101],
            ['name' => 'Experiment 6.1 Functionality of Step-Up Transformer and Step-Down Transformer', 'topic_id' => 102],
            
        ];

        $sciencef4 = [
            //science form 4 experiments
            ['name' => 'Experiment 3.1 Pulse Rate Factors', 'topic_id' => 55],
            ['name' => 'Experiment 9.1 Hardness of Alloys compared to Pure Metals', 'topic_id' => 61],
            ['name' => 'Experiment 9.2 Alloys Corrosion Resistance compared to Pure Metals', 'topic_id' => 61],
            ['name' => 'Experiment 11.1 Gravitational Acceleration', 'topic_id' => 63],
            ['name' => 'Experiment 11.2 Time taken for Free Fall and Non-Free Fall', 'topic_id' => 63],
            ['name' => 'Experiment 11.3 Mass and Inertia Correlation', 'topic_id' => 63],
        ];

        $sciencef5 = [
            //science form 5 experiments
            ['name' => 'Experiment 1.1 Growth of Bacteria on Sterile Nutrient', 'topic_id' => 65],
            ['name' => 'Experiment 1.2 Factors affecting Growth of Microorganisms', 'topic_id' => 65],
            ['name' => 'Experiment 2.1 Calorific value of Several Food Samples', 'topic_id' => 66],
            ['name' => 'Experiment 2.2 Effects of Macronutrients Defficiency on Plant Growth', 'topic_id' => 66],
            ['name' => 'Experiment 4.1 Effects of Temperature on the Rate of Reaction', 'topic_id' => 68],
            ['name' => 'Experiment 4.2 Effects of Concentration on the Rate of Reaction', 'topic_id' => 68],
            ['name' => 'Experiment 4.3 Effect of Reactant Size on the Rate of Reaction', 'topic_id' => 68],
            ['name' => 'Experiment 4.4 Effect of Catalyst on the Rate of Reaction', 'topic_id' => 68],
            ['name' => 'Experiment 5.1 Saponification Process', 'topic_id' => 69],
            ['name' => 'Experiment 6.1 Electrolysis of Ionic Compounds', 'topic_id' => 70],
            ['name' => 'Experiment 6.2 Tendency of Ions to be Discharged with Electrochemical Series ', 'topic_id' => 70],
            ['name' => 'Experiment 6.3 Tendency of Ions to be Discharged with Concentration of Ions', 'topic_id' => 70],
            ['name' => 'Experiment 6.4 Selective Discharge with Type of Electrodes', 'topic_id' => 70],
        ];

        $physicsf4 = [
            //physics form 4 experiments
            ['name' => 'Experiment 1.1 Effects of Length towards Oscillation Period', 'topic_id' => 14],
            ['name' => 'Experiment 2.1 Determination of Acceleration due to Gravity', 'topic_id' => 15],
            ['name' => 'Experiment 2.2 Effects of Mass towards Inertia', 'topic_id' => 15],
            ['name' => 'Experiment 4.1 Specific Heat Capacity of Water', 'topic_id' => 17],
            ['name' => 'Experiment 4.2 Specific Heat Capacity of Aluminium', 'topic_id' => 17],
            ['name' => 'Experiment 4.3 Latent Heat of Fusion and Vaporisation', 'topic_id' => 17],
            ['name' => 'Experiment 4.4 Effects of Volume on Pressure of Gas', 'topic_id' => 17],
            ['name' => 'Experiment 4.5 Effects of Temperature on Volume of Gas', 'topic_id' => 17],
            ['name' => 'Experiment 4.6 Effects of Temperature on Pressure of Gas', 'topic_id' => 17],
            ['name' => 'Experiment 6.1 Correlation between Angle of Incidence and Angle of Refraction', 'topic_id' => 19],
            ['name' => 'Experiment 6.2 Influence of Object Position and Refractive Index on Image Position', 'topic_id' => 19],

        ];
        $physicsf5 = [
            //physics form 5 experiments
            ['name' => 'Experiment 1.1 Force applied on Spring affects the Extension of the Spring', 'topic_id' => 20],
            ['name' => 'Experiment 2.1 Depths of Liquid affects Pressure', 'topic_id' => 21],
            ['name' => 'Experiment 2.2 Density of Liquid affects Pressure ', 'topic_id' => 21],
            ['name' => 'Experiment 2.3 Weight of Liquid Displaced affects Buoyant Force', 'topic_id' => 21],
            ['name' => 'Experiment 3.1 Potential Difference and Current', 'topic_id' => 22],
            ['name' => 'Experiment 3.2 Length of Wire affects Resistance', 'topic_id' => 22],
            ['name' => 'Experiment 3.3 Cross-sectional Area of Wire affects Resistance', 'topic_id' => 22],
            ['name' => 'Experiment 3.4 Resistivity and Resistance', 'topic_id' => 22],
            ['name' => 'Experiment 3.5 e.m.f and Internal Resistance of a Dry Cell', 'topic_id' => 22],

        ];

        $biologyf4 = [
            //biology form 4 experiments
            ['name' => 'Activity 1.1 Effects of an Activity on Pulse Rate', 'topic_id' => 26],
            ['name' => 'Activity 2.1 Slides of Plant Cells', 'topic_id' => 27],
            ['name' => 'Activity 2.2 Slides of Animal Cells', 'topic_id' => 27],
            ['name' => 'Activity 3.1 Movement of Substances across a Selectively Permeable Membrane', 'topic_id' => 28],
            ['name' => 'Activity 3.2 Movement of Substances across a Visking Tube', 'topic_id' => 28],
            ['name' => 'Activity 3.3 Hypotonic,Hypertonic and Isotonic Solutions on Animal Cells', 'topic_id' => 28],
            ['name' => 'Activity 3.4 Hypotonic,Hypertonic and Isotonic Solutions on Plant Cells', 'topic_id' => 28],
            ['name' => 'Activity 3.5 Concentration of Isotonic Extracellular Solution ', 'topic_id' => 28],
            ['name' => 'Activity 3.6 Movement of Substances across a Plasma Membrane', 'topic_id' => 28],
            ['name' => 'Activity 5.1 Temperature Effect on Amylase Enzyme Activity', 'topic_id' => 30],
            ['name' => 'Activity 5.2 pH Effect on Amylase Enzyme Activity', 'topic_id' => 30],
            ['name' => 'Activity 7.1 Aerobic Respiration Study', 'topic_id' => 32],
            ['name' => 'Activity 7.3 Process of Yeast Fermentation', 'topic_id' => 32],
            ['name' => 'Activity 9.1 Digestion of Starch in a Food Sample', 'topic_id' => 34],
            ['name' => 'Activity 9.2 Digestion of Protein in a Food Sample', 'topic_id' => 34],
            ['name' => 'Activity 9.3 Digestion of Lipids in a Food Sample', 'topic_id' => 34],
            ['name' => 'Activity 9.4 Energy Value of Food Samples', 'topic_id' => 34],
            ['name' => 'Activity 9.5 Contents of Vitamin C in Fruit and Vegetable Juices', 'topic_id' => 34],
            ['name' => 'Activity 9.6 Effect of Temperature on Vitamin C in Orange Juice', 'topic_id' => 34],
            ['name' => 'Activity 13.1 Volume of Water and Urine Production', 'topic_id' => 38],
        ];

        $biologyf5 = [
            //biology form 5 experiments
            ['name' => 'Experiment 1.1 Shape of Growth Curve in Plants', 'topic_id' => 41],
            ['name' => 'Experiment 1.2 Effect of Sound Towards Growth of Plants', 'topic_id' => 41],
            ['name' => 'Experiment 2.1 Distribution of Stomata on Epidermis of Monocot and Eudicot Leaves', 'topic_id' => 42],
            ['name' => 'Experiment 2.2 Environmental Factors on Rate of Transpiration', 'topic_id' => 42],
            ['name' => 'Experiment 2.3 Environmental Factors on Rate of Photosynthesis', 'topic_id' => 42],
            ['name' => 'Experiment 2.4 Best Light Colour for Aquatic Plants', 'topic_id' => 42],
            ['name' => 'Experiment 3.1 Nitrogen,Phosphorus and Potassium Effects on Plant Growth', 'topic_id' => 43],
            ['name' => 'Experiment 4.1 Effect of Root Pressure on Water Transport', 'topic_id' => 44],
            ['name' => 'Experiment 4.2 Effect of Transpirational Pull on Water Transport', 'topic_id' => 44],
            ['name' => 'Experiment 4.3 Phloem Role in Transport of Organic Substances', 'topic_id' => 44],
            ['name' => 'Experiment 4.4 Effectiveness of Phytoremediation Plants on Polluted Water', 'topic_id' => 44],
            ['name' => 'Experiment 4.5 Effectiveness of Phytoremediation Plants on Polluted Soil', 'topic_id' => 44],
            ['name' => 'Experiment 5.1 Radicles and Seedlings Response towards Gravity', 'topic_id' => 45],
            ['name' => 'Experiment 5.2 Fruit Ripening with Phytohormones', 'topic_id' => 45],
            ['name' => 'Experiment 9.1 Intraspecific and Interspecific Competition among Organisms', 'topic_id' => 49],
            ['name' => 'Experiment 10.1 Level of BOD Present in Different Water Samples', 'topic_id' => 50],
            ['name' => 'Experiment 12.1 Continuous and Discontinuous Variation in Humans', 'topic_id' => 52],
        ];

        foreach ($chemistryf4 as $experiment) {
            Experiment::create($experiment);
        }
        foreach ($physicsf4 as $experiment) {
            Experiment::create($experiment);
        }
        foreach ($chemistryf5 as $experiment) {
            Experiment::create($experiment);
        }
        foreach ($sciencef4 as $experiment) {
            Experiment::create($experiment);
        }
        foreach ($sciencef5 as $experiment) {
            Experiment::create($experiment);
        }
        foreach ($sciencef1 as $experiment) {
            Experiment::create($experiment);
        }
        foreach ($sciencef2 as $experiment) {
            Experiment::create($experiment);
        }
        foreach ($sciencef3 as $experiment) {
            Experiment::create($experiment);
        }
        foreach ($physicsf5 as $experiment) {
            Experiment::create($experiment);
        }
        foreach ($biologyf4 as $experiment) {
            Experiment::create($experiment);
        }
        foreach ($biologyf5 as $experiment) {
            Experiment::create($experiment);
        }
    }
}
