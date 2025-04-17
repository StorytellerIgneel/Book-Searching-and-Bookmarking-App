<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("authors")->insert(values:[
            [
                "name"=>"Reki Kawahara",
                "bio" => "Reki Kawahara is a Japanese author best known for his work on the Sword Art Online and Accel World series. Born on April 17, 1974, Kawahara initially pursued a career in computer science before turning to writing. His breakthrough came with the web novel Sword Art Online in 2002, which later became a massively popular light novel series. The Sword Art Online franchise has expanded into anime, manga, and video games, earning Kawahara a significant place in modern Japanese science fiction and fantasy literature. Known for blending virtual reality with philosophical themes, Kawahara continues to influence the genre with his imaginative storytelling.",
                "image_link"=>"booksearch\storage\app\public\images\authors\Reki-Kawahara.png"
            ],
            [
                "name" => "George R.R Martin",
                "bio" => "George R.R. Martin is an American author, screenwriter, and television producer, best known for his epic fantasy series A Song of Ice and Fire, which inspired the hit HBO series Game of Thrones. Born on September 20, 1948, in Bayonne, New Jersey, Martin began his career as a science fiction writer before moving to fantasy. His intricate world-building, complex characters, and unpredictable plot twists have made A Song of Ice and Fire one of the most influential fantasy series of the 21st century. Martin’s works have garnered numerous awards, and he is regarded as one of the most significant writers in modern speculative fiction. Despite the success of Game of Thrones, fans eagerly await the final books in the series.",
                "image_link" => "booksearch\storage\app\public\images\authors\George_R._R._Martin_by_Gage_Skidmore_2.jpg"
            ],
        ]);
    }
}
