<?php

namespace Tests\Feature\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var User $user
     */
    protected $user;

    /**
     * @var Category $category
     */
    protected $category;

    /**
     * @var Product $product
     */
    protected $product;

    /**
     * @var Product $update
     */
    protected $update;

    /**
     * @var array $data
     */
    protected $data;

    protected function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->category = factory(Category::class)->create();

        $this->product = $this->user->products()->save(factory(Product::class)->make([
            'category_id' => $this->category->id,
        ]));

        $this->update = factory(Product::class)->make([
            'category_id' => $this->category->id,
        ]);

        $this->data = $this->update->toArray();

        $this->data['category_id'] = $this->update->category_id;

        $this->data['api_token'] = $this->user->api_token;
    }

    public function tearDown()
    {
        $this->user = null;

        $this->category = null;

        $this->product = null;

        $this->data = null;
    }

    public function testSuccessUpdate()
    {
        $response = $this->json('PUT', route('products.update', $this->product), $this->data);

        $response
            ->assertStatus(200)
            ->assertJson(['status' => 'success']);
    }

    public function testRequiredName()
    {
        $this->data['name'] = null;

        $response = $this->json('PUT', route('products.update', $this->product), $this->data);

        $response
            ->assertStatus(400)
            ->assertJson(['message' => 'Validation error'])
            ->assertJson(['status' => 'error']);
    }

    public function testRequiredDescription()
    {
        $this->data['description'] = null;

        $response = $this->json('PUT', route('products.update', $this->product), $this->data);

        $response
            ->assertStatus(400)
            ->assertJson(['message' => 'Validation error'])
            ->assertJson(['status' => 'error']);
    }

    public function testRequiredPrice()
    {
        $this->data['price'] = null;

        $response = $this->json('PUT', route('products.update', $this->product), $this->data);

        $response
            ->assertStatus(400)
            ->assertJson(['message' => 'Validation error'])
            ->assertJson(['status' => 'error']);
    }

    public function testNumericPrice()
    {
        $this->data['price'] = 'aaa';

        $response = $this->json('PUT', route('products.update', $this->product), $this->data);

        $response
            ->assertStatus(400)
            ->assertJson(['message' => 'Validation error'])
            ->assertJson(['status' => 'error']);
    }

    public function testRequiredCategory()
    {
        $this->data['category_id'] = null;

        $response = $this->json('PUT', route('products.update', $this->product), $this->data);

        $response
            ->assertStatus(400)
            ->assertJson(['message' => 'Validation error'])
            ->assertJson(['status' => 'error']);
    }

    public function testExistsCategory()
    {
        $this->data['category_id'] = 100000;

        $response = $this->json('PUT', route('products.update', $this->product), $this->data);

        $response
            ->assertStatus(400)
            ->assertJson(['message' => 'Validation error'])
            ->assertJson(['status' => 'error']);
    }

    public function testRequiredPhotoDescription()
    {
        $file = UploadedFile::fake()->image('divan.jpg');

        $this->data['photo'] = $file;

        $this->data['photo_desc'] = null;

        $response = $this->json('PUT', route('products.update', $this->product), $this->data);

        $response
            ->assertStatus(400)
            ->assertJson(['message' => 'Validation error'])
            ->assertJson(['status' => 'error']);
    }

    public function testUpdatePhoto()
    {
        $file = UploadedFile::fake()->image('divan.jpg');

        $this->data['photo'] = $file;

        $response = $this->json('PUT', route('products.update', $this->product), $this->data);

        $this->product->refresh();

        $fileName = $this->product->id . '.' . $file->extension();

        $this->assertSame($fileName, $this->product->photo);

        Storage::assertExists('public/products/' . $fileName);

        $response
            ->assertStatus(200)
            ->assertJson(['status' => 'success']);

        if (Storage::exists('public/products/' . $fileName)) {
            Storage::delete('public/products/' . $fileName);
        }
    }

    public function testUpdateAuthorizationError()
    {
        $this->user = factory(User::class)->create();

        $this->data = [
            'api_token' => $this->user->api_token,
        ];

        $response = $this->json('DELETE', route('products.update', $this->product), $this->data);

        $response
            ->assertStatus(403)
            ->assertJson(['message' => 'Authorization error']);
    }
}
