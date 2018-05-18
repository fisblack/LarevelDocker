<?php

namespace SenseBook\Repositories;

use SenseBook\Models\ContactUs;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContactUsRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new ContactUs();
    }
    /**
     * Get model instant
     * @return \SenseBook\ContactUs
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Get all records
     * @return mixed
     */
    public function all()
    {
        return $this->model->withTrashed()->get();
    }

    /**
     * Create ContactUs
     *
     * @param $data
     *
     * @return \SenseBook\ContactUs
     */
    public function create($data)
    {
        $model = $this->model;

        return $model->create($data);
    }

    /**
     * Update data
     *
     * @param $id
     * @param $data
     *
     * @return bool
     */
    public function update($id, $data)
    {
        $contactUs = $this->findById($id);

        return $contactUs->update($data);
    }

    /**
     * @param $id
     *
     * @return \SenseBook\ContactUs
     */
    public function findById($id)
    {
        $model = $this->model->withTrashed()->where('id', $id)->first();

        if (!$model) {
            throw new ModelNotFoundException();
        }

        return $model;
    }

    /**
     * @param $id
     * @param bool $force
     *
     * @return bool|null
     */
    public function delete($id)
    {
        $contactUs = $this->findById($id);

        if ($contactUs->trashed()) {
            return $contactUs->forceDelete();
        }

        return $contactUs->delete();
    }

    /**
     * Restore data from soft delete
     *
     * @param $id
     *
     * @return bool|null
     */
    public function restore($id)
    {
        $contactUs = $this->findById($id);

        return $contactUs->restore();
    }
}
