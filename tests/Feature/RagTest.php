<?php
use Symfony\Component\HttpFoundation\Response;

uses(Tests\TestCase::class);

test('unauthenticated users cannot access the document index', function () {
    $response = $this->get('/api/document');

    $response->assertStatus(Response::HTTP_FOUND);
});

test('unauthenticated users cannot access the document upload endpoint', function () {
    $response = $this->post('/api/rag/upload');

    $response->assertStatus(Response::HTTP_FOUND);
});


test('unauthenticated users cannot access the document ask endpoint', function () {
    $response = $this->post('/api/rag/ask');

    $response->assertStatus(Response::HTTP_FOUND);
});
