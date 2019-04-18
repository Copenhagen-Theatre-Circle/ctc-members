import ProjectBasics from './components/ProjectBasics';
import ProjectCast from './components/ProjectCast';
import ProjectCrew from './components/ProjectCrew';
import ProjectVideos from './components/ProjectVideos';
import ProjectPictures from './components/ProjectPictures';
import ProjectDocuments from './components/ProjectDocuments';
import ProjectTestimonies from './components/ProjectTestimonies';

export default {
    mode: 'history',
    linkActiveClass: 'is-active',
    routes:[
        {
            path: '/projects/:id/basics',
            component: ProjectBasics,
            name: 'basics'
        },
        {
            path: '/projects/:id/cast',
            component: ProjectCast,
            name: 'cast'
        },
        {
            path: '/projects/:id/crew',
            component: ProjectCrew,
            name: 'crew'
        },
        {
            path: '/projects/:id/videos',
            component: ProjectVideos,
            name: 'videos'
        },
        {
            path: '/projects/:id/pictures',
            component: ProjectPictures,
            name: 'pictures'
        },
        {
            path: '/projects/:id/documents',
            component: ProjectDocuments,
            name: 'documents'
        },
        {
            path: '/projects/:id/testimonies',
            component: ProjectTestimonies,
            name: 'testimonies'
        }
    ]
}
