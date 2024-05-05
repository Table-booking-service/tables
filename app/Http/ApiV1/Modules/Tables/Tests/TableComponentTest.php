<?php

use App\Http\ApiV1\Support\Tests\ApiV1ComponentTestCase;

use function Pest\Laravel\delete;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;

uses(ApiV1ComponentTestCase::class);
uses()->group('component');

test('GET http://localhost:8000/api/v1/tables 200', function () {
    getJson('http://localhost:8000/api/v1/tables')
        ->assertStatus(200);
});

test('GET http://localhost:8000/api/v1/tables 404', function () {
    getJson('http://localhost:8000/api/v1/tables')
        ->assertStatus(404);
});

test('POST http://localhost:8000/api/v1/tables 200', function () {
    postJson('http://localhost:8000/api/v1/tables')
        ->assertStatus(200);
});

test('POST http://localhost:8000/api/v1/tables 404', function () {
    postJson('http://localhost:8000/api/v1/tables')
        ->assertStatus(404);
});

test('GET http://localhost:8000/api/v1/tables/{id} 200', function () {
    getJson('http://localhost:8000/api/v1/tables/1')
        ->assertStatus(200);
});

test('GET http://localhost:8000/api/v1/tables/{id} 404', function () {
    getJson('http://localhost:8000/api/v1/tables/1000')
        ->assertStatus(404);
});

test('PUT http://localhost:8000/api/v1/tables/{id} 200', function () {
    putJson('http://localhost:8000/api/v1/tables/1')
        ->assertStatus(200);
});

test('PUT http://localhost:8000/api/v1/tables/{id} 404', function () {
    putJson('http://localhost:8000/api/v1/tables/1000')
        ->assertStatus(404);
});

test('DELETE http://localhost:8000/api/v1/tables/{id} 204', function () {
    delete('http://localhost:8000/api/v1/tables/1')
        ->assertStatus(204);
});

test('DELETE http://localhost:8000/api/v1/tables/{id} 404', function () {
    delete('http://localhost:8000/api/v1/tables/1000')
        ->assertStatus(404);
});
