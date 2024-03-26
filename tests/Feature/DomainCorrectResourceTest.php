<?php

namespace Tests\Feature;

use App\Filament\Resources\DomainCorrectResource;
use App\Filament\Resources\DomainCorrectResource\Pages\EditDomainCorrect;
use App\Models\DomainCorrect;
use App\Models\DomainNotCorrect;
use Filament\Actions\DeleteAction;
use Livewire\Livewire;

it('can render the index page', function () {
    $this->get(DomainCorrectResource::getUrl('index'))->assertSuccessful();
});

it('can render the create page', function () {
    $this->get(DomainCorrectResource::getUrl('create'))->assertSuccessful();
});

it('can create domain correct', function () {
    $newDomain = DomainCorrect::factory()->make();

    Livewire::test(DomainCorrectResource\Pages\CreateDomainCorrect::class)
        ->fillForm([
            'name' => $newDomain->name,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas(DomainCorrect::class, [
        'name' => $newDomain->name,
    ]);
});

it('can validate form errors on create', function (DomainCorrect $newDomain) {
    Livewire::test(DomainCorrectResource\Pages\CreateDomainCorrect::class)
        ->fillForm([
            'name' => $newDomain->name,
        ])
        ->call('create')
        ->assertHasFormErrors();

    $this->assertDatabaseMissing(DomainCorrect::class, [
        'name' => $newDomain->name,
    ]);
})->with([
    [fn () => DomainCorrect::factory()->state(['name' => null])->make(), 'Missing name'],
]);

it('can render the edit page', function () {
    $domain = DomainCorrect::factory()->create(['name' => 'gmail.com']);

    $this->get(DomainCorrectResource::getUrl('edit', ['record' => $domain]))->assertOk();
});

it('can retrieve data in edit page', function () {
    $domain = DomainCorrect::factory()->create();

    $this->livewire(EditDomainCorrect::class, [
        'record' => $domain->getRouteKey(),
    ])
        ->assertFormSet([
            'id' => $domain->getKey(),
            'name' => $domain->name,
        ]);
});

it('can update the domain correct', function () {
    $domain = DomainCorrect::factory()->create();
    $newDomain = DomainCorrect::factory()
        ->state([
            'name' => fake()->domainName(),
        ])->make();

    Livewire::test(EditDomainCorrect::class, [
        'record' => $domain->getRouteKey(),
    ])
        ->fillForm([
            'name' => $newDomain->name,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($domain->refresh())
        ->name->toBe($newDomain->name);
});

it('can validate form errors on edit', function (DomainCorrect $updateDomain) {
    $domain = DomainCorrect::factory()->create();

    Livewire::test(EditDomainCorrect::class, [
        'record' => $domain->getRouteKey(),
    ])
        ->fillForm([
            'name' => $updateDomain->name,
        ])
        ->call('save')
        ->assertHasFormErrors();
})->with([
    [fn () => DomainCorrect::factory()->state(['name' => null])->make(), 'Missing name'],
]);

it('can list domain corrects', function () {
    $domain = DomainCorrect::factory(3)->create();

    Livewire::test(DomainCorrectResource\Pages\ListDomainCorrects::class)
        ->assertCanSeeTableRecords($domain)
        ->assertSeeText([
            $domain[0]->name,

            $domain[1]->name,

            $domain[2]->name,
        ]);
});

it('can delete a domain from the edit domain form', function () {
    $domain = DomainCorrect::factory()->create();

    Livewire::test(EditDomainCorrect::class, [
        'record' => $domain->getRouteKey(),
    ])
        ->callAction(DeleteAction::class);

    $this->assertModelMissing($domain);
});

it('can render relation manager domains not correct', function () {
    $domain = DomainCorrect::factory()
        ->has(DomainNotCorrect::factory()->count(10), 'not_correct')
        ->create();

    $this->livewire(DomainCorrectResource\RelationManagers\NotCorrectRelationManager::class, [
        'ownerRecord' => $domain,
        'pageClass' => EditDomainCorrect::class,
    ])
        ->assertSuccessful();
});

it('can list relation manager domains not correct', function () {
    $domain = DomainCorrect::factory()
        ->has(DomainNotCorrect::factory()->count(10), 'not_correct')
        ->create();

    $this->livewire(DomainCorrectResource\RelationManagers\NotCorrectRelationManager::class, [
        'ownerRecord' => $domain,
        'pageClass' => EditDomainCorrect::class,
    ])
        ->assertCanSeeTableRecords($domain->not_correct);
});
