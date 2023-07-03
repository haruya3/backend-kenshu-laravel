<?php
namespace App\Services;


use Illuminate\Http\UploadedFile;


class UploadedFileValidation
{
    const EXPECTED_FILE_MIME_TYPE_LIST = [
        'image/jpg',
        'image/jpeg',
        'image/png'
    ];

    /**
     * @param UploadedFile $uploadedFile
     * @return bool
     * @throws \InvalidArgumentException
     */
    public static function validate(UploadedFile $uploadedFile)
    {
        if(self::is_not_expected_mime_type($uploadedFile->getPathname())) throw new \InvalidArgumentException('uploded file is not expected extention');
        if($uploadedFile->getError() !== 0) throw new \InvalidArgumentException($uploadedFile->getErrorMessage());

        return true;
    }

    /**
     * @param $fiile_path
     * @return bool
     */
    private static function is_not_expected_mime_type($fiile_path): bool
    {
        return !in_array(mime_content_type($fiile_path), self::EXPECTED_FILE_MIME_TYPE_LIST);
    }
}
