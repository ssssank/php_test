<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\{
    User,
    Label
};

class LabelControllerTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Label::factory()->count(10)->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.create'));
        $response->assertOk();
    }

    public function testEdit(): void
    {
        $label = Label::factory()->create();
        $response = $this->actingAs($this->user)->get(route('labels.edit', $label));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $data = Label::factory()->make()->only('name', 'description');
        $response = $this->actingAs($this->user)->post(route('labels.store', $data));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', (array) $data);
    }

    public function testUpdate(): void
    {
        $label = Label::factory()->create();
        $data = Label::factory()->make()->only('name', 'description');
        $response = $this->actingAs($this->user)->patch(route('labels.update', $label), (array) $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', (array) $data);
    }

    public function testDelete(): void
    {
        $label = Label::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('labels.destroy', $label));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('labels', ['id' => (array) $label['id']]);
    }
}
