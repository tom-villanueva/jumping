<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::truncate();
        Empleado::truncate();

        User::create([
            'name' => 'Juan Perez',
            'email' => 'juanperez@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),//'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  //password
            // 'password' => '$2a$12$BSycJGxQJUmz2rSyn9Wv2.BpmKRV3Fjfw2DzEPHlKF4dDULvUjiPS', //123
            'remember_token' => Str::random(10),
        ]);

        Empleado::create([
            'name' => 'admin',
            'email' => 'admin@jumping.com',
            // 'email_verified_at' => now(),
            'password' => Hash::make('password'),  //password
            'isAdmin' => true,
            // 'password' => '$2a$12$BSycJGxQJUmz2rSyn9Wv2.BpmKRV3Fjfw2DzEPHlKF4dDULvUjiPS', //123
            'remember_token' => Str::random(10),
        ]);
        $this->call(Talles::class);
        $this->call(TipoArticulos::class);
        $this->call(Marcas::class);
        $this->call(Modelos::class);
        $this->call(Equipos::class);
        // $this->call(Articulos::class);
        $this->call(Estados::class);
        $this->call(Descuentos::class);
        // $this->call(Reservas::class);
    }
}
