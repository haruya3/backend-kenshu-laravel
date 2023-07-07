<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;

interface StoreFileServiceInterface
{
    /**
     * ファイルを保存してファイルへアクセスできるurlを返します。
     * @param UploadedFile $uploadedFile
     * @param string $directoryKey
     * @return string
     */
    public function run(UploadedFile $uploadedFile, string $directoryKey='user_profile'): string;
}
