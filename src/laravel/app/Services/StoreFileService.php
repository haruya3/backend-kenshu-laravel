<?php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
class StoreFileService
{
    /**
     * @param UploadedFile $uploadedFile
     * @return string
     * @throws \InvalidArgumentException
     */
    public static function run(UploadedFile $uploadedFile): string
    {
        /** @throws \InvalidArgumentException */
        UplodedFileValidation::validate($uploadedFile);

        $storePath = self::createStorePath($uploadedFile->getClientOriginalName(), $uploadedFile->getClientOriginalExtension());
        $uploadedFile->storeAs($storePath);

        return $storePath;
    }

    /**
     * @param string $originalName
     * @param string $originalExtention
     * @return string
     */
    private static function createStorePath(string $originalName, string $originalExtention): string
    {
        $originalNameHashedWithDate = sha1(uniqid(Carbon::now(), true . $originalName));
        return '/public/image/user_profile/' . $originalNameHashedWithDate . '.' . $originalExtention;
    }
}
