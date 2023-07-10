<?php
declare(strict_types=1);

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
class StoreFileService implements StoreFileServiceInterface
{
    /**
     * @param UploadedFile $uploadedFile
     * @param string $directoryKey
     * @return string
     * @throws \InvalidArgumentException
     */
    public function run(UploadedFile $uploadedFile, string $directoryKey = 'user_profile'): string
    {
        /** @throws \InvalidArgumentException */
        UploadedFileValidation::validate($uploadedFile);
        return self::executeStoreFile($uploadedFile, $directoryKey);
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param string $directoryKey
     * @return string
     */
    private static function executeStoreFile(UploadedFile $uploadedFile, string $directoryKey): string
    {
        $storePath = self::createStorePath($directoryKey, $uploadedFile->getClientOriginalName(), $uploadedFile->getClientOriginalExtension());
        $uploadedFile->storeAs($storePath);

        return $storePath;
    }

    /**
     * @param string $originalName
     * @param string $originalExtention
     * @return string
     */
    private static function createStorePath(string $directoryKey, string $originalName, string $originalExtention): string
    {
        $originalNameHashedWithDate = sha1(uniqid(Carbon::now() . $originalName , true));
        return "/image/$directoryKey/" . $originalNameHashedWithDate . '.' . $originalExtention;
    }
}
