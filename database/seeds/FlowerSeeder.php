<?php

use App\Flower;
use Illuminate\Database\Seeder;

class FlowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Flower::create([
            'name' => 'Eternal Red',
            'type_id' => 1,
            'price' => 345000,
            'description' => 'This beautiful bouquet of red roses symbolizes love and affection.',
            'stock' => 30,
            'image' => 'storage/images/eternal-red.jpg'
        ]);

        Flower::create([
            'name' => 'Sweet Sentiment',
            'type_id' => 1,
            'price' => 435000,
            'description' => 'An arrangment of elegant pink roses, accompanied with babys breath',
            'stock' => 25,
            'image' => 'storage/images/sweet-sentiment.jpg'
        ]);

        Flower::create([
            'name' => 'Majestic Blue',
            'type_id' => 1,
            'price' => 345000,
            'description' => '12 fresh blue roses bundled together in a matching blue wrapping paper.',
            'stock' => 15,
            'image' => 'storage/images/majestic-blue.jpg'
        ]);

        Flower::create([
            'name' => 'Classic Midnight',
            'type_id' => 1,
            'price' => 435000,
            'description' => 'A classic icon of red roses, babys breath and fresh leaves, packed in black wrapping paper with a mesmerizing red ribbon.',
            'stock' => 30,
            'image' => 'storage/images/classic-midnight.jpg'
        ]);

        Flower::create([
            'name' => 'Morning Snuggle',
            'type_id' => 2,
            'price' => 695000,
            'description' => 'An elegant bouquet of soft pink lilies wrapped in subtle brown paper, decorated with chrysanthemums and alang-alang.',
            'stock' => 20,
            'image' => 'storage/images/morning-snuggle.jpg'
        ]);

        Flower::create([
            'name' => 'Simply Pink',
            'type_id' => 2,
            'price' => 695000,
            'description' => 'Simple, but special. 10 pink lilies that can spread a fresh aroma to lighten up the mood.',
            'stock' => 15,
            'image' => 'storage/images/simply-pink.jpg'
        ]);

        Flower::create([
            'name' => 'Pure Vanilla',
            'type_id' => 2,
            'price' => 445000,
            'description' => 'A delicate and eye-catching bouquet of white lilies, that signifies devotion, friendship and holiness.',
            'stock' => 25,
            'image' => 'storage/images/pure-vanilla.jpg'
        ]);

        Flower::create([
            'name' => 'Sunflower Burst',
            'type_id' => 3,
            'price' => 395000,
            'description' => '3 stalks of exquisite sunflowers wrapped in simple black and bronze paper that is guaranteed to brighten up your day.',
            'stock' => 35,
            'image' => 'storage/images/sunflower-burst.jpg'
        ]);

        Flower::create([
            'name' => 'Tropical Sunshine',
            'type_id' => 4,
            'price' => 450000,
            'description' => 'A beautiful flower bouquet of yellow and pink gerberas, complemented with some snapdragons, hydragenas and leaves.',
            'stock' => 20,
            'image' => 'storage/images/tropical-sunshine.jpg'
        ]);

        Flower::create([
            'name' => 'Gerbera Galore',
            'type_id' => 4,
            'price' => 450000,
            'description' => 'A symbol of happiness, this bouquet is a colourful blend of bright white, yellow and red gerberas.',
            'stock' => 15,
            'image' => 'storage/images/gerbera-galore.jpg'
        ]);

        Flower::create([
            'name' => 'Pink Blush',
            'type_id' => 4,
            'price' => 350000,
            'description' => 'Shades of pink and burst of red make ment to explore more.',
            'stock' => 25,
            'image' => 'storage/images/pink-blush.jpg'
        ]);

        Flower::create([
            'name' => 'Pastel Dream',
            'type_id' => 4,
            'price' => 400000,
            'description' => 'A pleasent combination of soft pink and purple gerberas, wrapped in brown kraft paper.',
            'stock' => 10,
            'image' => 'storage/images/pastel-dream.jpg'
        ]);

        Flower::create([
            'name' => 'Blushing Love',
            'type_id' => 5,
            'price' => 470000,
            'description' => 'A flower basket full of a hundred pink daisies showing love and care.',
            'stock' => 12,
            'image' => 'storage/images/blushing-love.jpg'
        ]);

        Flower::create([
            'name' => 'White Winter',
            'type_id' => 5,
            'price' => 470000,
            'description' => 'A flower basket full of a hundred white daisies showing purity and freedom.',
            'stock' => 8,
            'image' => 'storage/images/white-winter.jpg'
        ]);

        Flower::create([
            'name' => 'Spring in Holland',
            'type_id' => 6,
            'price' => 900000,
            'description' => 'An arrangment of 15 red tulips, imported directly form the Netherlands. Suitable to present to loved ones as a gift.',
            'stock' => 5,
            'image' => 'storage/images/spring-in-holland.jpg'
        ]);

        Flower::create([
            'name' => 'Sunset Paradise',
            'type_id' => 6,
            'price' => 760000,
            'description' => 'An extravagant hand bouquet of 10 two-toned orange yellow tulips, completed with eucalyptus and cordyline, wrapped in classic black wrapping paper.',
            'stock' => 15,
            'image' => 'storage/images/sunset-paradise.jpg'
        ]);

        Flower::create([
            'name' => 'Cotton Candy',
            'type_id' => 6,
            'price' => 650000,
            'description' => '10 pink tulips decorated in all pink, accompanied with some eucalyptus and cordyline.',
            'stock' => 20,
            'image' => 'storage/images/cotton-candy.jpg'
        ]);

        Flower::create([
            'name' => 'Royal Purple',
            'type_id' => 6,
            'price' => 700000,
            'description' => 'A simple all-purple flower bouquet composed of 10 beautiful purple tulips.',
            'stock' => 20,
            'image' => 'storage/images/royal-purple.jpg'
        ]);
    }
}
