<?php
namespace Modules\Packages\Tests\Feature;


use App\Models\User;
use Filament\Facades\Filament;
use Modules\Packages\Filament\Clusters\Packages\Resources\PackageResource;
use Modules\Packages\Filament\Clusters\Packages\Resources\PackageResource\Pages\CreatePackage;
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
    $this->get(PackageResource::getUrl('create'))->assertSuccessful();
});

it('can create a Package', function (): void {

    livewire(CreatePackage::class)
        ->fillForm([
            'name' => 'Amazing Package', 
            'images' => ['image1.jpg', 'image2.jpg'],
            'description' => 'This is an amazing package for traveling.',
            'destination' => 'Paris',
            'duration' => '7 days',
            'price1' => 1000.00,
            'price2' => 1200.00,
            'price3' => 1400.00,
            'price4' => 1600.00,
            'time' => '2025-06-15 10:00:00',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    assertDatabaseHas('packages', [
        'name' => 'Amazing Package',
        'images' => json_encode(['image1.jpg', 'image2.jpg']),
        'description' => 'This is an amazing package for traveling.',
        'destination' => 'Paris',
        'duration' => '7 days',
        'price1' => 1000.00,
        'price2' => 1200.00,
        'price3' => 1400.00,
        'price4' => 1600.00,
        'time' => '2025-06-15 10:00:00',
    ]);
});

it('validates the required fields', function () {
    livewire(CreatePackage::class)
        ->fillForm([])
        ->call('create')
        ->assertHasFormErrors([
            'name',
            'description',
            'duration',
            'destination',
            'price1',
        ]);
});


