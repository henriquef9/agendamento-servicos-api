<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Imagem\ImagemRequest;
use App\Services\ImagemService;
use App\Services\ImagemUploadService;
use Illuminate\Http\Request;

class ImagemUploadController extends Controller
{
    
    private ImagemUploadService $imagemUploadService;

    public function __construct(ImagemUploadService $imagemUploadService) {
        $this->imagemUploadService = $imagemUploadService;
    }

    public function upload(ImagemRequest $request) {

        $file = $request->file('file');


    }

}
