<?php

namespace App\Repositories\Contracts;
use App\Models\Category;

interface CategoryRepositoryInterface
{
    /**
     * Create a category.
     *
     * @param array $data
     * @return Category
     */
    public function create(array $data): Category;

    /**
     * Update a category.
     *
     * @param int $categoryId
     * @param array $data
     * @return Category
     */
    public function update(int $categoryId, array $data): Category;

    /**
     * Delete a category.
     *
     * @param int $categoryId
     * @return void
     */
    public function delete(int $categoryId): void;

    /**
     * Find a category by ID.
     *
     * @param int $categoryId
     * @return Category
     */
    public function findById(int $categoryId): Category;
}
