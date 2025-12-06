<?php

namespace Tests\Feature\Admin;

use App\Enums\VendorApproveEnum;
use App\Enums\VendorTypeEnum;
use App\Models\CarType;
use App\Models\City;
use App\Models\Specialization;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class VendorControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $admin;
    protected $city;
    protected $carTypes;
    protected $specializations;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Create admin user
        $this->admin = User::factory()->create(['role' => 'admin']);

        // Create a city
        $this->city = City::factory()->create();

        // Create car types
        $this->carTypes = CarType::factory()->count(3)->create();

        // Create specializations
        $this->specializations = Specialization::factory()->count(3)->create();

        // Authenticate as admin
        $this->actingAs($this->admin);
    }

    /**
     * Test vendor index page displays vendors of a specific type.
     *
     * @return void
     */
    public function test_index_displays_vendors_by_type()
    {
        // Create vendors of different types
        $workshopVendor = Vendor::factory()->create([
            'type' => VendorTypeEnum::WORKSHOP,
            'is_approved' => VendorApproveEnum::APPROVED,
        ]);

        $carShowroomVendor = Vendor::factory()->create([
            'type' => VendorTypeEnum::CAR_SHOWROOM,
            'is_approved' => VendorApproveEnum::APPROVED,
        ]);

        // Test workshop vendors page
        $response = $this->get(route('vendors.index', ['type' => 'WORKSHOP']));

        $response->assertStatus(200);
        $response->assertViewHas('models');
        $response->assertSee($workshopVendor->name);
        $response->assertDontSee($carShowroomVendor->name);
    }

    /**
     * Test vendor creation.
     *
     * @return void
     */
    public function test_store_creates_new_vendor()
    {
        Storage::fake('public');

        $vendorData = [
            'name' => ['en' => 'Test Vendor', 'ar' => 'اختبار'],
            'description' => ['en' => 'Test Description', 'ar' => 'وصف الاختبار'],
            'phone' => '123456789',
            'email' => 'vendor@example.com',
            'password' => 'password123',
            'type' => VendorTypeEnum::WORKSHOP,
            'city_id' => $this->city->id,
            'image' => UploadedFile::fake()->image('vendor.jpg'),
            'car_types' => $this->carTypes->pluck('id')->toArray(),
            'specializations' => $this->specializations->pluck('id')->toArray(),
        ];

        $response = $this->post(route('vendors.store'), $vendorData);

        $response->assertRedirect(route('vendors.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('vendors', [
            'email' => 'vendor@example.com',
            'type' => VendorTypeEnum::WORKSHOP,
        ]);

        // Check relationships
        $vendor = Vendor::where('email', 'vendor@example.com')->first();
        $this->assertEquals(3, $vendor->carTypes()->count());
        $this->assertEquals(3, $vendor->specializations()->count());
    }

    /**
     * Test vendor update.
     *
     * @return void
     */
    public function test_update_modifies_vendor()
    {
        // Create a vendor
        $vendor = Vendor::factory()->create([
            'type' => VendorTypeEnum::WORKSHOP,
        ]);

        // Attach car types and specializations
        $vendor->carTypes()->attach($this->carTypes->pluck('id'));
        $vendor->specializations()->attach($this->specializations->pluck('id'));

        // New data for update
        $updateData = [
            'name' => ['en' => 'Updated Vendor', 'ar' => 'تحديث'],
            'description' => ['en' => 'Updated Description', 'ar' => 'وصف محدث'],
            'phone' => '987654321',
            'city_id' => $this->city->id,
            'is_featured' => true,
            'car_types' => [$this->carTypes->first()->id], // Only one car type now
            'specializations' => [], // No specializations
        ];

        $response = $this->put(route('vendors.update', $vendor->id), $updateData);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Refresh vendor from database
        $vendor->refresh();

        // Check updated fields
        $this->assertEquals('Updated Vendor', $vendor->getTranslation('name', 'en'));
        $this->assertEquals('987654321', $vendor->phone);
        $this->assertTrue((bool)$vendor->is_featured);

        // Check relationships
        $this->assertEquals(1, $vendor->carTypes()->count());
        $this->assertEquals(0, $vendor->specializations()->count());
    }

    /**
     * Test toggling vendor featured status.
     *
     * @return void
     */
    public function test_toggle_featured_changes_vendor_status()
    {
        // Create a non-featured vendor
        $vendor = Vendor::factory()->create([
            'is_featured' => false,
        ]);

        $response = $this->post(route('vendors.toggle-featured'), [
            'id' => $vendor->id,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'is_featured' => true,
        ]);

        // Refresh vendor from database
        $vendor->refresh();
        $this->assertTrue((bool)$vendor->is_featured);

        // Toggle again to unfeatured
        $response = $this->post(route('vendors.toggle-featured'), [
            'id' => $vendor->id,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'is_featured' => false,
        ]);

        // Refresh vendor from database
        $vendor->refresh();
        $this->assertFalse((bool)$vendor->is_featured);
    }

    /**
     * Test vendor deletion.
     *
     * @return void
     */
    public function test_destroy_deletes_vendor()
    {
        // Create a vendor
        $vendor = Vendor::factory()->create();

        $response = $this->delete(route('vendors.destroy', $vendor->id));

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $vendor->id,
        ]);

        $this->assertSoftDeleted('vendors', [
            'id' => $vendor->id,
        ]);
    }
}
