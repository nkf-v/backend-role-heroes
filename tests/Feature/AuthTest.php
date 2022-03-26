<?php declare(strict_types=1);

namespace Tests\Feature;

use App\Modules\Users\Models\User;
use Tests\ApiTestCase;

class AuthTest extends ApiTestCase
{
    public function testLogin() : void
    {
        $this->call('POST', '/api/auth/login', ['login' => 'test.1', 'password' => 'qweqwe'])
            ->assertSuccessful()
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
            ]);
    }

    public function testRegister() : void
    {
        $newUser = [
            'login' => 'test.login',
            'password' => 'qweqwe',
            'password_confirmation' => 'qweqwe',
        ];

        $this->call('POST', '/api/auth/register', $newUser)
            ->assertSuccessful()
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
            ]);

        $this->login(User::whereLogin($newUser['login'])->first());
    }

    public function testLogout() : void
    {
        $this->login()->call('GET', '/api/logout')->assertSuccessful()->assertJsonStructure(['message']);
    }

    public function testRefresh() : void
    {
        $this->login();
        $this->get('/api/auth/refresh')->assertSuccessful();
    }

    public function testCheckAuth() : void
    {
        $this->assertResponseError(['user' => ['no_auth']], $this->get('/api/auth/check'));
        $this->login()->get('/api/auth/check')->assertSuccessful();
    }
}
