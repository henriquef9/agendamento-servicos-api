<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\ImagemUploadRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImagemUploadRepository implements ImagemUploadRepositoryInterface {

    public function upload(UploadedFile $file, string $path): ?string {

        return $file->store($path, 'public');

    }
    
    public function delete(string $path): bool {

        return Storage::disk('public')->exists($path)
        ? Storage::disk('public')->delete($path)
        : false;
    }

    public function getUrl(string $path): string {

        return Storage::url($path);

    }

    public function exists(string $path): bool {

        return Storage::disk('public')->exists($path);

    }
}