import Home from  './pages/Home';

import NotFound from './pages/NotFound';


export default{
    mode: 'history',
    /* linkActiveClassÃ§ insert CSS class */
    routes: [
        {
            path: '/',
            component: Home,
            name: "Home"
        },
        
        {
            path: '*',
            component: NotFound,
            name: "NotFound"
        },
    ]
}