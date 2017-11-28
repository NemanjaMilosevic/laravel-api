<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


use App\Ad;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;



class AdsTest extends TestCase
{
    public function testsAdsAreCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'text' => 'Lorem',
            'type' => 'Ipsum',
        ];

        $this->json('POST', '/api/ads', $payload, $headers)
            ->assertStatus(200)
            ->assertJson(['id' => 1, 'text' => 'Lorem', 'type' => 'Ipsum']);
    }

    public function testsAdsAreUpdatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $ad = factory(Ad::class)->create([
            'text' => 'Ipsum',
            'type' => 'type1',
        ]);

        $payload = [
            'text' => 'Lorem',
            'type' => 'type2',
        ];

        $response = $this->json('PUT', '/api/ads/' . $ad->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([ 
                'id' => 1, 
                'text' => 'Lorem', 
                'type' => 'type2' 
            ]);
    }

    public function testsAdsAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $ad = factory(Ad::class)->create([
            'text' => 'First Ad text',
            'type' => 'type1',
        ]);

        $this->json('DELETE', '/api/ads/' . $ad->id, [], $headers)
            ->assertStatus(204);
    }

    public function testAdsAreListedCorrectly()
    {
        factory(Ad::class)->create([
            'text' => 'First Ad text',
            'type' => 'type1'
        ]);

        factory(Ad::class)->create([
            'text' => 'Second Ad text',
            'type' => 'type2'
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/ads', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                [ 'text' => 'First Ad text', 'type' => 'type1' ],
                [ 'text' => 'Second Ad text', 'type' => 'type2' ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'text', 'type', 'created_at', 'updated_at'],
            ]);
    }

}
