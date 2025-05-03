<?php 

namespace App\Services;

use App\Repositories\Eloquent\ImagemUploadRepository;
use Illuminate\Http\UploadedFile;

class ImagemUploadService {

    private ImagemUploadRepository $imagemUploadRepository; 

    public function __construct(ImagemUploadRepository $imagemUploadRepository) {
        $this->imagemUploadRepository = $imagemUploadRepository;
    }

    public function upload(?UploadedFile $img, string $path_base): string | null {

        if(!$img || !$img->isValid()){
            return null;
        }

        $path = $this->imagemUploadRepository->upload($img, $path_base);

        return $path;
    }

    public function getUrl(string $path): string {

        return $this->imagemUploadRepository->getUrl($path);

    }

}