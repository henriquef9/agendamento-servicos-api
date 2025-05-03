<?php 

namespace App\Repositories\Interfaces;

use Illuminate\Http\UploadedFile;

interface ImagemUploadRepositoryInterface {

    public function upload(UploadedFile $file, string $path): ?string;
    
    public function delete(string $path): bool;

    public function getUrl(string $path): string;

    public function exists(string $path): bool;

}