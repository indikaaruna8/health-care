import OrganizationIndexController from './OrganizationIndexController'
import OrganizationController from './OrganizationController'

const Organization = {
    OrganizationIndexController: Object.assign(OrganizationIndexController, OrganizationIndexController),
    OrganizationController: Object.assign(OrganizationController, OrganizationController),
}

export default Organization