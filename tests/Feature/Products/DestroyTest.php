<?php

namespace Tests\Feature\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use DatabaseMigrations;

    protected $user;

    protected $category;

    protected $product;

    protected $data;

    protected function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->category = factory(Category::class)->create();

        $this->product = $this->user->products()->save(factory(Product::class)->make([
            'category_id' => $this->category,
        ]));

        $this->data = [
            'api_token' => $this->user->api_token,
        ];
    }

    public function testDestroySuccess()
    {
        $response = $this->json('DELETE', route('products.destroy', $this->product), $this->data);

        $response
            ->assertStatus(200)
            ->assertJson(['status' => 'success']);

        $this->assertDatabaseMissing('products', ['id' => $this->product->id]);
    }

    public function testDestroyAuthorizationError()
    {
        $this->user = factory(User::class)->create();

        $this->data = [
            'api_token' => $this->user->api_token,
        ];

        $response = $this->json('DELETE', route('products.destroy', $this->product), $this->data);

        $response
            ->assertStatus(403)
            ->assertJson(['message' => 'Authorization error']);

        $this->assertDatabaseHas('products', ['id' => $this->product->id]);
    }
}
