<?php namespace Tests\Repositories;

use App\Models\Admissions;
use App\Repositories\AdmissionsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AdmissionsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AdmissionsRepository
     */
    protected $admissionsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->admissionsRepo = \App::make(AdmissionsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_admissions()
    {
        $admissions = factory(Admissions::class)->make()->toArray();

        $createdAdmissions = $this->admissionsRepo->create($admissions);

        $createdAdmissions = $createdAdmissions->toArray();
        $this->assertArrayHasKey('id', $createdAdmissions);
        $this->assertNotNull($createdAdmissions['id'], 'Created Admissions must have id specified');
        $this->assertNotNull(Admissions::find($createdAdmissions['id']), 'Admissions with given id must be in DB');
        $this->assertModelData($admissions, $createdAdmissions);
    }

    /**
     * @test read
     */
    public function test_read_admissions()
    {
        $admissions = factory(Admissions::class)->create();

        $dbAdmissions = $this->admissionsRepo->find($admissions->id);

        $dbAdmissions = $dbAdmissions->toArray();
        $this->assertModelData($admissions->toArray(), $dbAdmissions);
    }

    /**
     * @test update
     */
    public function test_update_admissions()
    {
        $admissions = factory(Admissions::class)->create();
        $fakeAdmissions = factory(Admissions::class)->make()->toArray();

        $updatedAdmissions = $this->admissionsRepo->update($fakeAdmissions, $admissions->id);

        $this->assertModelData($fakeAdmissions, $updatedAdmissions->toArray());
        $dbAdmissions = $this->admissionsRepo->find($admissions->id);
        $this->assertModelData($fakeAdmissions, $dbAdmissions->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_admissions()
    {
        $admissions = factory(Admissions::class)->create();

        $resp = $this->admissionsRepo->delete($admissions->id);

        $this->assertTrue($resp);
        $this->assertNull(Admissions::find($admissions->id), 'Admissions should not exist in DB');
    }
}
