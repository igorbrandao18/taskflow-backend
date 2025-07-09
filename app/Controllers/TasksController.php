<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class TasksController extends ResourceController
{
    /**
     * Handle CORS preflight requests
     *
     * @param int|string|null $id
     * @return ResponseInterface
     */
    public function options($id = null)
    {
        return $this->response
            ->setStatusCode(200)
            ->setHeader('Access-Control-Allow-Origin', '*')
            ->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->setHeader('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, Authorization, Accept, Origin, Access-Control-Request-Method, Access-Control-Request-Headers')
            ->setHeader('Access-Control-Max-Age', '86400');
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $model = new \App\Models\TaskModel();
        $tasks = $model->findAll();
        return $this->respond($tasks);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $model = new \App\Models\TaskModel();
        $data = $this->request->getJSON(true) ?? $this->request->getPost();
        if (!isset($data['title']) || !isset($data['status'])) {
            return $this->failValidationErrors('Title and status are required.');
        }
        $id = $model->insert([
            'title' => $data['title'],
            'description' => $data['description'] ?? '',
            'status' => $data['status'],
        ]);
        if ($id === false) {
            return $this->failServerError('Failed to create task.');
        }
        $task = $model->find($id);
        if (ENVIRONMENT === 'testing') {
            return $this->response
                ->setStatusCode(201)
                ->setContentType('application/json')
                ->setBody(json_encode($task));
        }
        return $this->response
            ->setStatusCode(201)
            ->setContentType('application/json')
            ->setJSON($task);
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $model = new \App\Models\TaskModel();
        $data = $this->request->getRawInput();
        if (empty($data)) {
            $data = $this->request->getJSON(true);
        }
        // Fallback: se $data tem só uma chave e ela é um JSON válido, decodifica
        if (is_array($data) && count($data) === 1) {
            $firstKey = array_keys($data)[0];
            $maybeJson = json_decode($firstKey, true);
            if (is_array($maybeJson)) {
                $data = $maybeJson;
            }
        }
        log_message('debug', 'Update Task Payload: ' . json_encode($data));
        if (!$model->find($id)) {
            return $this->failNotFound('Task not found.');
        }
        $updateData = array_intersect_key($data, array_flip(['title', 'description', 'status']));
        // Se $updateData ainda estiver vazio, tente decodificar o corpo bruto
        if (empty($updateData)) {
            $raw = $this->request->getBody();
            $decoded = json_decode($raw, true);
            if (is_array($decoded)) {
                $updateData = array_intersect_key($decoded, array_flip(['title', 'description', 'status']));
            }
        }
        if (empty($updateData)) {
            return $this->failValidationErrors('No valid fields to update.');
        }
        if (!$model->update($id, $updateData)) {
            return $this->failServerError('Failed to update task.');
        }
        $task = $model->find($id);
        return $this->respond($task);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $model = new \App\Models\TaskModel();
        if (!$model->find($id)) {
            return $this->failNotFound('Task not found.');
        }
        if (!$model->delete($id)) {
            return $this->failServerError('Failed to delete task.');
        }
        return $this->respondDeleted(['id' => $id]);
    }
}
