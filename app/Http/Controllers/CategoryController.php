<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }


    /**
     * @return Factory|View|Application
     */

    public function index(): Factory|Application|View
    {

        $categories = $this->categoryService->all();
        $activeMenu = 'categories';
        $title = get_translation('income_and_expense_categories');
        return view('admin.categories.index', compact('categories', 'activeMenu', 'title'));
    }


    /**
     * @param StoreCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $this->categoryService->create($request);
        notyf()->success(get_translation('new_category_added_successfully'));
        return redirect()->route('categories.index');
    }


    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function edit(Category $category): JsonResponse
    {
        return response()->json($category);
    }


    /**
     * @param UpdateCategoryRequest $request
     * @param int $categoryId
     * @return RedirectResponse
     */

    public function update(UpdateCategoryRequest $request, int $categoryId): RedirectResponse
    {
        $this->categoryService->update($request, $categoryId);
        notyf()->info(get_translation('category_updated_successfully'));
        return redirect()->route('categories.index');
    }

    /**
     * Delete a category.
     *
     * @param int $categoryId
     * @return JsonResponse
     */
    public function destroy(int $categoryId): JsonResponse
    {
        $this->categoryService->delete($categoryId);
        return response()->json(null, 204);
    }

    /**
     * Find a category by ID.
     *
     * @param int $categoryId
     * @return JsonResponse
     */
    public function show(int $categoryId): JsonResponse
    {
        $category = $this->categoryService->findById($categoryId);
        return response()->json($category, 200);
    }
}
