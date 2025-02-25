<?php


namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

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
        $data['user_id'] = auth()->id();
        if (empty($data['category_color']) || $data['category_color'] === '#000000') {
            $data['category_color'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        }

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

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Category::all();
    }

    /**
     * @param string $type
     * @return Collection
     */

    public function getCategoryByType(string $type): Collection
    {
        return Category::where('type', $type)->where('user_id', Auth::id())->get();
    }

    public function allIncomeCategories(): Collection
    {
        return Category::where('type', 'income')->get();
    }

    public function allExpenseCategories(): Collection
    {
        return Category::where('type', 'expense')->get();
    }
}
