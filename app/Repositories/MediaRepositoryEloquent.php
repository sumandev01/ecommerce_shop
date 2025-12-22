<?php

namespace App\Repositories;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;

class MediaRepositoryEloquent implements MediaRepository
{
    public function storeByRequest(UploadedFile $file, string $path, ?string $type = null): Media
    {
        $filePath = Storage::disk('public')->put('/' . trim($path, '/'), $file);
        $extension = $file->extension();

        if (! $type) {
            $type = in_array($extension, ['jpg','jpeg','png','gif','bmp','svg','webp']) ? 'image' : $extension;
        }

        return Media::create([
            'type' => $type,
            'src' => $filePath,
            'name' => $file->getClientOriginalName(),
            'extension' => $extension,
        ]);
    }

    /**
     * Update a media by a request
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     * @param string|null $type
     * @param \App\Models\Media $media
     * @return \App\Models\Media
     */
    public function updateByRequest(UploadedFile $file, string $path, $type = null, Media $media): Media
    {
        $filePath = Storage::disk('public')->put('/' . trim($path, '/'), $file);
        $extension = $file->extension();

        if (! $type) {
            $type = in_array($extension, ['jpg','jpeg','png','gif','bmp','svg','webp']) ? 'image' : $extension;
        }

        if (Storage::exists($media->src)){
            Storage::delete($media->src);
        }

        $media->update([
            'type' => $type,
            'src' => $filePath,
            'name' => $file->getClientOriginalName(),
            'extension' => $extension,
        ]);
        return $media;
    }

    public function deleteMediaId($id)
    {
        $media = Media::find($id);

        if ($media) {
            if (Storage::exists($media->src)){
                Storage::delete($media->src);
            }
            return $media->delete();
        }
    }

    public function delete(Media $media): bool
    {
        if (Storage::exists($media->src)){
            Storage::delete($media->src);
        }
        return $media->delete();
    }
}
