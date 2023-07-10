<?php
namespace App\tests\Unit;

use App\Services\StoreFileService;
use App\Services\UploadedFileValidation;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadedFileTest extends TestCase
{
    public function test_UplodedFileValidation_validate__正常なファイルをアップロードした時、そのファイルでバリデーションを通過してtrueを返すこと()
    {
        $file = self::getNormalUploadedDummyFile();
        $this->assertTrue((new UploadedFileValidation)->validate($file));
    }

    public function test_StoreFileService_run__正常なファイルをアップロードした時、そのファイルが保存されていること()
    {
        $file = self::getNormalUploadedDummyFile();

        Storage::disk()->assertExists((new StoreFileService)->run($file));
    }

    public function test_StoreFileService_run__第二引数を指定した時、指定した名前のディレクトリにファイルが保存されること()
    {
        $file = self::getNormalUploadedDummyFile();

        $commonDirectory = '/image';
        $this->assertSame($commonDirectory . '/test', dirname((new StoreFileService())->run($file, 'test')));
    }

    /**
     * 期待されたMIMETYPEとはUploadFileValidation::EXPECTED_FILE_MIME_TYPE_LISTにある通り
     * 'image/jpg', 'image/jpeg', 'image/png'
     */
    public function test_StoreFileService_run__アップロードされたファイルが期待されたMIMETYPEでない時、InvalidArgumentExceptionをthrowすること()
    {
        $this->expectException(\InvalidArgumentException::class);

        $file = UploadedFile::fake()->create(name: 'can_not_upload_ファイル.php', mimeType: 'text/x-php');
        (new StoreFileService)->run($file);
    }

    /**
     * @return \Illuminate\Http\Testing\File
     */
    private static function getNormalUploadedDummyFile()
    {
        Storage::fake();
        return UploadedFile::fake()->image('can_upload_ファイル.jpg')->size(5000);
    }
}
