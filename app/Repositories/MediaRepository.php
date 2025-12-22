<?php

namespace App\Repositories;

use Illuminate\Http\UploadedFile;
use App\Models\Media;

interface MediaRepository
{
    public function storeByRequest(UploadedFile $file, string $path, ?string $type = null): Media;
}
