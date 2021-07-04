<?php

namespace App\Library\Helpers;

class Seeders {    

    static function  categoriesSeeds() {
        return 
        [
            [
                'name' => 'Pizza',
                'description' => 'La migliore pizza consegnata rapidamente alla tua porta',
                'img_cover' => 'pizza.jpeg'
            ],
            [
                'name' => 'Sushi',
                'description' => 'Il Miglior Sushi consegnato direttamente a casa tua',
                'img_cover' => 'barca-sushi.jpg'
            ],
            [
                'name' => 'Dessert',
                'description' => 'Togliti uno sfizio e gustati un ottimo dessert comodamente sul tuo divano',
                'img_cover' => 'dunkindonuts.jpg'
            ],
            [
                'name' => 'Poke',
                'description' => 'Il miglior poke consegnato direttamente a casa tua',
                'img_cover' => 'poke.jpg'
            ],
            [
                'name' => 'Healthy',
                'description' => 'Non solo gustosi ma anche salutari!',
                'img_cover' => 'healthy.jpeg'
            ],
            [
                'name' => 'Hamburger',
                'description' => 'Il milgior hamburger consegnato direttamente a casa tua',
                'img_cover' => 'hamburger-patate.jpg'
            ],
            [
                'name' => 'Kebab',
                'description' => 'Il miglior kebab consegnato direttamente a casa tua',
                'img_cover' => 'kebab.jpeg'
            ],
            [
                'name' => 'Italiano',
                'description' => 'Squisita e variegata! Il meglio della cucina italiana direttamente a casa tua',
                'img_cover' => 'italiano.jpeg'
            ],
        ];
    }

    static function  usersSeeds() {
        return [
            [
                'company_name' => 'Gambino e Figli', 
                'email' => 'gambino@mail.com',
                'password' => bcrypt('password'),
                'address' => 'via da qua, 1',
                'vat_number' => '99999999999',
            ],
            [
                'company_name' => 'Dongu Associati', 
                'email' => 'dongu@mail.com',
                'password' => bcrypt('password'),
                'address' => 'via dalla Sardegna, 23',
                'vat_number' => '11111111111',
            ],
            [
                'company_name' => 'Orazio Re Srl', 
                'email' => 'oraziore@mail.com',
                'password' => bcrypt('password'),
                'address' => 'via dalla Sicilia, 90',
                'vat_number' => '22222222222',
            ],
            [
                'company_name' => 'Grande Catena', 
                'email' => 'grandecatena@mail.com',
                'password' => bcrypt('password'),
                'address' => 'via Barbarigo, 43',
                'vat_number' => '33333333333',
            ],
            [
                'company_name' => 'Piccola catena', 
                'email' => 'piccolacatena@mail.com',
                'password' => bcrypt('password'),
                'address' => 'Piazza Mazzini 52',
                'vat_number' => '44444444444',
            ],
        ];
    }

    // static function  restaurantsSeeds() {
    //     return [
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],
    //         [
    //             'name' => ,
    //             'address' => ,
    //             'email' => ,
    //             'telephone' => ,
    //             'description' => ,
    //             'img_cover' => ,
    //             'logo' => ,
    //             'allow_cash' => ,
    //             'delivery_cost' => ,
    //         ],            
    //     ];
    // }

    static function dishesSeeds() {
        return [
            [
                'name' => 'Margherita',
                'ingredients' => 'Pomodoro, Mozzarella',
                'price' => 5.00,
                'type' => 'Pizze',
                'is_visible' => true,
            ],
            [
                'name' => 'Marinara',
                'ingredients' => 'Pomodoro, aglio',
                'price' => 4.00,
                'type' => 'Pizze',
                'is_visible' => true,
            ],
            [
                'name' => 'Prosciutto e Funghi',
                'ingredients' => 'Pomodoro, mozzarella, prosciutto cotto, funghi',
                'price' => 6.50,
                'type' => 'Pizze',
                'is_visible' => true,
            ],
            [
                'name' => 'Tonno e cipolle',
                'ingredients' => 'Pomodoro, mozzarella, tonno, cipolla',
                'price' => 6.50,
                'type' => 'Pizze',
                'is_visible' => true,
            ],
            [
                'name' => 'Bufala',
                'ingredients' => 'Pomodoro, mozzarella di bufala, pomodorini, basilico',
                'price' => 8.00,
                'type' => 'Pizze',
                'is_visible' => true,
            ],
            [
                'name' => 'Crudo',
                'ingredients' => 'Pomodoro, Mozzarella, prosciutto crudo',
                'price' => 7.00,
                'type' => 'Pizze',
                'is_visible' => true,
            ],
            [
                'name' => 'Cotto',
                'ingredients' => 'Pomodoro, mozzarella, prosciutto cotto',
                'price' => 6.50,
                'type' => 'Pizze',
                'is_visible' => true,
            ],
            [
                'name' => 'Salsiccia e patate',
                'ingredients' => 'Pomodoro, mozzarella, salsiccia, patate',
                'price' => 7.50,
                'type' => 'Pizze',
                'is_visible' => true,
            ],
            [
                'name' => 'Light',
                'ingredients' => 'Pomodoro, mozzarella, philadelphia, zucchine',
                'price' => 6.50,
                'type' => 'Pizze',
                'is_visible' => true,
            ],
            [
                'name' => 'Diavola',
                'ingredients' => 'Pomodoro, mozzarella, salamino piccante',
                'price' => 8.00,
                'type' => 'Pizze',
                'is_visible' => true,
            ],
            [
                'name' => 'Barca',
                'ingredients' => '8 nigiri, 4 usomaki, 8 sashimi',
                'price' => 15.00,
                'type' => 'Sushi',
                'is_visible' => true,
            ],
            [
                'name' => 'Barca Grande',
                'ingredients' => '16 nigiri, 8 usomaki, 16 sashimi',
                'price' => 25.00,
                'type' => 'Sushi',
                'is_visible' => true,
            ],
            [
                'name' => 'Uramaki',
                'ingredients' => '8 uramaki con salmone, avocado e philadelphia',
                'price' => 8.00,
                'type' => 'Sushi',
                'is_visible' => true,
            ],
            [
                'name' => 'Nigiri',
                'ingredients' => '8 nigiri al tonno',
                'price' => 8.00,
                'type' => 'Sushi',
                'is_visible' => true,
            ],
            [
                'name' => 'Barca Senza Senso',
                'ingredients' => '70 pezzi di sushi scelti dallo chef',
                'price' => 50.00,
                'type' => 'Sushi',
                'is_visible' => true,
            ],
            [
                'name' => 'Veggy rolls',
                'ingredients' => '4 rolls pezzi carota, zucchina, avocado ',
                'price' => 6.00,
                'type' => 'Sushi',
                'is_visible' => true,
            ],
            [
                'name' => 'Salmon Fry',
                'ingredients' => '4 rolls salmone fritto, avocado e salsa teriyaki',
                'price' => 6.00,
                'type' => 'Sushi',
                'is_visible' => true,
            ],
            [
                'name' => 'Gunkan tonno',
                'ingredients' => 'Tonno',
                'price' => 6.00,
                'type' => 'Sushi',
                'is_visible' => true,
            ],
            [
                'name' => 'Tartare di salmone',
                'ingredients' => 'Salmone',
                'price' => 12.00,
                'type' => 'Sushi',
                'is_visible' => true,
            ],
            [
                'name' => 'Tartare di tonno',
                'ingredients' => 'Tonno',
                'price' => 12.00,
                'type' => 'Sushi',
                'is_visible' => true,
            ],
            [
                'name' => 'Kebab normale',
                'ingredients' => 'Pane, Kebab di pollo, verdure miste, salse',
                'price' => 4.00,
                'type' => 'Panini',
                'is_visible' => true,
            ],
            [
                'name' => 'Kebab piccante',
                'ingredients' => 'Pane, Kebab di pollo, verdure miste, salsa piccante',
                'price' => 4.50,
                'type' => 'Panini',
                'is_visible' => true,
            ],
            [
                'name' => 'Kebab bambini',
                'ingredients' => 'Pane, kebab di pollo, patatine fritte, ketchup',
                'price' => 3.50,
                'type' => 'Panini',
                'is_visible' => true,
            ],
            [
                'name' => 'Falafel bambini',
                'ingredients' => 'Pane, Falafel, patatine fritte, ketchup',
                'price' => 3.50,
                'type' => 'Panini',
                'is_visible' => true,
            ],
            [
                'name' => 'Piatto kebab',
                'ingredients' => 'Pane, kebab di pollo, verdure miste',
                'price' => 6.00,
                'type' => 'Secondi',
                'is_visible' => true,
            ],
            [
                'name' => 'Panino falafel',
                'ingredients' => 'Pane, Falafel, verdure miste, salse',
                'price' => 4.00,
                'type' => 'Panini',
                'is_visible' => true,
            ],
            [
                'name' => 'Piadina Kebab',
                'ingredients' => 'Piadina, Kebab di pollo, verdure miste',
                'price' => 4.50,
                'type' => 'Panini',
                'is_visible' => true,
            ],
            [
                'name' => 'Piadina falafel',
                'ingredients' => 'Piadina, Falafel, verdure miste, salse',
                'price' => 4.00,
                'type' => 'Panini',
                'is_visible' => true,
            ],
            [
                'name' => 'Piatto Falafel',
                'ingredients' => 'Pane, falafel, verdure miste, falafel',
                'price' => 6.00,
                'type' => 'Secondi',
                'is_visible' => true,
            ],
            [
                'name' => 'Tiramisù',
                'ingredients' => '',
                'price' => 4.00,
                'type' => 'Dolce',
                'is_visible' => true,
            ],
            [
                'name' => 'Panna Cotta',
                'ingredients' => '',
                'price' => 4.00,
                'type' => 'Dolce',
                'is_visible' => true,
            ],
            [
                'name' => 'Profiterol',
                'ingredients' => '',
                'price' => 4.00,
                'type' => 'Dolce',
                'is_visible' => true,
            ],
            [
                'name' => 'Gelato',
                'ingredients' => '',
                'price' => 4.00,
                'type' => 'Dolce',
                'is_visible' => true,
            ],
            [
                'name' => 'Coppa del nonno',
                'ingredients' => '',
                'price' => 4.00,
                'type' => 'Dolce',
                'is_visible' => true,
            ],
            [
                'name' => 'Salmon Lover',
                'ingredients' => 'Riso Integrale, Salmone delicatamente marinato nella soya e sesamo, avocado, edamame, ananas e anacardi.',
                'price' => 9.00,
                'type' => 'Poke',
                'is_visible' => true,
            ],
            [
                'name' => 'Vegan Delight',
                'ingredients' => 'Riso Venere Condito, Tofu, Edamame, Mango, Carote Julienne, Alga Hyashi Wakame, Ravanello, Mandorle. Topping vegan Teriyaki.',
                'price' => 8.00,
                'type' => 'Poke',
                'is_visible' => true,
            ],
            [
                'name' => 'Don Chicken',
                'ingredients' => 'Riso Bianco, Tenerissimi bocconcini di pollo cotti in salsa Teriyaki.',
                'price' => 8.50,
                'type' => 'Poke',
                'is_visible' => true,
            ],
            [
                'name' => 'King Shrimp',
                'ingredients' => 'Riso integrale, Gamberi saltati, Verdure saltate wok con sale e pepe, edamame, avocado a cubetti, fette sottili jalapeño, topping salsa teryake.',
                'price' => 9.00,
                'type' => 'Poke',
                'is_visible' => true,
            ],
            [
                'name' => 'Punaway Poke',
                'ingredients' => 'Riso bianco, salmone, ricciola, mango, asparago crudo marinato in olio sale e limone, avocado, mandorle, salsa yuzu mayo.',
                'price' => 7.50,
                'type' => 'Poke',
                'is_visible' => true,
            ],
            [
                'name' => 'Crunchy Shrimp',
                'ingredients' => 'Insalata Mista, Gambero argentino impanato nel Panko, peperoncino dolce e scaglie di mandorle. Accompagnato da salsa Avocado Mayo.',
                'price' => 8.50,
                'type' => 'Poke',
                'is_visible' => true,
            ],
            [
                'name' => 'Lady Salmon',
                'ingredients' => 'Riso bianco, gustosissimo filetto di salmone cotto in salsa teriyaki e semi di sesamo.',
                'price' => 8.50,
                'type' => 'Poke',
                'is_visible' => true,
            ],
            [
                'name' => 'Insalata Mista',
                'ingredients' => 'Insalate miste, pomodori e carote, condita con salsa ricca (olio, aceto, sale, cipolla, acciughe, miele e aglio)',
                'price' => 7.00,
                'type' => 'Insalate',
                'is_visible' => true,
            ],
            [
                'name' => 'Insalata Ricca',
                'ingredients' => 'Insalate miste, pomodori, funghi, carote, mais e formaggio, condita con salsa ricca (olio, aceto, sale, cipolla, acciughe, miele e aglio)',
                'price' => 8.50,
                'type' => 'Insalate',
                'is_visible' => true,
            ],
            [
                'name' => 'Insalata Pantesca',
                'ingredients' => 'Rughetta, patate lesse, pomodori pachino, cipolla rossa, capperi, olive nere, origano e aceto balsamico, condita con salsa ricca (olio, aceto, sale, cipolla, acciughe, miele e aglio)',
                'price' => 8.50,
                'type' => 'Insalate',
                'is_visible' => true,
            ],
            [
                'name' => 'Insalata Greca',
                'ingredients' => 'Insalate miste, pomodori, feta, cetrioli, olive nere, cipolle rosse e origano, condita con salsa ricca (olio, aceto, sale, cipolla, acciughe, miele e aglio)',
                'price' => 9.50,
                'type' => 'Insalate',
                'is_visible' => true,
            ],
            [
                'name' => 'Insalata Palmito',
                'ingredients' => 'Insalate miste, funghi, rughetta, feta e palmito, condita con salsa ricca (olio, aceto, sale, cipolla, acciughe, miele e aglio)',
                'price' => 9.00,
                'type' => 'Insalate',
                'is_visible' => true,
            ],
            [
                'name' => 'Caprese',
                'ingredients' => 'Pomodoro, mozzarella e basilico, condita con salsa ricca (olio, aceto, sale, cipolla, acciughe, miele e aglio)',
                'price' => 8.00,
                'type' => 'Insalate',
                'is_visible' => true,
            ],
            [
                'name' => 'Spaghetti allo scoglio',
                'ingredients' => 'Spaghetti, vongole, cozze, gamberi, calamari',
                'price' => 12.00,    
                'type' => 'Primi',
                'is_visible' => true,
            ],
            [
                'name' => 'Orecchiette ai broccoletti',
                'ingredients' => 'Orecchiette, broccoletti',
                'price' => 10.00,
                'type' => 'Primi',
                'is_visible' => true,
            ],
            [
                'name' => 'Tonnaretti cacio e pepe',
                'ingredients' => 'Tonnaretti, cacio, pepe',
                'price' => 10.00,
                'type' => 'Primi',
                'is_visible' => true,
            ],
            [
                'name' => 'Spaghetti integrali alle verdure',
                'ingredients' => 'Spaghetti integrali, zucchine, pomodori, melanzane, broccoletti',
                'price' => 10.00,
                'type' => 'Primi',
                'is_visible' => true,
            ],
            [
                'name' => 'Spaghetti alle vongole veraci',
                'ingredients' => 'Spaghetti, vongole',
                'price' => 12.00,
                'type' => 'Primi',
                'is_visible' => true,
            ],
            [
                'name' => 'Spaghetti con polpettine',
                'ingredients' => '',
                'price' => 12.00,
                'type' => 'Primi',
                'is_visible' => true,
            ],
            [
                'name' => 'Tortellini al pomodoro',
                'ingredients' => '',
                'price' => 8.00,
                'type' => 'Primi',
                'is_visible' => true,
            ],
            [
                'name' => 'Bistecca di Manzo con verdura al vapore',
                'ingredients' => '',
                'price' => 15.00,
                'type' => 'Secondi',
                'is_visible' => true,
            ],
            [
                'name' => 'Straccetti con rughetta',
                'ingredients' => '',
                'price' => 11.00,
                'type' => 'Secondi',
                'is_visible' => true,
            ],
            [
                'name' => 'Scamorza alla griglia',
                'ingredients' => '',
                'price' => 10.00,
                'type' => 'Secondi',
                'is_visible' => true,
            ],
        ];
    }
}