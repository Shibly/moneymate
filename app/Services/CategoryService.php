<?php


namespace App\Services;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Create a new category.
     *
     * @param StoreCategoryRequest $request
     * @return Category
     */
    public function create(StoreCategoryRequest $request): Category
    {
        $validatedData = $request->validated();
        return $this->categoryRepository->create($validatedData);
    }

    /**
     * Update an existing category.
     *
     * @param UpdateCategoryRequest $request
     * @param int $categoryId
     * @return Category
     */
    public function update(UpdateCategoryRequest $request, int $categoryId): Category
    {
        $validatedData = $request->validated();
        return $this->categoryRepository->update($categoryId, $validatedData);
    }

    /**
     * Delete a category by its ID.
     *
     * @param int $categoryId
     * @return void
     */
    public function delete(int $categoryId): void
    {
        $this->categoryRepository->delete($categoryId);
    }

    /**
     * Find a category by its ID.
     *
     * @param int $categoryId
     * @return Category
     */
    public function findById(int $categoryId): Category
    {
        return $this->categoryRepository->findById($categoryId);
    }
}
