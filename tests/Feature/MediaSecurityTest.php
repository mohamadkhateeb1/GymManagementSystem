<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class MediaSecurityTest extends TestCase
{
    protected string $mediaPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mediaPath = storage_path('app/public');

        File::ensureDirectoryExists($this->mediaPath);
    }

    public function test_valid_media_file_returns_200(): void
    {
        $file = $this->mediaPath . '/test-media.txt';

        File::put($file, 'test media content');

        $response = $this->get('/api/media/test-media.txt');

        $response->assertOk();

        File::delete($file);
    }

    public function test_missing_media_file_returns_404(): void
    {
        $response = $this->get(
            '/api/media/file-that-does-not-exist.jpg'
        );

        $response->assertNotFound();
    }

    public function test_path_traversal_returns_404(): void
    {
        $outsideFile = storage_path('app/test-secret.txt');

        File::put($outsideFile, 'secret');

        $response = $this->get(
            '/api/media/../test-secret.txt'
        );

        $response->assertNotFound();

        File::delete($outsideFile);
    }

    public function test_encoded_path_traversal_returns_404(): void
    {
        $outsideFile = storage_path('app/test-secret.txt');

        File::put($outsideFile, 'secret');

        $response = $this->get(
            '/api/media/%2e%2e/test-secret.txt'
        );

        $response->assertNotFound();

        File::delete($outsideFile);
    }

    public function test_media_cannot_access_file_outside_public_storage(): void
    {
        $outsideFile = storage_path('app/test-secret.txt');

        File::put($outsideFile, 'secret');

        $response = $this->get(
            '/api/media/../test-secret.txt'
        );

        $response->assertNotFound();

        File::delete($outsideFile);
    }
}