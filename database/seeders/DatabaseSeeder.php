<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\DeliveryType;
use App\Models\Product;
use App\Models\StatusCode;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    

    public function run()
    {
        function createDirectory($type,$name){
            $entity = new $type;
            $entity->name = $name;
            $entity->save();
        }

        // \App\Models\User::factory(10)->create();
        $categories = Category::factory(15)->create();
        foreach($categories as $category){
            Product::factory(10)->create([
                'category_id' => $category->id
            ]);
        };

        createDirectory(StatusCode::class, 'Сделан');
        createDirectory(StatusCode::class, 'Оплачен');
        createDirectory(StatusCode::class, 'Доставляется');
        createDirectory(StatusCode::class, 'Доставлен');
        createDirectory(StatusCode::class, 'Получен');

        createDirectory(DeliveryType::class, 'Пешком');
        createDirectory(DeliveryType::class, 'На машине');
        createDirectory(DeliveryType::class, 'Поездом');
        createDirectory(DeliveryType::class, 'На самолете');
    }
}
