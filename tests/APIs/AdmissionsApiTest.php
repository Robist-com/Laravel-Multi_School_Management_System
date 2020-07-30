<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Admissions;

class AdmissionsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_admissions()
    {
        $admissions = factory(Admissions::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admissions', $admissions
        );

        $this->assertApiResponse($admissions);
    }

    /**
     * @test
     */
    public function test_read_admissions()
    {
        $admissions = factory(Admissions::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/admissions/'.$admissions->id
        );

        $this->assertApiResponse($admissions->toArray());
    }

    /**
     * @test
     */
    public function test_update_admissions()
    {
        $admissions = factory(Admissions::class)->create();
        $editedAdmissions = factory(Admissions::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admissions/'.$admissions->id,
            $editedAdmissions
        );

        $this->assertApiResponse($editedAdmissions);
    }

    /**
     * @test
     */
    public function test_delete_admissions()
    {
        $admissions = factory(Admissions::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admissions/'.$admissions->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admissions/'.$admissions->id
        );

        $this->response->assertStatus(404);
    }
}
