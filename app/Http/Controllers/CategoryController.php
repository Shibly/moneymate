<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;

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
        return view('admin.categories.index');
    }

    /**
     * Create a new category.
     *
     * @param StoreCategoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = $this->categoryService->create($request);
        return response()->json($category, 201);
    }

    /**
     * Update an existing category.
     *
     * @param UpdateCategoryRequest $request
     * @param int $categoryId
     * @return JsonResponse
     */
    public function update(UpdateCategoryRequest $request, int $categoryId): JsonResponse
    {
        $category = $this->categoryService->update($request, $categoryId);
        return response()->json($category, 200);
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
