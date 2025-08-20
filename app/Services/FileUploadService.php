<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    /**
     * Upload a file to the given storage disk.
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param string $disk
     * @return string|null
     */
    public function upload(UploadedFile $file, string $directory = 'uploads', string $disk = 's3'): ?string
    {
        try {
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs($directory, $filename, $disk);

            return $path;
        } catch (\Exception $e) {
            Log::error('File upload failed', [
                'error' => $e->getMessage(),
                'file' => $file->getClientOriginalName(),
                'disk' => $disk,
                'trace' => $e->getTraceAsString(),
            ]);

            return null;
        }
    }

    /**
     * Delete a file from the given storage disk.
     *
     * @param string|null $path
     * @param string $disk
     * @return bool
     */
    public function delete(?string $path, string $disk = 's3'): bool
    {
        try {
            if ($path && Storage::disk($disk)->exists($path)) {
                $result = Storage::disk($disk)->delete($path);
                Log::info('File deleted', ['path' => $path, 'disk' => $disk, 'result' => $result]);

                return $result;
            }

            return false;
        } catch (\Exception $e) {
            Log::error('File deletion failed', [
                'error' => $e->getMessage(),
                'path' => $path,
                'disk' => $disk,
            ]);

            return false;
        }
    }

    // /**
    //  * Generate a temporary URL for a file on S3.
    //  *
    //  * @param string $path
    //  * @param int $minutes
    //  * @return string|null
    //  */
    // public function temporaryUrl(string $path, int $minutes = 5): ?string
    // {
    //     try {
    //         return Storage::disk('s3')->temporaryUrl($path, now()->addMinutes($minutes));
    //     } catch (\Exception $e) {
    //         Log::error('Temporary URL generation failed', [
    //             'error' => $e->getMessage(),
    //             'path' => $path,
    //         ]);

    //         return null;
    //     }
    // }
}
