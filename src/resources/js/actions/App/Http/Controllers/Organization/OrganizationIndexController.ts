import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Organization\OrganizationIndexController::index
* @see app/Http/Controllers/Organization/OrganizationIndexController.php:21
* @route '/organization'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/organization',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Organization\OrganizationIndexController::index
* @see app/Http/Controllers/Organization/OrganizationIndexController.php:21
* @route '/organization'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Organization\OrganizationIndexController::index
* @see app/Http/Controllers/Organization/OrganizationIndexController.php:21
* @route '/organization'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Organization\OrganizationIndexController::index
* @see app/Http/Controllers/Organization/OrganizationIndexController.php:21
* @route '/organization'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Organization\OrganizationIndexController::search
* @see app/Http/Controllers/Organization/OrganizationIndexController.php:26
* @route '/organization/search'
*/
export const search = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: search.url(options),
    method: 'get',
})

search.definition = {
    methods: ["get","head"],
    url: '/organization/search',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Organization\OrganizationIndexController::search
* @see app/Http/Controllers/Organization/OrganizationIndexController.php:26
* @route '/organization/search'
*/
search.url = (options?: RouteQueryOptions) => {
    return search.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Organization\OrganizationIndexController::search
* @see app/Http/Controllers/Organization/OrganizationIndexController.php:26
* @route '/organization/search'
*/
search.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: search.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Organization\OrganizationIndexController::search
* @see app/Http/Controllers/Organization/OrganizationIndexController.php:26
* @route '/organization/search'
*/
search.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: search.url(options),
    method: 'head',
})

const OrganizationIndexController = { index, search }

export default OrganizationIndexController