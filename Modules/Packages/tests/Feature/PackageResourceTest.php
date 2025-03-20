<?php
namespace Modules\Packages\Tests\Feature;


use App\Models\User;
use Filament\Facades\Filament;
use Modules\Packages\Filament\Clusters\Packages\Resources\PackageResource;
use Modules\Packages\Models\Package;
use Tests\TestCase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;

uses(TestCase::class);

beforeEach(function () {
    Filament::setCurrentPanel(
        Filament::getPanel('admin'),
    );

    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('can render the page', function (): void {
    $this->get(PackageResource::getUrl('index'))->assertSuccessful();
});


it('can render the page and display packages', function (): void {
 
    $package1 = Package::factory()->create(['name' => 'Package 1']);
    $package2 = Package::factory()->create(['name' => 'Package 2']);

    // إرسال طلب إلى صفحة "index" الخاصة بالباكجات
    $this->get(PackageResource::getUrl('index'))
        ->assertSuccessful() 
        ->assertSee($package1->name) 
        ->assertSee($package2->name);
});