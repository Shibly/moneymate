<?php


namespace App\Services;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * @return Collection
     */

    public function all(): Collection
    {
        return $this->categoryRepository->all();
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

    public function allIncomes(): Collection
    {
        return $this->categoryRepository->allIncomeCategories();
    }


    public function allExpenses(): Collection
    {
        return $this->categoryRepository->allExpenseCategories();
    }

}
