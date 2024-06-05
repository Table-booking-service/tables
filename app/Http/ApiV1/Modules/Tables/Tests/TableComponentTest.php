<?php

use App\Domain\Tables\Models\Table;
use App\Http\ApiV1\Modules\Tables\Tests\Factories\CreateRequestFactory;
use App\Http\ApiV1\Support\Tests\ApiV1ComponentTestCase;

use Ensi\TestFactories\FakerProvider;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\assertModelMissing;
use function Pest\Laravel\delete;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;

uses(ApiV1ComponentTestCase::class);
uses()->group('component');

test('GET http://localhost:8000/api/v1/tables 200', function () {
    $data = env('X_API_SECRET_DATA');
    $algo = env('X_API_SECRET_ALGORITHM');
    $key = env('X_API_SECRET_KEY');
    $iv = str_repeat('0', openssl_cipher_iv_length($algo));
    $value = openssl_encrypt($data, $algo, $key, 0, $iv);
    getJson('http://localhost:8000/api/v1/tables', ['X-API-SECRET' => $value])
        ->assertStatus(200);
});

test('GET http://localhost:8000/api/v1/tables 403', function () {
    getJson('http://localhost:8000/api/v1/tables', ['X-API-SECRET' => 'wrong'])
        ->assertStatus(403);
});

test('POST http://localhost:8000/api/v1/tables 201', function () {
    $data = env('X_API_SECRET_DATA');
    $algo = env('X_API_SECRET_ALGORITHM');
    $key = env('X_API_SECRET_KEY');
    $iv = str_repeat('0', openssl_cipher_iv_length($algo));
    $value = openssl_encrypt($data, $algo, $key, 0, $iv);

    $request = CreateRequestFactory::new()->make();

    postJson('http://localhost:8000/api/v1/tables', $request, ['X-API-SECRET' => $value])
        ->assertStatus(201);

    assertDatabaseHas((new Table())->getTable(), [
        'seats' => $request['seats'],
        'location' => $request['location'],
    ]);
});

test('POST http://localhost:8000/api/v1/tables 400', function () {
    $data = env('X_API_SECRET_DATA');
    $algo = env('X_API_SECRET_ALGORITHM');
    $key = env('X_API_SECRET_KEY');
    $iv = str_repeat('0', openssl_cipher_iv_length($algo));
    $value = openssl_encrypt($data, $algo, $key, 0, $iv);
    postJson('http://localhost:8000/api/v1/tables', ['seats' => -1, 'location' => 'test'], ['X-API-SECRET' => $value])
        ->assertStatus(400);
});

test('POST http://localhost:8000/api/v1/tables 403', function () {
    postJson('http://localhost:8000/api/v1/tables', ['seats' => 10, 'location' => 'test'], ['X-API-SECRET' => 'wrong'])
        ->assertStatus(403);
});

test('GET http://localhost:8000/api/v1/tables/{id} 200', function () {
    $data = env('X_API_SECRET_DATA');
    $algo = env('X_API_SECRET_ALGORITHM');
    $key = env('X_API_SECRET_KEY');
    $iv = str_repeat('0', openssl_cipher_iv_length($algo));
    $value = openssl_encrypt($data, $algo, $key, 0, $iv);
    getJson('http://localhost:8000/api/v1/tables/1', ['X-API-SECRET' => $value])
        ->assertJsonStructure(['data' => ['id', 'seats', 'location']])
        ->assertJsonPath('data.id', 1)
        ->assertStatus(200);
});

test('GET http://localhost:8000/api/v1/tables/{id} 403', function () {
    getJson('http://localhost:8000/api/v1/tables/1', ['X-API-SECRET' => 'wrong'])
        ->assertStatus(403);
});

test('GET http://localhost:8000/api/v1/tables/{id} 404', function () {
    $data = env('X_API_SECRET_DATA');
    $algo = env('X_API_SECRET_ALGORITHM');
    $key = env('X_API_SECRET_KEY');
    $iv = str_repeat('0', openssl_cipher_iv_length($algo));
    $value = openssl_encrypt($data, $algo, $key, 0, $iv);
    getJson('http://localhost:8000/api/v1/tables/1000', ['X-API-SECRET' => $value])
        ->assertStatus(404);
});

test('PUT http://localhost:8000/api/v1/tables/{id} 200', function () {
    $data = env('X_API_SECRET_DATA');
    $algo = env('X_API_SECRET_ALGORITHM');
    $key = env('X_API_SECRET_KEY');
    $iv = str_repeat('0', openssl_cipher_iv_length($algo));
    $value = openssl_encrypt($data, $algo, $key, 0, $iv);
    $model = App\Domain\Tables\Models\Table::factory()->create();
    $request = CreateRequestFactory::new()->make();
    putJson("http://localhost:8000/api/v1/tables/{$model->id}", $request, ['X-API-SECRET' => $value])
        ->assertStatus(200)
        ->assertJsonPath('data.location', $request['location']);

    assertDatabaseHas((new Table())->getTable(), [
        'id' => $model->id,
        'seats' => $request['seats'],
        'location' => $request['location'],
    ]);
});

test('PUT http://localhost:8000/api/v1/tables/{id} 400', function () {
    $data = env('X_API_SECRET_DATA');
    $algo = env('X_API_SECRET_ALGORITHM');
    $key = env('X_API_SECRET_KEY');
    $iv = str_repeat('0', openssl_cipher_iv_length($algo));
    $value = openssl_encrypt($data, $algo, $key, 0, $iv);
    putJson('http://localhost:8000/api/v1/tables/1', ['seats' => -1, 'location' => 'test'], ['X-API-SECRET' => $value])
        ->assertStatus(400);
});

test('PUT http://localhost:8000/api/v1/tables/{id} 403', function () {
    putJson('http://localhost:8000/api/v1/tables/1', ['seats' => 10, 'location' => 'test'], ['X-API-SECRET' => 'wrong'])
        ->assertStatus(403);
});

test('PUT http://localhost:8000/api/v1/tables/{id} 404', function () {
    $data = env('X_API_SECRET_DATA');
    $algo = env('X_API_SECRET_ALGORITHM');
    $key = env('X_API_SECRET_KEY');
    $iv = str_repeat('0', openssl_cipher_iv_length($algo));
    $value = openssl_encrypt($data, $algo, $key, 0, $iv);
    putJson('http://localhost:8000/api/v1/tables/1000', ['seats' => 10, 'location' => 'test'], ['X-API-SECRET' => $value])
        ->assertStatus(404);
});

test('DELETE http://localhost:8000/api/v1/tables/{id} 200', function () {
    $data = env('X_API_SECRET_DATA');
    $algo = env('X_API_SECRET_ALGORITHM');
    $key = env('X_API_SECRET_KEY');
    $iv = str_repeat('0', openssl_cipher_iv_length($algo));
    $value = openssl_encrypt($data, $algo, $key, 0, $iv);
    $model = App\Domain\Tables\Models\Table::factory()->create();
    delete("http://localhost:8000/api/v1/tables/{$model->id}", [], ['X-API-SECRET' => $value])
        ->assertStatus(200);
    assertModelMissing($model);
});

test('DELETE http://localhost:8000/api/v1/tables/{id} 403', function () {
    delete('http://localhost:8000/api/v1/tables/1', [], ['X-API-SECRET' => 'wrong'])
        ->assertStatus(403);
});

test('DELETE http://localhost:8000/api/v1/tables/{id} 404', function () {
    $data = env('X_API_SECRET_DATA');
    $algo = env('X_API_SECRET_ALGORITHM');
    $key = env('X_API_SECRET_KEY');
    $iv = str_repeat('0', openssl_cipher_iv_length($algo));
    $value = openssl_encrypt($data, $algo, $key, 0, $iv);
    delete('http://localhost:8000/api/v1/tables/1000', [], ['X-API-SECRET' => $value])
        ->assertStatus(404);
});
