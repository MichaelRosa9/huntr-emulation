import Home from  './pages/Home';

import NotFound from './pages/NotFound';


export default{
    mode: 'history',
    /* linkActiveClassç insert CSS class */
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