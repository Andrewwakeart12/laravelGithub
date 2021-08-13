import ExampleComponent from './component/ExampleComponent';
import Comments from './component/Comments';
export const routes= [
    {
        path: '/',
        component: ExampleComponent,
        name:ExampleComponent
    },
    {
        path: '/',
        component: Comments,
        name:Comments
    }
]
