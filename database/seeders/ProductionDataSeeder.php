<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProductionDataSeeder extends Seeder
{
    public function run(): void
    {
        // ── ROLES ─────────────────────────────────────────────────
        DB::table('roles')->insert([
            ['id' => 1, 'role' => 'Administrator', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'role' => 'Loyal Customer', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'role' => 'Customer',       'created_at' => now(), 'updated_at' => now()],
        ]);

        // ── CATEGORIES ────────────────────────────────────────────
        // Tutorial uses 6 categories — Hoodie and Jacket are ONE category (id=4)
        // compared to the old dataset which split them into two
        DB::table('categories')->insert([
            ['id' => 1, 'category' => 'T-Shirt',          'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'category' => 'Pants',             'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'category' => 'Cap',               'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'category' => 'Hoodie / Jacket',   'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'category' => 'Accessories',       'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'category' => 'Longsleeve',        'created_at' => now(), 'updated_at' => now()],
        ]);

        // ── STATUS ────────────────────────────────────────────────
        // Tutorial uses "Available" not "Published"
        DB::table('status')->insert([
            ['id' => 1, 'status' => 'Upcoming',  'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'status' => 'Available', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ── USERS ─────────────────────────────────────────────────
        // 1 Admin, 3 Loyal Customers, 6 Customers
        DB::table('users')->insert([
            ['id'=>1,  'first_name'=>'Admin',  'last_name'=>'Arca',    'email'=>'admin@arcastudio.com',   'password'=>Hash::make('arca@admin123'), 'role_id'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>2,  'first_name'=>'Marcus', 'last_name'=>'Lim',     'email'=>'marcus.lim@email.com',   'password'=>Hash::make('marcus123'),     'role_id'=>2, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>3,  'first_name'=>'Priya',  'last_name'=>'Nair',    'email'=>'priya.nair@email.com',   'password'=>Hash::make('priya123'),      'role_id'=>2, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>4,  'first_name'=>'Daniel', 'last_name'=>'Wong',    'email'=>'daniel.wong@email.com',  'password'=>Hash::make('daniel123'),     'role_id'=>2, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>5,  'first_name'=>'Sarah',  'last_name'=>'Chen',    'email'=>'sarah.chen@email.com',   'password'=>Hash::make('sarah123'),      'role_id'=>3, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>6,  'first_name'=>'Aiman',  'last_name'=>'Rosli',   'email'=>'aiman.rosli@email.com',  'password'=>Hash::make('aiman123'),      'role_id'=>3, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>7,  'first_name'=>'Nurul',  'last_name'=>'Hana',    'email'=>'nurulhana@email.com',    'password'=>Hash::make('nurul123'),      'role_id'=>3, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>8,  'first_name'=>'James',  'last_name'=>'Tan',     'email'=>'james.tan@email.com',    'password'=>Hash::make('james123'),      'role_id'=>3, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>9,  'first_name'=>'Farah',  'last_name'=>'Izzati',  'email'=>'farah.izzati@email.com', 'password'=>Hash::make('farah123'),      'role_id'=>3, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>10, 'first_name'=>'Kevin',  'last_name'=>'Raj',     'email'=>'kevin.raj@email.com',    'password'=>Hash::make('kevin123'),      'role_id'=>3, 'created_at'=>now(), 'updated_at'=>now()],
        ]);

        // ── PRODUCTS ──────────────────────────────────────────────
        // Prices converted from RM to IDR (approx x3500 rounded to realistic IDR)
        // status_id 2 = Available, status_id 1 = Upcoming
        // Category 4 = Hoodie / Jacket (combined — old dataset had separate Hoodie=4, Jacket=5)
        // Category 5 = Accessories, Category 6 = Longsleeve (replaces old Accessories=6)
        DB::table('products')->insert([

            // T-Shirts (category_id = 1)
            ['id'=>1,  'code'=>'ARC-TS-001', 'name'=>'Arca Core Tee - Washed Black',      'description'=>'Kaos basic premium dengan bahan cotton combed 30s. Warna washed black yang tidak mudah pudar.',                               'category_id'=>1, 'price'=>189000, 'quantity'=>0, 'status_id'=>2, 'image_path'=>'tshirt-core-black.jpg',       'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>2,  'code'=>'ARC-TS-002', 'name'=>'Arca Core Tee - Vintage White',     'description'=>'Versi Vintage White dari kaos andalan kami. Bahan cotton combed 30s yang adem dan nyaman sepanjang hari.',                    'category_id'=>1, 'price'=>189000, 'quantity'=>0, 'status_id'=>2, 'image_path'=>'tshirt-core-white.jpg',       'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>3,  'code'=>'ARC-TS-003', 'name'=>'Monolith Graphic Tee',              'description'=>'Kaos grafis dengan desain Monolith eksklusif. Print berkualitas tinggi yang tahan lama setelah dicuci berulang kali.',         'category_id'=>1, 'price'=>249000, 'quantity'=>0, 'status_id'=>2, 'image_path'=>'tshirt-monolith.jpg',          'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>4,  'code'=>'ARC-TS-004', 'name'=>'Horizon Oversized Tee',             'description'=>'Kaos oversized dengan potongan yang pas dan tidak berlebihan. Cocok dipadukan dengan celana apapun.',                         'category_id'=>1, 'price'=>279000, 'quantity'=>0, 'status_id'=>2, 'image_path'=>'tshirt-horizon.jpg',           'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>5,  'code'=>'ARC-TS-005', 'name'=>'Verso Long Sleeve',                 'description'=>'Kaos lengan panjang dengan bahan premium. Desain minimalis yang cocok untuk berbagai kesempatan. Segera hadir!',              'category_id'=>1, 'price'=>329000, 'quantity'=>0, 'status_id'=>1, 'image_path'=>'tshirt-verso-longsleeve.jpg',  'created_at'=>now(), 'updated_at'=>now()],

            // Pants (category_id = 2)
            ['id'=>6,  'code'=>'ARC-PT-001', 'name'=>'Arca Track Pants - Charcoal',       'description'=>'Track pants dengan bahan fleece berkualitas. Potongan relaxed fit yang tetap terlihat rapi saat dipakai keluar rumah.',        'category_id'=>2, 'price'=>349000, 'quantity'=>0, 'status_id'=>2, 'image_path'=>'pants-track-charcoal.jpg',     'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>7,  'code'=>'ARC-PT-002', 'name'=>'Wide Leg Cargo - Olive',             'description'=>'Celana cargo wide leg dengan banyak kantong fungsional. Warna olive yang versatile untuk berbagai outfit.',                  'category_id'=>2, 'price'=>429000, 'quantity'=>0, 'status_id'=>2, 'image_path'=>'pants-cargo-olive.jpg',         'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>8,  'code'=>'ARC-PT-003', 'name'=>'Slim Jogger - Black',                'description'=>'Jogger dengan potongan slim yang modern. Bahan stretch yang nyaman untuk aktivitas sehari-hari maupun olahraga ringan.',      'category_id'=>2, 'price'=>299000, 'quantity'=>0, 'status_id'=>2, 'image_path'=>'pants-jogger-black.jpg',        'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>9,  'code'=>'ARC-PT-004', 'name'=>'Utility Cargo - Stone',              'description'=>'Celana cargo utility dengan detail tali dan kantong samping. Warna stone yang elegan. Segera hadir di koleksi kami!',        'category_id'=>2, 'price'=>479000, 'quantity'=>0, 'status_id'=>1, 'image_path'=>'pants-cargo-stone.jpg',         'created_at'=>now(), 'updated_at'=>now()],

            // Caps (category_id = 3)
            ['id'=>10, 'code'=>'ARC-CP-001', 'name'=>'Arca Dad Cap - Black',               'description'=>'Dad cap dengan struktur yang sempurna. Bordir logo Arca Studio di bagian depan. Tersedia dalam warna hitam klasik.',         'category_id'=>3, 'price'=>149000, 'quantity'=>0, 'status_id'=>2, 'image_path'=>'cap-dad-black.jpg',             'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>11, 'code'=>'ARC-CP-002', 'name'=>'Arca Dad Cap - Cream',               'description'=>'Versi cream dari dad cap favorit kami. Cocok dipadukan dengan outfit berwarna apapun.',                                    'category_id'=>3, 'price'=>149000, 'quantity'=>0, 'status_id'=>2, 'image_path'=>'cap-dad-cream.jpg',             'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>12, 'code'=>'ARC-CP-003', 'name'=>'Structured Snapback - Navy',         'description'=>'Snapback dengan panel terstruktur dan closure snap di bagian belakang. Warna navy yang timeless.',                         'category_id'=>3, 'price'=>189000, 'quantity'=>0, 'status_id'=>2, 'image_path'=>'cap-snapback-navy.jpg',         'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>13, 'code'=>'ARC-CP-004', 'name'=>'Corduroy Cap - Forest',              'description'=>'Topi berbahan corduroy dengan warna forest green yang unik. Segera hadir di koleksi Arca Studio.',                         'category_id'=>3, 'price'=>219000, 'quantity'=>0, 'status_id'=>1, 'image_path'=>'cap-corduroy-forest.jpg',       'created_at'=>now(), 'updated_at'=>now()],

            // Hoodie / Jacket (category_id = 4) — combined category in tutorial
            ['id'=>14, 'code'=>'ARC-HD-001', 'name'=>'Arca Pullover Hoodie - Black',       'description'=>'Hoodie pullover dengan bahan fleece tebal. Pouch pocket depan dan drawstring yang bisa disesuaikan.',                      'category_id'=>4, 'price'=>489000, 'quantity'=>0, 'status_id'=>2, 'image_path'=>'hoodie-pullover-black.jpg',     'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>15, 'code'=>'ARC-HD-002', 'name'=>'Arca Pullover Hoodie - Grey',        'description'=>'Versi grey dari hoodie pullover andalan kami. Bahan premium yang tetap hangat tanpa terasa berat.',                        'category_id'=>4, 'price'=>489000, 'quantity'=>0, 'status_id'=>2, 'image_path'=>'hoodie-pullover-grey.jpg',       'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>16, 'code'=>'ARC-HD-003', 'name'=>'Zip-Up Hoodie - Cream',              'description'=>'Hoodie zip-up dengan warna cream yang elegan. Resleting YKK berkualitas tinggi dan kantong samping yang dalam.',           'category_id'=>4, 'price'=>549000, 'quantity'=>0, 'status_id'=>2, 'image_path'=>'hoodie-zipup-cream.jpg',         'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>17, 'code'=>'ARC-HD-004', 'name'=>'Heavyweight Hoodie - Midnight',      'description'=>'Hoodie heavyweight dengan bahan ekstra tebal untuk cuaca dingin. Warna midnight yang premium. Segera hadir!',              'category_id'=>4, 'price'=>649000, 'quantity'=>0, 'status_id'=>1, 'image_path'=>'hoodie-heavy-midnight.jpg',      'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>18, 'code'=>'ARC-JK-001', 'name'=>'Arca Coach Jacket - Black',          'description'=>'Jaket coach dengan bahan water-resistant. Desain clean dengan logo Arca Studio yang subtle di bagian dada.',               'category_id'=>4, 'price'=>649000, 'quantity'=>0, 'status_id'=>2, 'image_path'=>'jacket-coach-black.jpg',         'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>19, 'code'=>'ARC-JK-002', 'name'=>'Windbreaker - Slate Blue',           'description'=>'Windbreaker ringan dengan bahan anti angin. Warna slate blue yang modern dan cocok untuk outdoor maupun casual.',         'category_id'=>4, 'price'=>749000, 'quantity'=>0, 'status_id'=>2, 'image_path'=>'jacket-wind-slate.jpg',          'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>20, 'code'=>'ARC-JK-003', 'name'=>'Bomber Jacket - Olive',              'description'=>'Bomber jacket klasik dengan warna olive. Padding ringan yang memberikan kehangatan tanpa mengorbankan gaya. Segera hadir!', 'category_id'=>4, 'price'=>829000, 'quantity'=>0, 'status_id'=>1, 'image_path'=>'jacket-bomber-olive.jpg',        'created_at'=>now(), 'updated_at'=>now()],

            // Accessories (category_id = 5)
            ['id'=>21, 'code'=>'ARC-AC-001', 'name'=>'Arca Tote Bag - Black Canvas',       'description'=>'Tote bag berbahan canvas tebal. Kapasitas besar untuk keperluan sehari-hari. Tersedia dalam warna hitam klasik.',          'category_id'=>5, 'price'=>129000, 'quantity'=>0, 'status_id'=>2, 'image_path'=>'acc-tote-black.jpg',             'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>22, 'code'=>'ARC-AC-002', 'name'=>'Crew Socks 3-Pack - White',          'description'=>'Paket 3 pasang kaos kaki crew dengan bahan cotton yang nyaman. Putih bersih yang cocok dengan outfit apapun.',            'category_id'=>5, 'price'=>89000,  'quantity'=>0, 'status_id'=>2, 'image_path'=>'acc-socks-white.jpg',            'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>23, 'code'=>'ARC-AC-003', 'name'=>'Crew Socks 3-Pack - Black',          'description'=>'Paket 3 pasang kaos kaki crew warna hitam. Bahan cotton premium yang tahan lama dan tetap nyaman sepanjang hari.',        'category_id'=>5, 'price'=>89000,  'quantity'=>0, 'status_id'=>2, 'image_path'=>'acc-socks-black.jpg',            'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>24, 'code'=>'ARC-AC-004', 'name'=>'Woven Lanyard',                      'description'=>'Lanyard berbahan woven dengan logo Arca Studio. Cocok untuk ID card, kunci, atau aksesoris sehari-hari.',                  'category_id'=>5, 'price'=>59000,  'quantity'=>0, 'status_id'=>2, 'image_path'=>'acc-lanyard.jpg',                'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>25, 'code'=>'ARC-AC-005', 'name'=>'Crossbody Bag - Stone',              'description'=>'Tas crossbody dengan bahan canvas premium warna stone. Segera hadir di koleksi aksesori Arca Studio.',                    'category_id'=>5, 'price'=>279000, 'quantity'=>0, 'status_id'=>1, 'image_path'=>'acc-crossbody-stone.jpg',        'created_at'=>now(), 'updated_at'=>now()],
        ]);

        // ── PRODUCT VARIANTS ──────────────────────────────────────
        // Tutorial requires per-variant stock — tutorial Part 9
        // Accessories (socks, lanyard, tote) have no size — use "FREE SIZE"
        // Upcoming products get variants too so admin can manage stock when launched

        $variantData = [];

        // Products with size variants (T-Shirts, Pants, Hoodies, Jackets, Longsleeeves)
        $sizedProducts = [
            // [product_id, colors, sizes, stock_per_variant, price_adjustment_for_XL]
            [1,  [['Black','#1A1A1A']],                          ['S','M','L','XL','XXL'], 20, 10000],
            [2,  [['White','#F5F5F0']],                          ['S','M','L','XL','XXL'], 20, 10000],
            [3,  [['Black','#1A1A1A'],['Cream','#F5F0E8']],      ['S','M','L','XL'],       15, 10000],
            [4,  [['Black','#1A1A1A'],['Beige','#E8DCC8']],      ['S','M','L','XL','XXL'], 12, 10000],
            [5,  [['White','#F5F5F0'],['Black','#1A1A1A']],      ['S','M','L','XL'],       10, 10000],  // Upcoming
            [6,  [['Charcoal','#4A4A4A']],                       ['S','M','L','XL','XXL'], 16, 15000],
            [7,  [['Olive','#6B7C5C']],                          ['S','M','L','XL'],       12, 15000],
            [8,  [['Black','#1A1A1A']],                          ['S','M','L','XL','XXL'], 20, 15000],
            [9,  [['Stone','#C4B5A0']],                          ['S','M','L','XL'],       8,  15000],  // Upcoming
            [14, [['Black','#1A1A1A']],                          ['S','M','L','XL','XXL'], 12, 20000],
            [15, [['Grey','#9E9E9E']],                           ['S','M','L','XL','XXL'], 12, 20000],
            [16, [['Cream','#F5F0E8']],                          ['S','M','L','XL'],       8,  20000],
            [17, [['Midnight','#1A1A2E']],                       ['S','M','L','XL'],       6,  20000],  // Upcoming
            [18, [['Black','#1A1A1A']],                          ['S','M','L','XL'],       8,  20000],
            [19, [['Slate Blue','#6B8CAE']],                     ['S','M','L','XL'],       6,  20000],
            [20, [['Olive','#6B7C5C']],                          ['S','M','L','XL'],       4,  20000],  // Upcoming
        ];

        foreach ($sizedProducts as [$productId, $colors, $sizes, $stock, $xlAdjustment]) {
            foreach ($sizes as $size) {
                foreach ($colors as [$colorName, $colorHex]) {
                    $adj = in_array($size, ['XL', 'XXL']) ? $xlAdjustment : 0;
                    $variantData[] = [
                        'product_id'       => $productId,
                        'size'             => $size,
                        'color'            => $colorName,
                        'color_hex'        => $colorHex,
                        'stock'            => $stock,
                        'price_adjustment' => $adj,
                        'sku'              => 'ARC-' . str_pad($productId, 2, '0', STR_PAD_LEFT) . '-' . $size . '-' . strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $colorName), 0, 3)),
                        'created_at'       => now(),
                        'updated_at'       => now(),
                    ];
                }
            }
        }

        // Caps — ONE SIZE fits all
        $capProducts = [
            [10, [['Black','#1A1A1A']]],
            [11, [['Cream','#F5F0E8']]],
            [12, [['Navy','#1B2A4A']]],
            [13, [['Forest','#2D5A3D']]],  // Upcoming
        ];
        foreach ($capProducts as [$productId, $colors]) {
            foreach ($colors as [$colorName, $colorHex]) {
                $variantData[] = [
                    'product_id'       => $productId,
                    'size'             => 'FREE SIZE',
                    'color'            => $colorName,
                    'color_hex'        => $colorHex,
                    'stock'            => 50,
                    'price_adjustment' => 0,
                    'sku'              => 'ARC-' . str_pad($productId, 2, '0', STR_PAD_LEFT) . '-FS-' . strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $colorName), 0, 3)),
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ];
            }
        }

        // Accessories — FREE SIZE, single color
        $accProducts = [
            [21, 'Black', '#1A1A1A', 100],
            [22, 'White', '#F5F5F5', 150],
            [23, 'Black', '#1A1A1A', 150],
            [24, 'Multi', '#888888', 200],
            [25, 'Stone', '#C4B5A0', 30],   // Upcoming
        ];
        foreach ($accProducts as [$productId, $colorName, $colorHex, $stock]) {
            $variantData[] = [
                'product_id'       => $productId,
                'size'             => 'FREE SIZE',
                'color'            => $colorName,
                'color_hex'        => $colorHex,
                'stock'            => $stock,
                'price_adjustment' => 0,
                'sku'              => 'ARC-' . str_pad($productId, 2, '0', STR_PAD_LEFT) . '-FS-' . strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $colorName), 0, 3)),
                'created_at'       => now(),
                'updated_at'       => now(),
            ];
        }

        DB::table('product_variants')->insert($variantData);

        // ── REVIEWS ───────────────────────────────────────────────
        // Tutorial added rating (1-5) and product_id columns to reviews
        // Old dataset had no rating — all given 5 stars as they are positive reviews
        DB::table('reviews')->insert([
            [
                'user_id'    => 2,
                'product_id' => 1,
                'rating'     => 5,
                'review'     => 'Arca Studio has completely changed how I think about building a wardrobe. I have been wearing the Core Tee in Washed Black almost every week since I got it — the material holds up after every wash and still looks as sharp as day one. As a loyal customer, the 10% discount is a great touch. Feels like the brand actually values the people who keep coming back.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id'    => 3,
                'product_id' => 7,
                'rating'     => 5,
                'review'     => 'I picked up the Wide Leg Cargo in Olive and the Pullover Hoodie in Grey and I have not stopped wearing them together. The fit is genuinely great — relaxed but put together. Arca Studio manages to nail that balance between comfort and style that a lot of brands talk about but rarely deliver.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id'    => 4,
                'product_id' => 19,
                'rating'     => 5,
                'review'     => 'Honestly one of the best online clothing experiences I have had. The Windbreaker in Slate Blue is exactly what I was looking for — light enough for everyday wear but sharp enough to wear out. Sizing is consistent, shipping was fast, and the product quality matched the price point perfectly.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id'    => 5,
                'product_id' => 11,
                'rating'     => 5,
                'review'     => 'Bought the Arca Dad Cap in Cream as a gift and the person I gave it to immediately asked where I got it from. Clean design, good structure, comfortable fit. Arca Studio clearly pays attention to the small things and it shows.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id'    => 6,
                'product_id' => 8,
                'rating'     => 4,
                'review'     => 'Been following Arca Studio for a while and finally pulled the trigger on the Slim Jogger in Black. No regrets. The fabric feels premium and the fit is exactly right — not too tight, not too baggy. This is the kind of piece you wear without thinking twice.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id'    => 7,
                'product_id' => 3,
                'rating'     => 5,
                'review'     => 'The Monolith Graphic Tee caught my eye immediately and wearing it in person is even better than how it looks online. Great quality, solid print, and the oversized cut is very flattering. I am already eyeing the Horizon Oversized Tee for my next order.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id'    => 8,
                'product_id' => 21,
                'rating'     => 4,
                'review'     => 'Simple, clean, well-made. That is Arca Studio in three words. The Arca Tote Bag is one of my daily carry essentials now — sturdy canvas, good size, looks great with almost anything.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id'    => 10,
                'product_id' => 16,
                'rating'     => 5,
                'review'     => 'Arca Studio is the kind of brand I wish existed years ago. Affordable prices without the cheap feel. The Zip-Up Hoodie in Cream is genuinely one of the best hoodies I have owned. The weight is perfect — not too heavy, not flimsy. Would recommend this brand to anyone who takes their wardrobe seriously.',
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        // ── NEWS ──────────────────────────────────────────────────
        // Tutorial News model uses created_at, not a separate 'date' column
        // user_id added — admin (id=1) is the author of all news
        DB::table('news')->insert([
            [
                'title'       => 'Arca Studio — Official Launch',
                'description' => 'After months of preparation, Arca Studio officially opened its doors to the public. Our first collection — built around the idea of versatile, everyday essentials — sold out within the first 72 hours. Thank you to everyone who believed in this from the beginning. This is just the start.',
                'image_path'  => 'news-launch.jpg',
                'user_id'     => 1,
                'created_at'  => '2023-06-01 09:00:00',
                'updated_at'  => '2023-06-01 09:00:00',
            ],
            [
                'title'       => 'Pop-Up Market at The Square, KL',
                'description' => 'We took Arca Studio offline for the first time at The Square Pop-Up Market in Kuala Lumpur. Meeting our customers face to face, seeing people try on our pieces in person — it was a moment we will not forget. We sold over 200 units in a single day and came home with a long list of ideas for what comes next.',
                'image_path'  => 'news-popup.jpg',
                'user_id'     => 1,
                'created_at'  => '2023-09-15 10:00:00',
                'updated_at'  => '2023-09-15 10:00:00',
            ],
            [
                'title'       => 'Introducing the Loyal Customer Program',
                'description' => 'Starting this month, our most dedicated customers get more. The Arca Loyal Customer Program gives members early access to new drops, exclusive 10% discounts on all products, and behind-the-scenes previews of upcoming collections. If you have been with us since the beginning — this one is for you.',
                'image_path'  => 'news-loyal.jpg',
                'user_id'     => 1,
                'created_at'  => '2023-11-10 08:00:00',
                'updated_at'  => '2023-11-10 08:00:00',
            ],
            [
                'title'       => 'Arca x Venue — Collaboration Drop',
                'description' => 'We partnered with creative studio Venue for a limited capsule collection — 4 pieces, 200 units each, gone in under 48 hours. The collaboration blended Arca\'s clean silhouettes with Venue\'s graphic identity and the result was something neither brand could have made alone. More collaborations are in the pipeline — stay tuned.',
                'image_path'  => 'news-collab.jpg',
                'user_id'     => 1,
                'created_at'  => '2024-02-20 09:00:00',
                'updated_at'  => '2024-02-20 09:00:00',
            ],
            [
                'title'       => 'Arca Studio — End of Year Recap',
                'description' => 'What a year. From our first pop-up to our first collaboration, from 3 product categories to 6, from a small customer base to a community we are genuinely proud of. In 2024 we shipped over 5,000 orders, launched the Loyal Customer Program, and expanded our catalogue to cover everything from essentials to outerwear. 2025 is going to be bigger. Thank you for wearing your story with us.',
                'image_path'  => 'news-recap.jpg',
                'user_id'     => 1,
                'created_at'  => '2024-12-31 12:00:00',
                'updated_at'  => '2024-12-31 12:00:00',
            ],
        ]);

        // ── MESSAGES ──────────────────────────────────────────────
        // Tutorial Message model now has user_id and subject columns
        // All messages sent by admin (user_id = 1)
        DB::table('messages')->insert([
            ['id'=>1, 'user_id'=>1, 'subject'=>'Early Access — Autumn Collection Now Live',          'message'=>'New drop alert! Our Autumn collection is now live exclusively for Loyal Members. You get 48 hours of early access before it goes public. Head to the website and use your member discount — items are limited.',                                                                    'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>2, 'user_id'=>1, 'subject'=>'First Look — Upcoming Collaboration Drop',           'message'=>'Thank you for being part of the Arca family. As a loyal member, you are getting first look at our upcoming collaboration drop before anyone else. Details coming this Friday. Stay close.',                                                                                        'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>3, 'user_id'=>1, 'subject'=>'Flash Sale — 15% Off Accessories This Weekend',      'message'=>'Flash sale this weekend — 15% off everything in the Accessories category for Loyal Members only. Valid from Saturday 10AM to Sunday midnight. No code needed, discount applies automatically at checkout.',                                                                        'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>4, 'user_id'=>1, 'subject'=>'You Are Invited — Private Members Preview Event',    'message'=>'We are hosting a private members-only preview event next month. You are invited. It is a chance to see the new collection in person, meet the team, and get first pick before the public launch. More details will follow — mark your calendar.',                                   'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>5, 'user_id'=>1, 'subject'=>'Complimentary Gift With Every Order Above Rp 500K', 'message'=>'Your loyalty means everything to us. This month we are giving all Loyal Members a complimentary gift with every order above Rp 500.000. Just place your order as usual — we will add it in. No action needed on your end.',                                                       'created_at'=>now(), 'updated_at'=>now()],
        ]);

        // ── SHARED MESSAGES ───────────────────────────────────────
        // Send all 5 messages to all 3 loyal customers (user_id 2, 3, 4)
        $sharedData = [];
        foreach ([1, 2, 3, 4, 5] as $msgId) {
            foreach ([2, 3, 4] as $userId) {
                $sharedData[] = [
                    'message_id' => $msgId,
                    'user_id'    => $userId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        DB::table('shared_messages')->insert($sharedData);
    }
}