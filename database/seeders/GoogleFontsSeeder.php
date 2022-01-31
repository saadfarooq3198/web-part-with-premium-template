<?php

namespace Database\Seeders;

use App\Models\GoogleFont;
use Illuminate\Database\Seeder;

class GoogleFontsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Aguafina_Script = GoogleFont::create(['google_fonts'=>'Aguafina Script']);
        $Aclonica = GoogleFont::create(['google_fonts'=>'Aclonica']);
        $Akronim = GoogleFont::create(['google_fonts'=>'Akronim']);
        $Aldrich = GoogleFont::create(['google_fonts'=>'Aldrich']);
        $Alfa_Slab_One = GoogleFont::create(['google_fonts'=>'Alfa Slab One']);
    }
}
