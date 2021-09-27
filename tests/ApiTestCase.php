<?php declare(strict_types=1);

namespace Tests;

use App\Models\User;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;

abstract class ApiTestCase extends BaseTestCase
{
    use DatabaseTransactions;

    protected $accessToken;
    static protected $countUser = 1;

    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    protected function getRandomUser() : User
    {
        return User::inRandomOrder()->first();
    }

    protected function login(?User $user = null)
    {
        $user = ($user === null) ? $this->getRandomUser() : $user;
        $response = $this->call('POST', '/api/auth/login', [
            'login' => $user->login,
            'password' => 'qweqwe',
        ])->assertStatus(200)->json();

        return $this->withHeaders(['Authorization' => sprintf('Brear %s', $response['access_token'])]);
    }

    protected function assertResponseError($expectedResponse, TestResponse $actualResponse, int $status = 500)
    {
        $actualErrors = $actualResponse->assertStatus($status)->json()['errors'];
        $isSuccess = true;
        foreach ($expectedResponse as $key => $errors)
            foreach ($errors as $keyError => $error)
                $isSuccess = $isSuccess && ($error === $actualErrors[$key][$keyError]['code']);
        $this->assertTrue($isSuccess);
    }
}
