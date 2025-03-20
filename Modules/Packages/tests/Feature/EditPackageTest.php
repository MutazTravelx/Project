<?php
namespace Modules\Packages\Tests\Feature;


use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\Packages\Filament\Clusters\Packages\Resources\PackageResource;
use Modules\Packages\Filament\Clusters\Packages\Resources\PackageResource\Pages\EditPackage;
use Modules\Packages\Models\Package;
use Tests\TestCase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertModelMissing;
use function Pest\Livewire\livewire;
use function PHPUnit\Framework\assertEquals;

uses(TestCase::class);

beforeEach(function () {
    Filament::setCurrentPanel(
        Filament::getPanel('admin'),
    );

    $this->user = User::factory()->create();
    actingAs($this->user);
});



it('can render the edit page', function (): void {
    $package = Package::factory()->create();

    $this->get(PackageResource::getUrl('edit', [
        'record' => $package->getRouteKey(),
    ]))->assertSuccessful();

    livewire(EditPackage::class, [
        'record' => $package->getRouteKey(),
    ])->assertSuccessful();
});

it('fills the data into the form', function (): void {
    $package = Package::factory()->create();

    livewire(EditPackage::class, [
        'record' => $package->getRouteKey(),
    ])
        ->assertFormSet([
            'name'        => $package->name,
            'description' => $package->description,
            'destination' => $package->destination,
            'duration'    => $package->duration,
            'price1'      => $package->price1,
            'time'        => $package->time,
        ]);
});




it('can update the Package', function (): void {
    $package = Package::factory()->create();

    livewire(EditPackage::class, [
        'record' => $package->getRouteKey(),
    ])
        ->fillForm([
            'name'        => 'Updated Package',
            'description' => 'Updated description',
            'destination' => 'Rome',
            'duration'    => '10 days',
            'price1'      => 2000.00,
            'price2'      => 2200.00,
            'price3'      => 2400.00,
            'price4'      => 2600.00,
            'time'        => '2025-07-01 12:00:00',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $package->refresh();

    assertEquals('Updated Package', $package->name);
    assertEquals('Updated description', $package->description);
    assertEquals('Rome', $package->destination);
    assertEquals('10 days', $package->duration);
    assertEquals(2000.00, $package->price1);
    assertEquals(2200.00, $package->price2);
    assertEquals(2400.00, $package->price3);
    assertEquals(2600.00, $package->price4);
    assertEquals('2025-07-01 12:00:00', $package->time);
});

it('can delete the Package', function (): void {
    $package = Package::factory()->create();

    livewire(EditPackage::class, [
        'record' => $package->getRouteKey(),
    ])
        ->callAction(DeleteAction::class);

    assertModelMissing($package);
});