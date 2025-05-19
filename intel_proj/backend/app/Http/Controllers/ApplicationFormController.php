<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicationForm;

class ApplicationFormController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('paginate', 10);
        $query = ApplicationForm::query();

        // ✅ Filter by ID if provided
        if ($request->filled('id')) {
            $query->where('id', $request->input('id'));
        }

        // ✅ Filtering logic
        if ($request->filled('filters')) {
            $allowedFilters = ['name', 'email', 'course'];
            $filters = explode(',', $request->input('filters'));

            foreach ($filters as $filter) {
                if (preg_match('/^(\w+)\s+like\s+"?([^"]+)"?$/i', trim($filter), $matches)) {
                    [$full, $field, $value] = $matches;
                    if (in_array($field, $allowedFilters)) {
                        $query->where($field, 'LIKE', "%{$value}%");
                    }
                }
            }
        }

        // ✅ Sorting logic
        $sortKey = $request->input('sortKey', 'name');
        $sortOrder = $request->input('sortOrder', 'asc');
        $query->orderBy($sortKey, $sortOrder);

        // ✅ Pagination
        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'course' => 'required|string|max:255',
        ]);

        $application = ApplicationForm::create($request->only('name', 'email', 'course'));
        return response()->json($application, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email',
            'course' => 'sometimes|required|string|max:255',
        ]);

        $application = ApplicationForm::findOrFail($id);
        $application->update($request->only('name', 'email', 'course'));
        return response()->json($application, 200);
    }

    public function destroy($id)
    {
        ApplicationForm::destroy($id);
        return response()->json(null, 204);
    }
}

