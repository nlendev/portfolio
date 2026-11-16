<?php

use App\Models\Project;
use Inertia\Testing\AssertableInertia as Assert;

test('a project page has Open Graph tags in the HTML', function () {
    Project::factory()->create([
        'title' => 'Météo Wavre',
        'slug' => 'meteo-wavre',
        'summary' => 'La météo heure par heure.',
        'cover_path' => 'images/meteo-wavre.jpg',
    ]);

    $this->get('/projets/meteo-wavre')
        ->assertSee('<meta property="og:title" content="Météo Wavre">', false)
        ->assertSee('<meta property="og:description" content="La météo heure par heure.">', false)
        ->assertSee('/storage/images/meteo-wavre.jpg', false);
        test('the legal notice page exists', function () {
    $this->get('/mentions-legales')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Legal'));
});

});
