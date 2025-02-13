<?php


namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * Create a new category.
     *
     * @param array $data
     * @return Category
     */
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * Update an existing category.
     *
     * @param int $categoryId
     * @param array $data
     * @return Category
     */
    public function update(int $categoryId, array $data): Category
    {
        $category = $this->findById($categoryId);
        $category->update($data);
        return $category;
    }

    /**
     * Delete a category.
     *
     * @param int $categoryId
     * @return void
     */
    public function delete(int $categoryId): void
    {
        $category = $this->findById($categoryId);
        $category->delete();
    }

    /**
     * Find a category by ID.
     *
     * @param int $categoryId
     * @return Category
     */
    public function findById(int $categoryId): Category
    {
        return Category::findOrFail($categoryId);
    }
}
