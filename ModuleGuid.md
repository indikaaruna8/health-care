# Module Development Guide

## Overview

This project follows Domain Driven Design (DDD) and Clean Architecture principles.

Every business domain must be implemented as a self-contained module with:

- Controllers
- Requests
- Services
- Repositories
- Contracts (Interfaces)
- Models
- Migrations
- Service Providers

Dependencies must always point inward.

Controllers → Services → Repositories → Models

Controllers must never directly access repositories or models.

---

# Module Naming

Use singular business domain names.

Examples:

- Organization
- Patient
- Appointment
- AnthropometricMeasurement
- MedicalRecord

The module name is used consistently throughout all layers.

Example:

```text
AnthropometricMeasurement
```

---

# Required Directory Structure

```text
app/
├── Http/
│   ├── Controllers/
│   │   └── AnthropometricMeasurement/
│   │       ├── AnthropometricMeasurementController.php
│   │       └── AnthropometricMeasurementIndexController.php
│   │
│   └── Requests/
│       └── AnthropometricMeasurement/
│           ├── StoreAnthropometricMeasurementRequest.php
│           ├── UpdateAnthropometricMeasurementRequest.php
│           └── SearchAnthropometricMeasurementRequest.php
│
├── Models/
│   └── AnthropometricMeasurement.php
│
├── Repositories/
│   └── AnthropometricMeasurement/
│       ├── Contracts/
│       │   ├── AnthropometricMeasurementRepositoryInterface.php
│       │   └── AnthropometricMeasurementSearchRepositoryInterface.php
│       │
│       ├── AnthropometricMeasurementRepository.php
│       └── AnthropometricMeasurementSearchRepository.php
│
├── Services/
│   └── AnthropometricMeasurement/
│       ├── Contracts/
│       │   ├── AnthropometricMeasurementServiceInterface.php
│       │   └── AnthropometricMeasurementSearchServiceInterface.php
│       │
│       ├── AnthropometricMeasurementService.php
│       └── AnthropometricMeasurementSearchService.php
│
└── Providers/
    └── AnthropometricMeasurementServiceProvider.php
```

---

# Controller Rules

Controllers are responsible only for:

- Request validation
- Calling services
- Returning responses

Controllers must not:

- Execute business logic
- Access repositories directly
- Access models directly

---

## Write Controller

Handles:

- Create
- Update
- Delete

Location:

```php
App\Http\Controllers\AnthropometricMeasurement\AnthropometricMeasurementController
```

Example:

```php
class AnthropometricMeasurementController extends Controller
{
    use ApiResponder;

    public function __construct(
        private readonly AnthropometricMeasurementServiceInterface $service
    ) {
    }
}
```

---

## Read Controller

Handles:

- List
- Search
- View Details

Location:

```php
App\Http\Controllers\AnthropometricMeasurement\AnthropometricMeasurementIndexController
```

Example:

```php
class AnthropometricMeasurementIndexController extends Controller
{
    use ApiResponder;

    public function __construct(
        private readonly AnthropometricMeasurementSearchServiceInterface $service
    ) {
    }
}
```

---

# Request Classes

Every module must have dedicated Request classes.

Location:

```php
App\Http\Requests\AnthropometricMeasurement
```

Recommended:

```php
StoreAnthropometricMeasurementRequest
UpdateAnthropometricMeasurementRequest
SearchAnthropometricMeasurementRequest
```

Responsibilities:

- Authorization
- Validation
- Data normalization

No business logic.

---

# Service Layer

Services contain all business rules.

Location:

```php
App\Services\AnthropometricMeasurement
```

---

## Service Interface

```php
AnthropometricMeasurementServiceInterface
```

Responsibilities:

- Create
- Update
- Delete
- Domain workflows

---

## Search Service Interface

```php
AnthropometricMeasurementSearchServiceInterface
```

Responsibilities:

- Search
- List
- Pagination
- Filtering
- Sorting

---

# Repository Layer

Repositories handle data persistence.

Location:

```php
App\Repositories\AnthropometricMeasurement
```

Repositories are the only layer allowed to interact with Eloquent Models.

---

## Repository Interface

```php
AnthropometricMeasurementRepositoryInterface
```

Responsibilities:

- Create
- Update
- Delete
- Find

---

## Search Repository Interface

```php
AnthropometricMeasurementSearchRepositoryInterface
```

Responsibilities:

- Search
- Filter
- Paginate
- Sort

---

# Model Rules

Every module must contain a dedicated model.

Location:

```php
App\Models\AnthropometricMeasurement
```

Example:

```php
class AnthropometricMeasurement extends Model
{
    protected $fillable = [
        //
    ];
}
```

---

# Migration Rules

Every module must have at least one migration.

Naming convention:

```text
create_anthropometric_measurements_table
```

Migration requirements:

- Primary key
- Foreign keys
- Indexes
- Soft Deletes (if applicable)
- Timestamps

Example:

```php
$table->id();
$table->timestamps();
```

---

# Service Provider

Every module must register its dependencies.

Location:

```php
App\Providers\AnthropometricMeasurementServiceProvider
```

Example:

```php
class AnthropometricMeasurementServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            AnthropometricMeasurementRepositoryInterface::class,
            AnthropometricMeasurementRepository::class
        );

        $this->app->bind(
            AnthropometricMeasurementSearchRepositoryInterface::class,
            AnthropometricMeasurementSearchRepository::class
        );

        $this->app->bind(
            AnthropometricMeasurementServiceInterface::class,
            AnthropometricMeasurementService::class
        );

        $this->app->bind(
            AnthropometricMeasurementSearchServiceInterface::class,
            AnthropometricMeasurementSearchService::class
        );
    }
}
```

---

# Dependency Flow

Allowed:

```text
Controller
    ↓
Service
    ↓
Repository
    ↓
Model
```

Not Allowed:

```text
Controller → Repository
Controller → Model
Service → Controller
Repository → Service
```

---

# Naming Conventions

| Layer             | Convention                                |
| ----------------- | ----------------------------------------- |
| Model             | AnthropometricMeasurement                 |
| Controller        | AnthropometricMeasurementController       |
| Read Controller   | AnthropometricMeasurementIndexController  |
| Repository        | AnthropometricMeasurementRepository       |
| Search Repository | AnthropometricMeasurementSearchRepository |
| Service           | AnthropometricMeasurementService          |
| Search Service    | AnthropometricMeasurementSearchService    |
| Request           | StoreAnthropometricMeasurementRequest     |
| Provider          | AnthropometricMeasurementServiceProvider  |

---

# New Module Checklist

When creating a new module, ensure all of the following exist:

- [ ] Migration
- [ ] Model
- [ ] Repository Interface
- [ ] Repository
- [ ] Search Repository Interface
- [ ] Search Repository
- [ ] Service Interface
- [ ] Service
- [ ] Search Service Interface
- [ ] Search Service
- [ ] Write Controller
- [ ] Read Controller
- [ ] Request Classes
- [ ] Service Provider
- [ ] Routes
- [ ] Feature Tests
- [ ] API Documentation

A module is considered complete only when all checklist items are implemented.
