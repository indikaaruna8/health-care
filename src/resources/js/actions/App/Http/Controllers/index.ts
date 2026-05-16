import Settings from './Settings'
import Organization from './Organization'

const Controllers = {
    Settings: Object.assign(Settings, Settings),
    Organization: Object.assign(Organization, Organization),
}

export default Controllers