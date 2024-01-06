<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductRequestTest extends TestCase
{
    public function test_guest_birthday(): void
    {
        $this->assertGuest();
        $response = $this->get(route('index'));
        $response->assertViewHas('isBirthday',false);
    }

    public function test_user_birthday_today(): void
    {
        $user = User::factory()->create([
            'birthday' => Carbon::today()
        ]);
        $this->actingAs($user);
        $response = $this->get(route('index'));
        $response->assertViewHas('isBirthday',true);
    }

    public function test_user_birthday_not_today(): void
    {
        $this->assertGuest();
        $user = User::factory()->create([
            'birthday' => Carbon::yesterday()
        ]);
        $this->actingAs($user);
        $response = $this->get(route('index'));
        $response->assertViewHas('isBirthday',false);
    }
}
