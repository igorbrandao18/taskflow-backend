<?php

namespace Tests\Feature;

use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\CIUnitTestCase;

class TasksApiTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    protected function setUp(): void
    {
        parent::setUp();
        $db = db_connect();
        $db->query('CREATE TABLE IF NOT EXISTS db_tasks (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title VARCHAR(255),
            description TEXT,
            status VARCHAR(20),
            created_at DATETIME,
            updated_at DATETIME
        )');
    }

    public function testGetTasks()
    {
        $result = $this->call('get', '/tasks');
        $result->assertStatus(200);
        $result->assertHeader('Content-Type', 'application/json; charset=UTF-8');
    }

    public function testCreateTask()
    {
        $data = [
            'title' => 'Integration Test Task',
            'description' => 'Integration test',
            'status' => 'pending'
        ];
        $result = $this->call('post', '/tasks', $data);
        $result->assertStatus(201);
        $result->assertJSONFragment(['title' => 'Integration Test Task']);
    }
} 