<?php
namespace App\tests\Unit;

use App\Services\StoreFileService;
use App\Services\UploadedFileValidation;
use Illuminate\Http\UploadedFile;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadedFileTest extends TestCase
{
    public function test_UplodedFileValidation_validate__正常なファイルをアップロードした時、そのファイルでバリデーションを通過してtrueを返すこと()
    {
        $file = self::getNormalUploadedDummyFile();
        $uploadedFileValidation = new UploadedFileValidation();

        $actualValidationResult = $uploadedFileValidation->validate($file);

        $this->assertTrue($actualValidationResult);
    }

    public function test_StoreFileService_executeStoreFile__正常なファイルがアップロードされた時、そのファイルが正しいファイルパスに保存されること()
    {
        $executeStoreFileMethod = self::getPrivateMethodForTest(StoreFileService::class, 'executeStoreFile');
        $testUploadedFile = self::getNormalUploadedDummyFile();
        $testStoredDirectoryKey = 'test';

        $actualStoredFilePath = $executeStoreFileMethod->invokeArgs(new StoreFileService(), [$testUploadedFile, $testStoredDirectoryKey]);

        Storage::disk()->assertExists($actualStoredFilePath);
    }

    /**
     * 期待されたMIMETYPEとはUploadFileValidation::EXPECTED_FILE_MIME_TYPE_LISTにある通り
     * 'image/jpg', 'image/jpeg', 'image/png'
     */
    public function test_StoreFileService_run__アップロードされたファイルが期待されたMIMETYPEでない時、InvalidArgumentExceptionをthrowすること()
    {
        $this->expectException(\InvalidArgumentException::class);

        $file = UploadedFile::fake()->create(name: 'can_not_upload_ファイル.php', mimeType: 'text/x-php');
        $storeFileService = new StoreFileService;

        $storeFileService->run($file);
    }

    /**
     * @return \Illuminate\Http\Testing\File
     */
    private static function getNormalUploadedDummyFile()
    {
        Storage::fake();
        return UploadedFile::fake()->image('can_upload_ファイル.jpg')->size(5000);
    }

    private static function getPrivateMethodForTest($className, $methodName)
    {
        $reflectionStoreFileService = new \ReflectionClass($className);
        $reflectionTestMethod = $reflectionStoreFileService->getMethod($methodName);
        $reflectionTestMethod->setAccessible(true);

        return $reflectionTestMethod;
    }
}
