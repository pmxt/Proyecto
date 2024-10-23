<?php

namespace App\Http\Controllers;
use Intervention\Image\Facades\Image;

use Illuminate\Http\Request;

class TestImageController extends Controller
{
    public function test()
    {
        
       
        $img = Image::canvas(800, 600, '#ff0000');
        $img->save(public_path('imagenes/imagen1.jpg'));
        

        return 'Imagen creada correctamente en /public/images/test_image.png';
    }
}
