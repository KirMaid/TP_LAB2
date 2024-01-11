<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
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

    public function test_list_products()
    {
        $this->assertGuest();
        $user = User::factory()->create([
            'birthday' => Carbon::yesterday()
        ]);
        $this->actingAs($user);
        $response = $this->get(route('index'));
        $response->assertViewHas('products', function ($objects) {
            foreach ($objects as $object){
                if (!($object instanceof Product))
                    return false;
            }
            return true;
        });
    }

    public function test_discount_price_exists()
    {
        $user = User::factory()->create([
            'birthday' => Carbon::today()
        ]);
        $this->actingAs($user);
        $response = $this->get(route('index'));
        $response->assertViewHas('products', function ($objects) {
            foreach ($objects as $object){
                if (!($object instanceof Product))
                    return false;
                if (!isset($object->oldPrice))
                    return false;
            }
            return true;
        });
    }

    public function test_discount_price_not_exists()
    {
        $this->assertGuest();
        $response = $this->get(route('index'));
        $response->assertViewHas('products', function ($objects) {
            foreach ($objects as $object){
                if (!($object instanceof Product))
                    return false;
                if (isset($object->oldPrice))
                    return false;
            }
            return true;
        });
    }

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

/*public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            //'birthday' => '1971-01-11'
        ]);

        $this->assertAuthenticated();
    }*/
}

