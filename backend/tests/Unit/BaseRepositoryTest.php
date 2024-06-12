<?php

namespace Tests\Unit;

use App\Models\Talle;
use App\Core\BaseRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BaseRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new BaseRepository(new Talle(), request());
    }

    public function test_can_get_all_records()
    {
        Talle::factory()->count(3)->create();

        $result = $this->repository->all();

        $this->assertCount(3, $result);
    }

    public function test_can_get_records_with_filters()
    {
        $talles = Talle::factory()->count(3)->create();
        $descripcion = $talles->first()->descripcion;

        $result = $this->repository->get(['filter' => ['descripcion' => $descripcion]]);

        $this->assertCount(1, $result);
        $this->assertEquals($descripcion, $result->first()->descripcion);
    }

    public function test_can_create_a_record()
    {
        $data = [
            'descripcion' => 'TallePrueba',
        ];

        $result = $this->repository->create($data);

        $this->assertInstanceOf(Talle::class, $result);
        $this->assertEquals('TallePrueba', $result->descripcion);
        $this->assertModelExists($result);
    }

    public function test_can_update_a_record()
    {
        $talle = Talle::factory()->create(['descripcion' => 'OldTalle']);

        $data = ['descripcion' => 'NewTalle'];
        $result = $this->repository->update($talle->id, $data);

        $this->assertEquals('NewTalle', $result->descripcion);
        $this->assertDatabaseHas('talle', [
            'descripcion' => $result->descripcion 
        ]);
    }

    public function test_can_delete_a_record()
    {
        $talle = Talle::factory()->create();

        $result = $this->repository->delete($talle->id);

        $this->assertTrue($result);
        $this->assertSoftDeleted($talle);
    }

    public function test_can_find_a_record_by_id()
    {
        $talle = Talle::factory()->create();

        $result = $this->repository->find($talle->id);

        $this->assertEquals($talle->id, $result->id);
    }

    public function test_can_get_records_by_ids()
    {
        $talles = Talle::factory()->count(3)->create();
        $ids = $talles->pluck('id')->toArray();

        $result = $this->repository->getByIds($ids);

        $this->assertCount(3, $result);
    }
}