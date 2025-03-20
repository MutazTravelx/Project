<?php

namespace Modules\Packages\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Packages\Models\Package;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Package::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),  // توليد اسم عشوائي
            'images' => json_encode([         // توليد بيانات وهمية لصورة
                'packages/01JPSBDAVDETR6QVGQPRNNWV2Q.png',
                'packages/01JPSBDAVJG03XY6C05WZ8Z9Y5.png',
            ]),
            'description' => $this->faker->paragraph(),  // توليد وصف عشوائي
            'duration' => $this->faker->numberBetween(1, 30),  // مدة العطلة بين 1 و 30
            'destination' => $this->faker->city(),  // وجهة عشوائية
            'price1' => $this->faker->randomFloat(2, 100, 1000), // سعر عشوائي بين 100 و 1000
            'price2' => $this->faker->randomFloat(2, 50, 500), // سعر عشوائي بين 50 و 500
            'price3' => $this->faker->randomFloat(2, 150, 1500), // سعر عشوائي بين 150 و 1500
            'price4' => $this->faker->randomFloat(2, 200, 2000), 
        ];
    }
}
