<?php

namespace Tests\Unit;

use App\Models\TaskModel;
use CodeIgniter\Test\CIUnitTestCase;

class TaskModelTest extends CIUnitTestCase
{
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

    public function testInsertAndFindTask()
    {
        $model = new TaskModel();
        $data = [
            'title' => 'Unit Test Task',
            'description' => 'Testing insert and find',
            'status' => 'pending',
        ];
        $id = $model->insert($data);
        $this->assertIsInt($id);
        $task = $model->find($id);
        $this->assertEquals('Unit Test Task', $task['title']);
        $this->assertEquals('pending', $task['status']);
    }
} 