<?php

use App\Models\Category;
use App\Models\Characteristic;
use Illuminate\Database\Migrations\Migration;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

/**
 * Class InitializeProducts
 * @noinspection PhpUnused
 */
class InitializeProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            // Categories
            $shirts = Category::create(['name' => 'Chemise']);
            $trousers = Category::create(['name' => 'Pantalon']);
            $accessories = Category::create(['name' => 'Accessoire']);
            $sweatshirts = Category::create(['name' => 'Pull']);
            $tshirts = Category::create(['name' => 'T-shirt']);
            $summerSeason = Category::create(['name' => 'Eté']);
            $winterSeason = Category::create(['name' => 'Hiver']);
            $limitedEdition = Category::create(['name' => 'Edition limitée']);
            $lastCollection = Category::create(['name' => 'Dernière collection']);

            // Characteristics colors
            $pinkColor = Characteristic::create(['name' => 'Couleur rose']);
            $whiteColor = Characteristic::create(['name' => 'Couleur blanc']);
            $yellowColor = Characteristic::create(['name' => 'Couleur jaune']);
            $greenColor = Characteristic::create(['name' => 'Couleur vert']);
            $colors = [$pinkColor, $whiteColor, $yellowColor, $greenColor];

            // Characteristics patterns
            $treePattern = Characteristic::create(['name' => 'Motif arbre']);
            $leafPattern = Characteristic::create(['name' => 'Motif feuille']);
            $dogPattern = Characteristic::create(['name' => 'Motif chien']);
            $patterns = [$treePattern, $leafPattern, $dogPattern];

            // Characteristics sleeves
            $longSleeves = Characteristic::create(['name' => 'Manches longues']);
            $shortSleeves = Characteristic::create(['name' => 'Manches courtes']);
            $sleeves = [$longSleeves, $shortSleeves];

            // Characteristics fits
            $slimFit = Characteristic::create(['name' => 'Coupe slim']);
            $regularFit = Characteristic::create(['name' => 'Coupe droite']);
            $largeFit = Characteristic::create(['name' => 'Coupe large']);
            $fits = [$slimFit, $regularFit, $largeFit];

            // Shirts
            $characteristics = array_merge($colors, $sleeves, $fits);
            foreach ($characteristics as $characteristic) {
                $shirts->characteristics()->attach($characteristic->id);
            }
            // Trousers
            $characteristics = array_merge($colors, $fits);
            foreach ($characteristics as $characteristic) {
                $trousers->characteristics()->attach($characteristic->id);
            }
            // Accessories
            $characteristics = array_merge($colors, $patterns);
            foreach ($characteristics as $characteristic) {
                $accessories->characteristics()->attach($characteristic->id);
            }
            // Sweatshirts
            $characteristics = array_merge($colors, $patterns, $fits);
            foreach ($characteristics as $characteristic) {
                $sweatshirts->characteristics()->attach($characteristic->id);
            }
            // T-shirts
            $characteristics = array_merge($colors, $patterns, $sleeves, $fits);
            foreach ($characteristics as $characteristic) {
                $tshirts->characteristics()->attach($characteristic->id);
            }

            // Products
            $product1 = Product::create(['name' => 'Maillot de corps']);
            $product1->categories()->attach([$shirts->id, $winterSeason->id, $summerSeason->id]);
            foreach([$whiteColor, $greenColor, $slimFit, $shortSleeves] as $characteristic) {
                $product1->characteristics()->attach($characteristic->id);
            }
            $product2 = Product::create(['name' => 'Casquette']);
            $product2->categories()->attach([$accessories->id, $summerSeason->id, $limitedEdition->id]);
            foreach(array_merge($colors, $patterns) as $characteristic) {
                $product2->characteristics()->attach($characteristic->id);
            }
            $product3 = Product::create(['name' => 'Jean']);
            $product3->categories()->attach([$trousers->id, $winterSeason->id, $limitedEdition->id]);
            foreach($fits as $characteristic) {
                $product3->characteristics()->attach($characteristic->id);
            }
            $product4 = Product::create(['name' => 'Jogging']);
            $product4->categories()->attach([$trousers->id, $summerSeason->id]);
            foreach(array_merge($fits, $colors) as $characteristic) {
                $product4->characteristics()->attach($characteristic->id);
            }
            $product5 = Product::create(['name' => 'Chaussettes']);
            $product5->categories()->attach([$accessories->id, $summerSeason->id, $winterSeason->id]);
            foreach(array_merge($patterns, $colors) as $characteristic) {
                $product5->characteristics()->attach($characteristic->id);
            }
            $product6 = Product::create(['name' => 'Sweat à capuche']);
            $product6->categories()->attach([$sweatshirts->id, $winterSeason->id]);
            foreach(array_merge($patterns, $colors) as $characteristic) {
                $product6->characteristics()->attach($characteristic->id);
            }
            $product7 = Product::create(['name' => 'Sweat léger']);
            $product7->categories()->attach([$sweatshirts->id, $summerSeason->id, $limitedEdition->id, $lastCollection->id]);
            foreach(array_merge($fits, $colors, $sleeves) as $characteristic) {
                $product7->characteristics()->attach($characteristic->id);
            }
            $product8 = Product::create(['name' => 'Echarpe']);
            $product8->categories()->attach([$accessories->id, $winterSeason->id, $lastCollection->id]);
            foreach(array_merge($colors, $patterns) as $characteristic) {
                $product8->characteristics()->attach($characteristic->id);
            }
            $product9 = Product::create(['name' => 'Polo']);
            $product9->categories()->attach([$tshirts->id, $summerSeason->id, $lastCollection->id]);
            foreach(array_merge($fits, $colors) as $characteristic) {
                $product9->characteristics()->attach($characteristic->id);
            }
            $product10 = Product::create(['name' => 'Cravate']);
            $product10->categories()->attach([$accessories->id, $limitedEdition->id]);
            foreach(array_merge($patterns, $colors) as $characteristic) {
                $product10->characteristics()->attach($characteristic->id);
            }
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
