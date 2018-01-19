<?php

namespace EcommerceMobly\Domains\Products\Contracts;

interface FeatureRepositoryContract
{
    /**
     * Create Feature record.
     *
     * @param  array $data
     * @return mixed
     */
    public function create(array $data = []);

    /**
     * Update Feature record.
     *
     * @param  array $data
     * @param  $id
     * @return mixed
     */
    public function update($id, array $data = []);

    /**
     * Create pagination.
     *
     * @return mixed
     */
    public function paginate();

    /**
     * Find record.
     *
     * @param  string|int $id
     * @return \EcommerceMobly\Domains\Products\Models\Feature
     */
    public function find($id);
}