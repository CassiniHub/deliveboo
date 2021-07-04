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
                'name' => 'Gelato',
                'description' => 'Il miglior gelato consegnato direttamente a casa tua',
                'img_cover' => 'grom.png'
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
                'name' => 'Sandwich',
                'description' => 'Per un pasto al volo! Il miglior Sanwich per te',
                'img_cover' => 'sandwich.jpeg'
            ],
            [
                'name' => 'Americano',
                'description' => 'Il meglio del cibo di strada americano! Ordinalo comodamente da casa',
                'img_cover' => 'roadhouse.jpg'
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

    static function  restaurantsSeeds() {
        return [
            [
                'name' => 'American Grillhouse',
                'address' => 'via Amerigo Vespucci 15',
                'email' => 'grillhouse@mail.com',
                'telephone' => '3481619223',
                'description' => 'Una fantastica grillhouse in cui gustare la carne dei tuoi sogni in pieno stile americano!',
                'img_cover' => 'americano01.jpeg',
                'logo' => 'grillhouse.jpg',
                'allow_cash' => '1',
                'delivery_cost' => '5.00',
            ],
            [
                'name' => 'Retro City',
                'address' => 'via degli ulivi 31',
                'email' => 'retrocity@mail.com',
                'telephone' => '32014542782',
                'description' => 'Vivi la tua esperienza americana con i nostri hot dog a stelle e strisce.',
                'img_cover' => 'americano02.jpeg',
                'logo' => 'retro-city.jpg',
                'allow_cash' => 1,
                'delivery_cost' => 2.00,
            ],
            [
                'name' => 'Tasty Gelato',
                'address' => 'via Arcimboldi 74',
                'email' => 'tastygelato@mail.com',
                'telephone' => '3713241672',
                'description' => 'Gelati artigianali dal sapore inconfondibile, provali subito!',
                'img_cover' => 'gelato01.jpeg',
                'logo' => 'tasty-gelato.jpg',
                'allow_cash' => 0,
                'delivery_cost' => 4.00,
            ],
            [
                'name' => 'Nuova gelateria del corso',
                'address' => 'corso Megallano 154',
                'email' => 'gelateriadelcorso@mail.com',
                'telephone' => '095476125',
                'description' => 'Una ricetta inedita per un gelato tutto da scoprire',
                'img_cover' => 'gelato02.jpeg',
                'logo' => 'gelateria-del-corso.jpg',
                'allow_cash' => 1,
                'delivery_cost' => 5.00,
            ],
            [
                'name' => 'Anne Marie Patisserie',
                'address' => 'via Renato Agostini 41',
                'email' => 'annamariepatisserie@mail.com',
                'telephone' => '3661984362',
                'description' => 'I migliori dolci gourmet per i palati più esigenti.',
                'img_cover' => 'dessert01.jpeg',
                'logo' => 'anne-marie.jpeg',
                'allow_cash' => 0,
                'delivery_cost' => 7.00,
            ],
            [
                'name' => 'Vanilla\'s',
                'address' => 'via tedeschi 90',
                'email' => 'vanillas@mail.com',
                'telephone' => 3457154266,
                'description' => 'La miglior esperienza dolce che ci sia!',
                'img_cover' => 'dessert02.jpeg',
                'logo' => 'vanillas.jpg',
                'allow_cash' => 0,
                'delivery_cost' => 6.00,
            ],
            [
                'name' => 'Maximus Healthy Food',
                'address' => 'via Stramondo 54',
                'email' => 'maximushealthyfood@mail.com',
                'telephone' => '3713848688',
                'description' => 'Resta in linea con la migliore cucina francese!',
                'img_cover' => 'healthy01.jpeg',
                'logo' => 'maximus.jpg',
                'allow_cash' => 1,
                'delivery_cost' => 10.00,
            ],
            [
                'name' => 'I Monaci',
                'address' => 'via Mirabella 91',
                'email' => 'imonaci@mail.com',
                'telephone' => '3667134567',
                'description' => 'Prova i nostri nuovi piatti gourmet con ingredienti a kilometro 0.',
                'img_cover' => 'healthy02.jpg',
                'logo' => 'monaci.jpg',
                'allow_cash' => 1,
                'delivery_cost' => 5.00,
            ],
            [
                'name' => 'Vecchie Storie',
                'address' => 'via dei caduti 127',
                'email' => 'vecchiestorie@mail.com',
                'telephone' => '3668990024',
                'description' => 'Una cucina italiana ricca di sapori e storie da scoprire.',
                'img_cover' => 'italiano02.jpg',
                'logo' => 'vecchie-storie.jpg',
                'allow_cash' => 1,
                'delivery_cost' => 5.00,
            ],
            [
                'name' => 'Ristorante San Marco',
                'address' => ,
                'email' => ,
                'telephone' => ,
                'description' => ,
                'img_cover' => ,
                'logo' => ,
                'allow_cash' => ,
                'delivery_cost' => ,
            ],
            [
                'name' => ,
                'address' => ,
                'email' => ,
                'telephone' => ,
                'description' => ,
                'img_cover' => ,
                'logo' => ,
                'allow_cash' => ,
                'delivery_cost' => ,
            ],
            [
                'name' => ,
                'address' => ,
                'email' => ,
                'telephone' => ,
                'description' => ,
                'img_cover' => ,
                'logo' => ,
                'allow_cash' => ,
                'delivery_cost' => ,
            ],
            [
                'name' => ,
                'address' => ,
                'email' => ,
                'telephone' => ,
                'description' => ,
                'img_cover' => ,
                'logo' => ,
                'allow_cash' => ,
                'delivery_cost' => ,
            ],
            [
                'name' => ,
                'address' => ,
                'email' => ,
                'telephone' => ,
                'description' => ,
                'img_cover' => ,
                'logo' => ,
                'allow_cash' => ,
                'delivery_cost' => ,
            ],
            [
                'name' => ,
                'address' => ,
                'email' => ,
                'telephone' => ,
                'description' => ,
                'img_cover' => ,
                'logo' => ,
                'allow_cash' => ,
                'delivery_cost' => ,
            ],
            [
                'name' => ,
                'address' => ,
                'email' => ,
                'telephone' => ,
                'description' => ,
                'img_cover' => ,
                'logo' => ,
                'allow_cash' => ,
                'delivery_cost' => ,
            ],
            [
                'name' => ,
                'address' => ,
                'email' => ,
                'telephone' => ,
                'description' => ,
                'img_cover' => ,
                'logo' => ,
                'allow_cash' => ,
                'delivery_cost' => ,
            ],
            [
                'name' => ,
                'address' => ,
                'email' => ,
                'telephone' => ,
                'description' => ,
                'img_cover' => ,
                'logo' => ,
                'allow_cash' => ,
                'delivery_cost' => ,
            ],
            [
                'name' => ,
                'address' => ,
                'email' => ,
                'telephone' => ,
                'description' => ,
                'img_cover' => ,
                'logo' => ,
                'allow_cash' => ,
                'delivery_cost' => ,
            ],
            [
                'name' => ,
                'address' => ,
                'email' => ,
                'telephone' => ,
                'description' => ,
                'img_cover' => ,
                'logo' => ,
                'allow_cash' => ,
                'delivery_cost' => ,
            ],            
        ];
    }

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
                'name' => 'Barca',
                'ingredients' => '8 nigiri, 4 usomaki, 8 sashimi',
                'price' => 15.00,
                'type' => 'Secondi',
                'is_visible' => true,
            ],
            [
                'name' => 'Barca Grande',
                'ingredients' => '16 nigiri, 8 usomaki, 16 sashimi',
                'price' => 25.00,
                'type' => 'Secondi',
                'is_visible' => true,
            ],
            [
                'name' => 'Uramaki',
                'ingredients' => '8 uramaki con salmone, avocado e philadelphia',
                'price' => 8.00,
                'type' => 'Secondi',
                'is_visible' => true,
            ],
            [
                'name' => 'Nigiri',
                'ingredients' => '8 nigiri al tonno',
                'price' => 8.00,
                'type' => 'Secondi',
                'is_visible' => true,
            ],
            [
                'name' => 'Barca Senza Senso',
                'ingredients' => '70 pezzi di sushi scelti dallo chef',
                'price' => 50.00,
                'type' => 'Secondi',
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
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => 'Panini',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => 'Secondi',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => '',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => '',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => '',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => '',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => '',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => '',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => '',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => '',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => '',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => '',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => '',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => '',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => '',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => '',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => '',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => '',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => '',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => '',
                'is_visible' => true,
            ],
            [
                'name' => '',
                'ingredients' => '',
                'price' => ,
                'type' => '',
                'is_visible' => true,
            ],
        ];
    }
}