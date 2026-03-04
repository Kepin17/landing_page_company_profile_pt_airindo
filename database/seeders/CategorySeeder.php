<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $tree = [
            'Air Cooled Chiller' => [
                'Industrial Chiller (Economical Design)',
                'Environmental Industrial Chiller',
                'Screw Chiller',
                'Packaged Low Temperature Chiller',
                'Low Temperature Screw Chiller',
                'Laser Chiller',
                'Heating And Cooling Chiller',
                'Plating Chiller',
                'Oil Chiller',
                'Mold Temperature Controller',
                'Cooling Tower',
            ],
            'Linghein' => [],
            'Jianye' => [
                'Screw Air Compressor',
                'Piston Air Compressor',
                'Air Tank',
                'Air Dryer',
                'Air Filter',
                'After Cooler',
                'Replacement',
            ],
            'Renner' => [
                'Screw Compressors',
                'Frequency Control',
                'Oilfree Compressors',
                'Piston Compressors',
                'Screw Booster',
                'Air Treatment',
                'Electronic Controls',
                'Heat Recovery',
            ],
        ];

        $parentOrder = 0;
        foreach ($tree as $parentName => $children) {
            $parent = Category::firstOrCreate(
                ['name' => $parentName, 'parent_id' => null],
                ['sort_order' => $parentOrder++]
            );

            $childOrder = 0;
            foreach ($children as $childName) {
                Category::firstOrCreate(
                    ['name' => $childName, 'parent_id' => $parent->id],
                    ['sort_order' => $childOrder++]
                );
            }
        }
    }
}
