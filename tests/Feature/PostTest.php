<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Mailtrap yapılandırmasını test sırasında ayarlayın
        config([
            'mail.default' => 'smtp',
            'mail.mailers.smtp.host' => 'smtp.mailtrap.io',
            'mail.mailers.smtp.port' => 2525,
            'mail.mailers.smtp.username' => 'your_mailtrap_username',
            'mail.mailers.smtp.password' => 'your_mailtrap_password',
            'mail.mailers.smtp.encryption' => null,
            'mail.from.address' => 'hello@example.com',
            'mail.from.name' => config('app.name'),
        ]);

        $this->artisan('db:seed');

    }

    public function test_create_user(){
        $response = User::create([
            'name'=> 'tesUserFirst',
            'email' => 'testuserfirst@test.com',
            'password' => 'testpassword'
        ]);

        $this->assertDatabaseHas('users', ['name' => 'tesUserFirst']);

    }

    public function test_user_can_create_post()
    {
        $user = User::first();
        $this->actingAs($user);

        
        // Gönderi oluşturma isteği 
        $response = $this->post('/new-post', [
            'title' => 'Test Post',
            'body' => 'This is a test post.',
            'category_id' => Category::first()->id,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('posts', ['title' => 'Test Post']);
    }

    public function test_user_can_update_post()
    {
        $user = User::first();
        $this->actingAs($user);

        // Gönderi oluştur
        $post = Post::create([
            'title' => 'Test Post',
            'body' => 'This is a test post.',
            'category_id' => Category::first()->id,
            'user_id' => $user->id,
        ]);

        // Gönderiyi güncelleme isteği 
        $response = $this->put("/posts/{$post->id}", [
            'title' => 'Updated Test Post',
            'body' => 'This is an updated test post.',
            'category_id' => $post->category_id,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('posts', ['title' => 'Updated Test Post']);
    }
    

    public function test_user_can_delete_post()
    {
        $user = User::first();
        $this->actingAs($user);


        $post=Post::where('user_id', $user->id)->first();

        // Gönderiyi silme isteği 
        $response = $this->delete("/posts/{$post->id}");

        $response->assertStatus(302);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
