<?php

namespace Tests\Feature\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StoreTest extends TestCase
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

        $this->product = factory(Product::class)->make([
            'category_id' => $this->category->id,
        ]);

        $this->data = $this->product->toArray();

        $this->data['category_id'] = $this->category->id;

        $this->data['api_token'] = $this->user->api_token;
    }

    public function tearDown()
    {
        $this->user = null;

        $this->category = null;

        $this->product = null;

        $this->data = null;
    }

    public function testSuccessStore()
    {
        $response = $this->json('POST', route('products.store'), $this->data);

        $response
            ->assertStatus(201)
            ->assertJson(['status' => 'success']);
    }

    public function testRequiredName()
    {
        $this->data['name'] = null;

        $response = $this->json('POST', route('products.store'), $this->data);

        $response
            ->assertStatus(400)
            ->assertJson(['message' => 'Validation error'])
            ->assertJson(['status' => 'error']);
    }

    public function testRequiredDescription()
    {
        $this->data['description'] = null;

        $response = $this->json('POST', route('products.store'), $this->data);

        $response
            ->assertStatus(400)
            ->assertJson(['message' => 'Validation error'])
            ->assertJson(['status' => 'error']);
    }

    public function testRequiredPrice()
    {
        $this->data['price'] = null;

        $response = $this->json('POST', route('products.store'), $this->data);

        $response
            ->assertStatus(400)
            ->assertJson(['message' => 'Validation error'])
            ->assertJson(['status' => 'error']);
    }

    public function testNumericPrice()
    {
        $this->data['price'] = 'aaa';

        $response = $this->json('POST', route('products.store'), $this->data);

        $response
            ->assertStatus(400)
            ->assertJson(['message' => 'Validation error'])
            ->assertJson(['status' => 'error']);
    }

    public function testRequiredCategory()
    {
        $this->data['category_id'] = null;

        $response = $this->json('POST', route('products.store'), $this->data);

        $response
            ->assertStatus(400)
            ->assertJson(['message' => 'Validation error'])
            ->assertJson(['status' => 'error']);
    }

    public function testExistsCategory()
    {
        $this->data['category_id'] = 100000;

        $response = $this->json('POST', route('products.store'), $this->data);

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

        $response = $this->json('POST', route('products.store'), $this->data);

        $response
            ->assertStatus(400)
            ->assertJson(['message' => 'Validation error'])
            ->assertJson(['status' => 'error']);
    }

    public function testStorePhoto()
    {
        $file = UploadedFile::fake()->image('divan.jpg');

        $this->data['photo'] = $file;

        $response = $this->json('POST', route('products.store'), $this->data);

        $content = json_decode($response->content());

        $product = Product::find($content->data->id);

        $fileName = $product->id . '.' . $file->extension();

        $this->assertSame($fileName, $product->photo);

        Storage::assertExists('public/products/' . $fileName);

        $response
            ->assertStatus(201)
            ->assertJson(['status' => 'success']);

        if (Storage::exists('public/products/' . $fileName)) {
            Storage::delete('public/products/' . $fileName);
        }
    }
}
