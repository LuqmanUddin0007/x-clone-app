<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_fetch_profile()
    {
        $user = User::factory()->create();
        $token = $user->createToken('token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->getJson('/api/profile');

        $response->assertOk()->assertJsonFragment([
            'email' => $user->email,
            'name' => $user->name,
        ]);
    }

    public function test_user_can_update_name_email_and_picture()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $token = $user->createToken('token')->plainTextToken;

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->postJson('/api/profile/update', [
                             'name' => 'Updated Name',
                             'email' => 'updated@example.com',
                             'profile_picture' => $file,
                         ]);

        $response->assertOk()->assertJsonFragment(['name' => 'Updated Name']);
        Storage::disk('public')->assertExists('profile_pictures/' . $file->hashName());
    }

    public function test_profile_update_requires_validation()
    {
        $user = User::factory()->create();
        $token = $user->createToken('token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->postJson('/api/profile/update', [
                             'name' => '',
                             'email' => 'not-an-email',
                         ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'email']);
    }

    public function test_guest_cannot_access_profile()
    {
        $this->getJson('/api/profile')->assertUnauthorized();
    }
}
