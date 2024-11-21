<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        DB::table('products')->truncate();
    
        $products = [
            ['name' => 'Laptop Dell Inspiron', 'description' => 'Laptop de 14 pulgadas, procesador Intel Core i5.', 'price' => 799.99, 'stock' => 25, 'status' => 'disponible'],
            ['name' => 'Monitor Samsung 24"', 'description' => 'Monitor Full HD de 24 pulgadas.', 'price' => 149.99, 'stock' => 30, 'status' => 'disponible'],
            ['name' => 'Teclado Mecánico Logitech', 'description' => 'Teclado mecánico con switches rojos.', 'price' => 99.99, 'stock' => 50, 'status' => 'disponible'],
            ['name' => 'Mouse Logitech MX Master', 'description' => 'Mouse inalámbrico con precisión avanzada.', 'price' => 69.99, 'stock' => 40, 'status' => 'disponible'],
            ['name' => 'Auriculares Sony WH-1000XM4', 'description' => 'Auriculares inalámbricos con cancelación de ruido.', 'price' => 299.99, 'stock' => 15, 'status' => 'disponible'],
            ['name' => 'Cargador USB-C 65W', 'description' => 'Cargador rápido compatible con múltiples dispositivos.', 'price' => 49.99, 'stock' => 60, 'status' => 'disponible'],
            ['name' => 'Tablet Samsung Galaxy Tab A8', 'description' => 'Tablet de 10 pulgadas con Android.', 'price' => 199.99, 'stock' => 20, 'status' => 'disponible'],
            ['name' => 'Smartphone Xiaomi Redmi Note 12', 'description' => 'Teléfono inteligente con cámara avanzada.', 'price' => 249.99, 'stock' => 35, 'status' => 'disponible'],
            ['name' => 'Impresora HP DeskJet 3755', 'description' => 'Impresora multifuncional compacta.', 'price' => 89.99, 'stock' => 10, 'status' => 'agotado'],
            ['name' => 'Disco Duro Externo 1TB', 'description' => 'Almacenamiento portátil de alta capacidad.', 'price' => 59.99, 'stock' => 45, 'status' => 'disponible'],
            ['name' => 'Cámara Canon EOS Rebel T7', 'description' => 'Cámara DSLR con lente 18-55 mm.', 'price' => 499.99, 'stock' => 8, 'status' => 'disponible'],
            ['name' => 'Televisor LG OLED 55"', 'description' => 'Smart TV OLED con resolución 4K.', 'price' => 1199.99, 'stock' => 5, 'status' => 'disponible'],
            ['name' => 'Bocina Bluetooth JBL Flip 6', 'description' => 'Bocina portátil con sonido potente.', 'price' => 129.99, 'stock' => 25, 'status' => 'disponible'],
            ['name' => 'Router Wi-Fi TP-Link Archer AX50', 'description' => 'Router de alta velocidad con Wi-Fi 6.', 'price' => 109.99, 'stock' => 20, 'status' => 'disponible'],
            ['name' => 'Power Bank Anker 20000mAh', 'description' => 'Batería externa para cargar dispositivos.', 'price' => 39.99, 'stock' => 70, 'status' => 'disponible'],
        ];
    
        DB::table('products')->insert($products);
    }
    
}
