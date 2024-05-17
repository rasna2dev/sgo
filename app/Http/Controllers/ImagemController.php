<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagemController extends AbstractController
{

    public function index(Request $request, $imagem)
    {

        switch($imagem) {
            case 'indisponivel.png': {

                return criarImagemTexto(570, 370, 'IMAGEM INDISPONÍVEL');

                break;
            }

            default: {
                $f = storage_path('app');
                $f = "{$f}/public/imagem/{$imagem}";
                $w = $request->has('w') ? $request->get('w') : 0;
                $w = $w > 1280 ? 1280 : $w;


                if(file_exists($f)) {

                    $size = filesize($f);

                    if(!is_null(@$size) && strlen($size)) {

                        $image = imagecreatefromjpeg($f);

                        if($w > 0) {
                            $image = imagescale($image , $w);
                        }

                        ob_start();
                        if($request->has('q')) {
                            imagejpeg($image, null, 100);
                        } else {
                            imagejpeg($image);
                        }

                        $contents = ob_get_contents();
                        imagedestroy($image);
                        ob_end_clean();

                        $f = "data:image/jpeg;base64,".base64_encode($contents);

                        header('Last-Modified: '. date('d m Y H:i:s'), true, 200);
                        header('Content-Type: image/jpeg');

                        readfile($f);

                        echo $f;
                    }
                }
                break;
            }
        }




    }

}
