import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../wayfinder'
/**
* @see \App\Http\Controllers\Organization\OrganizationController::index
* @see app/Http/Controllers/Organization/OrganizationController.php:21
* @route '/organization/list'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/organization/list',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Organization\OrganizationController::index
* @see app/Http/Controllers/Organization/OrganizationController.php:21
* @route '/organization/list'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Organization\OrganizationController::index
* @see app/Http/Controllers/Organization/OrganizationController.php:21
* @route '/organization/list'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Organization\OrganizationController::index
* @see app/Http/Controllers/Organization/OrganizationController.php:21
* @route '/organization/list'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

const organization = {
    index: Object.assign(index, index),
}

export default organization