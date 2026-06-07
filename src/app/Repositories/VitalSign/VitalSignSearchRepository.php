<?php

namespace App\Repositories\VitalSign;

use App\Models\VitalSign;
use App\Repositories\VitalSign\Contracts\VitalSignSearchRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class VitalSignSearchRepository implements VitalSignSearchRepositoryInterface
{
    public function __construct(
        private VitalSign $model
    ) {}

    public function search(
        ?string $search,
        int $page,
        array $filters
    ): LengthAwarePaginator {
        $query = $this->model->newQuery();

        // Apply filters
        if (!empty($filters['admission_id'])) {
            $query->where('admission_id', $filters['admission_id']);
        }

        if (!empty($filters['encounter_id'])) {
            $query->where('encounter_id', $filters['encounter_id']);
        }

        if (!empty($filters['date_from'])) {
            $query->whereDate('observation_at', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('observation_at', '<=', $filters['date_to']);
        }

        if (!empty($filters['recorded_by'])) {
            $query->where('recorded_by', $filters['recorded_by']);
        }

        // Search across relevant fields
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('respiratory_rate', 'like', "%{$search}%")
                  ->orWhere('spo2', 'like', "%{$search}%")
                  ->orWhere('systolic_bp', 'like', "%{$search}%")
                  ->orWhere('diastolic_bp', 'like', "%{$search}%")
                  ->orWhere('heart_rate', 'like', "%{$search}%")
                  ->orWhere('temperature', 'like', "%{$search}%");
            });
        }

        // Default sort by observation_at descending
        $query->orderBy('observation_at', 'desc');

        return $query->paginate(
            perPage: config('pagination.per_page', 15),
            page: $page
        );
    }
}
