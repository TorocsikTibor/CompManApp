<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class CompetitionTest extends TestCase
{
    use DatabaseTransactions;

    public function testCompetitionCreate_Successful(): void
    {
        $user = User::factory()->create();

        $competitionDate = new \DateTimeImmutable();
        $expectedResult = [
            'name' => 'test',
            'date' => $competitionDate->format("Y-m-d"),
        ];

        $response = $this->actingAs($user)->postJson('/competition/create', $expectedResult);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Competition created successfully', 'status' => 201]);
        $this->assertDatabaseHas('competitions', $expectedResult);
    }

    public function testCompetitionCreateValidation_Fail(): void
    {
        $user = User::factory()->create();

        $expectedResult = [
            'name' => 'test',
            'date' => '2020-10-10',
        ];

        $response = $this->actingAs($user)->postJson('/competition/create', $expectedResult);
        $response->assertStatus(200);
        $response->assertJson(['status' => 400]);
        $response->assertInvalid(['date']);
    }

    public function testCompetitionDelete_Success(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->deleteJson('/competition/delete/10');
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'success',
            'status' => 200,
        ]);
    }
}
