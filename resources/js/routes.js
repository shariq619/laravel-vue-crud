import NotFound from './components/NotFound';
import Home from './components/Home';
import Dashboard from './components/Dashboard';
import Register from './components/Register';
import Login from './components/Login.vue';
import Ticket from './components/Ticket';

export default {
    mode: 'history',
    routes: [
        {
            path: '*',
            component: NotFound
        },
        {
            path: '/',
            component: Home,
            name: "Home"
        },
        {
            path: '/register',
            component: Register,
            name: "Register"
        },
        {
            path: '/login',
            component: Login,
            name: "Login"
        },
        {
            path: "/dashboard",
            name: "Dashboard",
            component: Dashboard,
           /* beforeEnter: (to, form, next) =>{
                axios.get('/api/athenticated').then(()=>{
                    next()
                }).catch(()=>{
                    return next({ name: 'Login'})
                })
            }*/

        },
        {
            path: '/ticket',
            component: Ticket,
            name: "Ticket"
        }
    ]
}
