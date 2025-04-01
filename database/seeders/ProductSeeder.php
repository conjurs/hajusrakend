<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Mario',
                'description' => 'The main hero of the Mushroom Kingdom, known for his bravery and jumping abilities',
                'price' => 49.99,
                'image' => 'https://imgs.search.brave.com/Cl-fXkBFr1z9qAUrxFCAkZG-DzqmIYvQPS4NjSy--74/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5nZXR0eWltYWdl/cy5jb20vaWQvNDU4/Mjk0NzI1L3Bob3Rv/L3N1cGVyLW1hcmlv/LmpwZz9zPTYxMng2/MTImdz0wJms9MjAm/Yz00cWxoRks3QUNT/bGJ1SVNTZmJXakFl/MlZQMXFxSkRoWnlD/VkpPTlBQeDcwPQ'
            ],
            [
                'name' => 'Luigi',
                'description' => 'Mario\'s taller brother with unique ghost-hunting abilities',
                'price' => 129.99,
                'image' => 'https://imgs.search.brave.com/p87NMElrmtGvHQOmKFwoWk82hJv9T7soRVUqR93XmmI/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pLnBp/bmltZy5jb20vb3Jp/Z2luYWxzLzRhLzIy/LzlkLzRhMjI5ZDAx/YTc1OGM0Yzc0MGNi/MjQ0ZDY1OWFjZGUz/LmpwZw'
            ],
            [
                'name' => 'Princess Peach',
                'description' => 'The ruler of the Mushroom Kingdom with magical abilities',
                'price' => 79.99,
                'image' => 'https://imgs.search.brave.com/jHGjByZHe4CTg0gHMUiDCnD0x5G86mKRVoU0HbTzfiY/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hc3Nl/dHMubmludGVuZG8u/ZXUvaW1hZ2UvdXBs/b2FkL2Nfc2NhbGUs/Zl9hdXRvLHFfYXV0/by9OQUwvTWlncmF0/aW9uL1ByaW5jZXNz/UGVhY2hTaG93dGlt/ZS9QcmluY2Vzc1Bl/YWNoU2hvd3RpbWVf/U3BhcmtsZV9hcnR3/b3JrX3BlYWNoLnBu/Zw'
            ],
            [
                'name' => 'Bowser',
                'description' => 'The mighty King of the Koopas with fire-breathing powers',
                'price' => 299.99,
                'image' => 'https://imgs.search.brave.com/QVLtVb2uI2OGAgD5iOKZcrAW_gsKObiH2zdv2uxgkm0/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tLm1l/ZGlhLWFtYXpvbi5j/b20vaW1hZ2VzL0kv/NDE5b21OZmQwYUwu/anBn'
            ],
            [
                'name' => 'Yoshi',
                'description' => 'A friendly dinosaur with egg-laying and flutter-jump abilities',
                'price' => 199.99,
                'image' => 'https://imgs.search.brave.com/_t9kbn8i2VKm9uQgB6ra-Gs_Ygw_AF8k2dKM62KPfM0/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pLnBp/bmltZy5jb20vb3Jp/Z2luYWxzL2NkLzM3/L2U3L2NkMzdlN2M0/NWM5NGI1Y2Q2Y2U2/NDc4ZWEzZmVhZTY3/LmpwZw'
            ],
            [
                'name' => 'Toad',
                'description' => 'A loyal servant of Princess Peach with mushroom expertise',
                'price' => 29.99,
                'image' => 'https://imgs.search.brave.com/-0CE3RBYK-jFcF_dAzKuud8yMpkIdxxFgkjxp9k_cG8/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly91cGxv/YWQud2lraW1lZGlh/Lm9yZy93aWtpcGVk/aWEvZW4vYi9iOS9U/b2FkX2J5X1NoaWdl/aGlzYV9OYWthdWUu/cG5n'
            ],
            [
                'name' => 'Wario',
                'description' => 'Mario\'s greedy rival with super strength and garlic powers',
                'price' => 89.99,
                'image' => 'https://imgs.search.brave.com/ObyXo13SEjuGeirAAyJDH766PctiI6sgVrDxmybZzgU/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9wbGF0/Zm9ybS5wb2x5Z29u/LmNvbS93cC1jb250/ZW50L3VwbG9hZHMv/c2l0ZXMvMi9jaG9y/dXMvdXBsb2Fkcy9j/aG9ydXNfYXNzZXQv/ZmlsZS8yNDQ5MjE2/MC93YXJpb2hlcm8u/anBnP3F1YWxpdHk9/OTAmc3RyaXA9YWxs/JmNyb3A9MCwwLDEw/MCwxMDAmdz0yNDAw'
            ],
            [
                'name' => 'Kirby',
                'description' => 'Fatass jigglypuff',
                'price' => 69.99,
                'image' => 'https://imgs.search.brave.com/e4ypHZfbgXt9KOvFoEbyf6Z1XOY1RuvPcrxWEIMc7vY/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9wcmV2/aWV3LnJlZGQuaXQv/bnpkeHZwOTY1cW03/MS5qcGc_d2lkdGg9/NjQwJmNyb3A9c21h/cnQmYXV0bz13ZWJw/JnM9YjExYmRjNTMz/OWI4ODM0MTYyNjJl/ODllNWE2NTMyODcx/ZjJhNzIxMA'
            ],
            [
                'name' => 'Gen',
                'description' => 'minu isand gen',
                'price' => 999.99,
                'image' => 'https://uploads-ssl.webflow.com/5c117af33d8f9640f205b955/5cbe3697e51691c2e87d73cf_23669015_10204109440053892_3640254673239759187_o.jpg'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
} 