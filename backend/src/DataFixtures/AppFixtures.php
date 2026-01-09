<?php

namespace App\DataFixtures;

use App\Entity\Alergeno;
use App\Entity\Categoria;
use App\Entity\Mesa;
use App\Entity\Producto;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // ==================== ALÉRGENOS ====================
        $alergenos = [];
        $alergenosData = [
            ['nombre' => 'Gluten', 'icono' => '🌾'],
            ['nombre' => 'Crustáceos', 'icono' => '🦐'],
            ['nombre' => 'Huevos', 'icono' => '🥚'],
            ['nombre' => 'Pescado', 'icono' => '🐟'],
            ['nombre' => 'Cacahuetes', 'icono' => '🥜'],
            ['nombre' => 'Soja', 'icono' => '🫘'],
            ['nombre' => 'Lácteos', 'icono' => '🥛'],
            ['nombre' => 'Frutos de cáscara', 'icono' => '🌰'],
            ['nombre' => 'Apio', 'icono' => '🥬'],
            ['nombre' => 'Mostaza', 'icono' => '🟡'],
            ['nombre' => 'Sésamo', 'icono' => '⚪'],
            ['nombre' => 'Sulfitos', 'icono' => '🍷'],
            ['nombre' => 'Altramuces', 'icono' => '🌱'],
            ['nombre' => 'Moluscos', 'icono' => '🦪'],
        ];

        foreach ($alergenosData as $data) {
            $alergeno = new Alergeno();
            $alergeno->setNombre($data['nombre']);
            $alergeno->setIcono($data['icono']);
            $manager->persist($alergeno);
            $alergenos[$data['nombre']] = $alergeno;
        }

        // ==================== CATEGORÍAS ====================
        $categorias = [];
        $categoriasData = [
            ['nombre' => 'Raciones', 'descripcion' => 'Raciones para compartir', 'orden' => 1],
            ['nombre' => 'Combos', 'descripcion' => 'Combos completos', 'orden' => 2],
            ['nombre' => 'Pizzas', 'descripcion' => 'Pizzas artesanas', 'orden' => 3],
            ['nombre' => 'Bocadillos', 'descripcion' => 'Bocadillos y bocatas', 'orden' => 4],
            ['nombre' => 'Sándwiches', 'descripcion' => 'Sándwiches variados', 'orden' => 5],
            ['nombre' => 'Hamburguesas', 'descripcion' => 'Hamburguesas caseras', 'orden' => 6],
            ['nombre' => 'Kebabs', 'descripcion' => 'Kebabs', 'orden' => 7],
            ['nombre' => 'Bebidas', 'descripcion' => 'Refrescos y bebidas', 'orden' => 8],
            ['nombre' => 'Cervezas', 'descripcion' => 'Cervezas', 'orden' => 9],
            ['nombre' => 'Vinos y Copas', 'descripcion' => 'Vinos y copas', 'orden' => 10],
            ['nombre' => 'Cafés', 'descripcion' => 'Cafés e infusiones', 'orden' => 11],
        ];

        foreach ($categoriasData as $data) {
            $categoria = new Categoria();
            $categoria->setNombre($data['nombre']);
            $categoria->setDescripcion($data['descripcion']);
            $categoria->setOrden($data['orden']);
            $manager->persist($categoria);
            $categorias[$data['nombre']] = $categoria;
        }

        // ==================== PRODUCTOS ====================
        $productosData = [
            // ========== RACIONES ==========
            [
                'nombre' => 'Carne en salsa',
                'descripcion' => 'Ración de carne en salsa casera',
                'precio' => 13.00,
                'categoria' => 'Raciones',
                'alergenos' => ['Gluten', 'Sulfitos'],
                'imagen' => 'carne-salsa.jpg'
            ],
            [
                'nombre' => 'Croquetas caseras',
                'descripcion' => 'Croquetas caseras de jamón',
                'precio' => 13.00,
                'categoria' => 'Raciones',
                'alergenos' => ['Gluten', 'Lácteos', 'Huevos'],
                'imagen' => 'croquetas.jpg'
            ],
            [
                'nombre' => 'Croquetas de coliflor y chocolate blanco',
                'descripcion' => 'Croquetas caseras de coliflor y chocolate blanco',
                'precio' => 13.00,
                'categoria' => 'Raciones',
                'alergenos' => ['Gluten', 'Lácteos', 'Huevos'],
                'imagen' => 'croquetas-coliflor.jpg'
            ],
            [
                'nombre' => 'Solomillo trinchado',
                'descripcion' => 'Solomillo de cerdo trinchado',
                'precio' => 14.00,
                'categoria' => 'Raciones',
                'alergenos' => [],
                'imagen' => 'solomillo.jpg'
            ],
            [
                'nombre' => 'Secreto trinchado',
                'descripcion' => 'Secreto ibérico trinchado',
                'precio' => 14.00,
                'categoria' => 'Raciones',
                'alergenos' => [],
                'imagen' => 'secreto.jpg'
            ],
            [
                'nombre' => 'Lomo con ajos',
                'descripcion' => 'Lomo de cerdo con ajos',
                'precio' => 13.00,
                'categoria' => 'Raciones',
                'alergenos' => [],
                'imagen' => 'lomo-ajos.jpg'
            ],
            [
                'nombre' => 'Huevos rotos con patatas y jamón',
                'descripcion' => 'Huevos rotos con patatas y jamón (precio por persona)',
                'precio' => 4.00,
                'categoria' => 'Raciones',
                'alergenos' => ['Huevos'],
                'imagen' => 'huevos-rotos.jpg'
            ],
            [
                'nombre' => 'Cazón',
                'descripcion' => 'Ración de cazón frito',
                'precio' => 14.00,
                'categoria' => 'Raciones',
                'alergenos' => ['Pescado', 'Gluten'],
                'imagen' => 'cazon.jpg'
            ],
            [
                'nombre' => 'Calamares',
                'descripcion' => 'Ración de calamares fritos',
                'precio' => 14.00,
                'categoria' => 'Raciones',
                'alergenos' => ['Moluscos', 'Gluten'],
                'imagen' => 'calamares.jpg'
            ],
            [
                'nombre' => 'Fritura de pescado',
                'descripcion' => 'Fritura variada de pescado',
                'precio' => 20.00,
                'categoria' => 'Raciones',
                'alergenos' => ['Pescado', 'Gluten', 'Moluscos'],
                'imagen' => 'fritura.jpg'
            ],

            // ========== COMBOS (TODOS 6€) ==========
            [
                'nombre' => 'Combo Carne kebab con patatas',
                'descripcion' => 'Carne kebab acompañada de patatas fritas',
                'precio' => 6.00,
                'categoria' => 'Combos',
                'alergenos' => ['Gluten'],
                'imagen' => 'combo-kebab.jpg'
            ],
            [
                'nombre' => 'Combo Carne en salsa con patatas',
                'descripcion' => 'Carne en salsa acompañada de patatas fritas',
                'precio' => 6.00,
                'categoria' => 'Combos',
                'alergenos' => ['Gluten', 'Sulfitos'],
                'imagen' => 'combo-carne.jpg'
            ],
            [
                'nombre' => 'Combo Nuggets con patatas',
                'descripcion' => 'Nuggets de pollo acompañados de patatas fritas',
                'precio' => 6.00,
                'categoria' => 'Combos',
                'alergenos' => ['Gluten', 'Huevos'],
                'imagen' => 'combo-nuggets.jpg'
            ],

            // ========== PIZZAS (TODAS 11€) ==========
            [
                'nombre' => 'Pizza York y Queso',
                'descripcion' => 'Jamón york, queso, mozzarella y orégano',
                'precio' => 11.00,
                'categoria' => 'Pizzas',
                'alergenos' => ['Gluten', 'Lácteos'],
                'imagen' => 'pizza-york.jpg'
            ],
            [
                'nombre' => 'Pizza Barbacoa',
                'descripcion' => 'Carne picada, bacon y salsa barbacoa',
                'precio' => 11.00,
                'categoria' => 'Pizzas',
                'alergenos' => ['Gluten', 'Lácteos'],
                'imagen' => 'pizza-barbacoa.jpg'
            ],
            [
                'nombre' => 'Pizza 4 Quesos',
                'descripcion' => 'Diferentes quesos, incluido roquefort y orégano',
                'precio' => 11.00,
                'categoria' => 'Pizzas',
                'alergenos' => ['Gluten', 'Lácteos'],
                'imagen' => 'pizza-4quesos.jpg'
            ],
            [
                'nombre' => 'Pizza Kebab',
                'descripcion' => 'Carne kebab, mozzarella, orégano, cebolla y salsa kebab',
                'precio' => 11.00,
                'categoria' => 'Pizzas',
                'alergenos' => ['Gluten', 'Lácteos'],
                'imagen' => 'pizza-kebab.jpg'
            ],
            [
                'nombre' => 'Pizza Atún',
                'descripcion' => 'Mozzarella, orégano, pimiento verde y atún',
                'precio' => 11.00,
                'categoria' => 'Pizzas',
                'alergenos' => ['Gluten', 'Lácteos', 'Pescado'],
                'imagen' => 'pizza-atun.jpg'
            ],
            [
                'nombre' => 'Pizza Carbonara',
                'descripcion' => 'Mozzarella, orégano, beicon, cebolla, champiñones y nata',
                'precio' => 11.00,
                'categoria' => 'Pizzas',
                'alergenos' => ['Gluten', 'Lácteos'],
                'imagen' => 'pizza-carbonara.jpg'
            ],
            [
                'nombre' => 'Pizza Vegetal',
                'descripcion' => 'Mozzarella, orégano, pimiento, cebolla, maíz, espárragos y champiñones',
                'precio' => 11.00,
                'categoria' => 'Pizzas',
                'alergenos' => ['Gluten', 'Lácteos'],
                'imagen' => 'pizza-vegetal.jpg'
            ],
            [
                'nombre' => 'Pizza Hamburguesa',
                'descripcion' => 'Tomate, queso, mini burger y salsa burger',
                'precio' => 11.00,
                'categoria' => 'Pizzas',
                'alergenos' => ['Gluten', 'Lácteos', 'Huevos'],
                'imagen' => 'pizza-hamburguesa.jpg'
            ],

            // ========== BOCADILLOS ==========
            [
                'nombre' => 'Bocata XXL',
                'descripcion' => 'Lomo, queso, huevo, beicon, tomate y lechuga',
                'precio' => 12.00,
                'categoria' => 'Bocadillos',
                'alergenos' => ['Gluten', 'Lácteos', 'Huevos'],
                'imagen' => 'bocata-xxl.jpg'
            ],
            [
                'nombre' => 'Bocadillo de Lomo',
                'descripcion' => 'Bocadillo de lomo a la plancha',
                'precio' => 5.00,
                'categoria' => 'Bocadillos',
                'alergenos' => ['Gluten'],
                'imagen' => 'bocadillo-lomo.jpg'
            ],
            [
                'nombre' => 'Bocadillo de Lomo Completo',
                'descripcion' => 'Bocadillo de lomo con extras',
                'precio' => 6.00,
                'categoria' => 'Bocadillos',
                'alergenos' => ['Gluten', 'Huevos', 'Lácteos'],
                'imagen' => 'bocadillo-lomo-completo.jpg'
            ],
            [
                'nombre' => 'Bocadillo de Carne en Salsa',
                'descripcion' => 'Bocadillo de carne en salsa casera',
                'precio' => 5.00,
                'categoria' => 'Bocadillos',
                'alergenos' => ['Gluten', 'Sulfitos'],
                'imagen' => 'bocadillo-carne.jpg'
            ],
            [
                'nombre' => 'Bocadillo de Carne en Salsa Completo',
                'descripcion' => 'Bocadillo de carne en salsa con extras',
                'precio' => 6.00,
                'categoria' => 'Bocadillos',
                'alergenos' => ['Gluten', 'Sulfitos', 'Huevos', 'Lácteos'],
                'imagen' => 'bocadillo-carne-completo.jpg'
            ],
            [
                'nombre' => 'Bocadillo de Tortilla',
                'descripcion' => 'Bocadillo de tortilla española',
                'precio' => 5.00,
                'categoria' => 'Bocadillos',
                'alergenos' => ['Gluten', 'Huevos'],
                'imagen' => 'bocadillo-tortilla.jpg'
            ],
            [
                'nombre' => 'Bocadillo de Tortilla Completo',
                'descripcion' => 'Bocadillo de tortilla con extras',
                'precio' => 6.00,
                'categoria' => 'Bocadillos',
                'alergenos' => ['Gluten', 'Huevos', 'Lácteos'],
                'imagen' => 'bocadillo-tortilla-completo.jpg'
            ],
            [
                'nombre' => 'Bocadillo de Jamón',
                'descripcion' => 'Bocadillo de jamón serrano',
                'precio' => 5.00,
                'categoria' => 'Bocadillos',
                'alergenos' => ['Gluten'],
                'imagen' => 'bocadillo-jamon.jpg'
            ],
            [
                'nombre' => 'Bocadillo de Jamón Completo',
                'descripcion' => 'Bocadillo de jamón con extras',
                'precio' => 6.00,
                'categoria' => 'Bocadillos',
                'alergenos' => ['Gluten', 'Huevos', 'Lácteos'],
                'imagen' => 'bocadillo-jamon-completo.jpg'
            ],
            [
                'nombre' => 'Bocadillo de Atún',
                'descripcion' => 'Bocadillo de atún',
                'precio' => 5.00,
                'categoria' => 'Bocadillos',
                'alergenos' => ['Gluten', 'Pescado'],
                'imagen' => 'bocadillo-atun.jpg'
            ],
            [
                'nombre' => 'Bocadillo de Atún Completo',
                'descripcion' => 'Bocadillo de atún con extras',
                'precio' => 6.00,
                'categoria' => 'Bocadillos',
                'alergenos' => ['Gluten', 'Pescado', 'Huevos', 'Lácteos'],
                'imagen' => 'bocadillo-atun-completo.jpg'
            ],

            // ========== SÁNDWICHES ==========
            [
                'nombre' => 'Sándwich Mixto',
                'descripcion' => 'Jamón york y queso',
                'precio' => 4.00,
                'categoria' => 'Sándwiches',
                'alergenos' => ['Gluten', 'Lácteos'],
                'imagen' => 'sandwich-mixto.jpg'
            ],
            [
                'nombre' => 'Sándwich Completo',
                'descripcion' => 'Jamón york, queso, huevo, tomate y lechuga',
                'precio' => 5.00,
                'categoria' => 'Sándwiches',
                'alergenos' => ['Gluten', 'Lácteos', 'Huevos'],
                'imagen' => 'sandwich-completo.jpg'
            ],
            [
                'nombre' => 'Sándwich Vegetal',
                'descripcion' => 'Lechuga, tomate, huevo, espárragos y atún',
                'precio' => 5.00,
                'categoria' => 'Sándwiches',
                'alergenos' => ['Gluten', 'Huevos', 'Pescado'],
                'imagen' => 'sandwich-vegetal.jpg'
            ],

            // ========== HAMBURGUESAS ==========
            [
                'nombre' => 'Hamburguesa Normal',
                'descripcion' => 'Carne, tomate, queso y lechuga',
                'precio' => 4.50,
                'categoria' => 'Hamburguesas',
                'alergenos' => ['Gluten', 'Lácteos'],
                'imagen' => 'hamburguesa-normal.jpg'
            ],
            [
                'nombre' => 'Hamburguesa Completa',
                'descripcion' => 'Carne, tomate, queso, lechuga, huevo y beicon',
                'precio' => 5.50,
                'categoria' => 'Hamburguesas',
                'alergenos' => ['Gluten', 'Lácteos', 'Huevos'],
                'imagen' => 'hamburguesa-completa.jpg'
            ],
            [
                'nombre' => 'Hamburguesa Casa Encarni',
                'descripcion' => 'Carne de ternera 180gr, cebolla caramelizada, queso cheddar, beicon, huevo y salsa cheddar',
                'precio' => 10.00,
                'categoria' => 'Hamburguesas',
                'alergenos' => ['Gluten', 'Lácteos', 'Huevos'],
                'imagen' => 'hamburguesa-casa-encarni.jpg'
            ],

            // ========== KEBABS ==========
            [
                'nombre' => 'Kebab',
                'descripcion' => 'Tomate, lechuga, huevo, queso, carne kebab y salsa kebab',
                'precio' => 6.00,
                'categoria' => 'Kebabs',
                'alergenos' => ['Gluten', 'Lácteos', 'Huevos'],
                'imagen' => 'kebab.jpg'
            ],

            // ========== BEBIDAS ==========
            [
                'nombre' => 'Coca-Cola',
                'descripcion' => 'Coca-Cola, Zero o Light',
                'precio' => 2.00,
                'categoria' => 'Bebidas',
                'alergenos' => [],
                'imagen' => 'coca-cola.jpg'
            ],
            [
                'nombre' => 'Fanta',
                'descripcion' => 'Fanta naranja o limón',
                'precio' => 2.00,
                'categoria' => 'Bebidas',
                'alergenos' => [],
                'imagen' => 'fanta.jpg'
            ],
            [
                'nombre' => 'Agua',
                'descripcion' => 'Agua mineral',
                'precio' => 1.50,
                'categoria' => 'Bebidas',
                'alergenos' => [],
                'imagen' => 'agua.jpg'
            ],
            [
                'nombre' => 'Nestea',
                'descripcion' => 'Nestea limón',
                'precio' => 2.00,
                'categoria' => 'Bebidas',
                'alergenos' => [],
                'imagen' => 'nestea.jpg'
            ],
            [
                'nombre' => 'Aquarius',
                'descripcion' => 'Aquarius naranja o limón',
                'precio' => 2.00,
                'categoria' => 'Bebidas',
                'alergenos' => [],
                'imagen' => 'aquarius.jpg'
            ],

            // ========== CERVEZAS ==========
            [
                'nombre' => 'Caña',
                'descripcion' => 'Caña de cerveza',
                'precio' => 1.50,
                'categoria' => 'Cervezas',
                'alergenos' => ['Gluten'],
                'imagen' => 'cana.jpg'
            ],
            [
                'nombre' => 'Jarra',
                'descripcion' => 'Jarra de cerveza',
                'precio' => 3.00,
                'categoria' => 'Cervezas',
                'alergenos' => ['Gluten'],
                'imagen' => 'jarra.jpg'
            ],
            [
                'nombre' => 'Botellín',
                'descripcion' => 'Botellín de cerveza',
                'precio' => 2.00,
                'categoria' => 'Cervezas',
                'alergenos' => ['Gluten'],
                'imagen' => 'botellin.jpg'
            ],

            // ========== VINOS Y COPAS ==========
            [
                'nombre' => 'Tinto de verano',
                'descripcion' => 'Vino tinto con gaseosa',
                'precio' => 2.00,
                'categoria' => 'Vinos y Copas',
                'alergenos' => ['Sulfitos'],
                'imagen' => 'tinto-verano.jpg'
            ],
            [
                'nombre' => 'Copa de vino',
                'descripcion' => 'Copa de vino tinto o blanco',
                'precio' => 2.50,
                'categoria' => 'Vinos y Copas',
                'alergenos' => ['Sulfitos'],
                'imagen' => 'copa-vino.jpg'
            ],

            // ========== CAFÉS ==========
            [
                'nombre' => 'Café solo',
                'descripcion' => 'Café espresso',
                'precio' => 1.20,
                'categoria' => 'Cafés',
                'alergenos' => [],
                'imagen' => 'cafe-solo.jpg'
            ],
            [
                'nombre' => 'Café con leche',
                'descripcion' => 'Café con leche',
                'precio' => 1.50,
                'categoria' => 'Cafés',
                'alergenos' => ['Lácteos'],
                'imagen' => 'cafe-leche.jpg'
            ],
            [
                'nombre' => 'Cortado',
                'descripcion' => 'Café cortado',
                'precio' => 1.30,
                'categoria' => 'Cafés',
                'alergenos' => ['Lácteos'],
                'imagen' => 'cortado.jpg'
            ],
        ];

        foreach ($productosData as $data) {
            $producto = new Producto();
            $producto->setNombre($data['nombre']);
            $producto->setDescripcion($data['descripcion']);
            $producto->setPrecio($data['precio']);
            $producto->setCategoria($categorias[$data['categoria']]);
            $producto->setActivo(true);
            $producto->setImagen($data['imagen']);

            foreach ($data['alergenos'] as $alergenoNombre) {
                if (isset($alergenos[$alergenoNombre])) {
                    $producto->addAlergeno($alergenos[$alergenoNombre]);
                }
            }

            $manager->persist($producto);
        }

        // ==================== MESAS ====================
        for ($i = 1; $i <= 15; $i++) {
            $mesa = new Mesa();
            $mesa->setNumero($i);
            $mesa->setTokenQr(bin2hex(random_bytes(16))); // Token único de 32 caracteres
            $mesa->setActiva(true);
            $manager->persist($mesa);
        }

        $manager->flush();
    }
}
