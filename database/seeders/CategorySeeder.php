<?php

namespace Database\Seeders;
use App\Models\Category;
use Exception;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * @throws Exception
     */
    public function run(): void
    {
        $this->createCategory('NBA');
        $this->createCategory('EuroLeague');
    }

    private function createCategory(string $name): void
    {
        $category = new Category();
        $category->name = $name;
        $category->save();
    }
}
