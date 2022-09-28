import { createWebHistory, createRouter } from 'vue-router';

import Home from '../pages/Home';
import Login from '../pages/Login';
import Register from '../pages/Register';
import Dashboard from '../pages/Dashboard';
import Patients from '../components/Patients';
import EditPatient from '../components/EditPatient';
import AddPatient from '../components/AddPatient';
import Visits from '../components/Visits';
import AddVisit from '../components/AddVisit';
import EditVisit from '../components/EditVisit';
import Perspections from '../components/Perspections';
import AddPerspection from '../components/AddPerspection';
import EditPerspection from '../components/EditPerspection';
import Tests from '../components/Tests';

import AddTest from '../components/AddTest';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'patients',
        path: '/patients',
        component: Patients
    },
    {
        name: 'addpatient',
        path: '/patients/add',
        component: AddPatient
    },
    {
        name: 'editpatient',
        path: '/patients/edit/:id',
        component: EditPatient
    },
    {
        name: 'visits',
        path: '/visits',
        component: Visits
    },
    {
        name: 'addvisit',
        path: '/visits/add',
        component: AddVisit
    },
    {
        name: 'editvisit',
        path: '/visits/edit/:id',
        component: EditVisit
    },
    {
        name: 'perspections',
        path: '/perspections',
        component: Perspections
    },
    {
        name: 'addperspection',
        path: '/perspections/add',
        component: AddPerspection
    },
    {
        name: 'editperspection',
        path: '/perspections/edit/:id',
        component: EditPerspection
    },
    {
        name: 'tests',
        path: '/tests',
        component: Tests
    },
   

    {
        name: 'addtest',
        path: '/tests/add',
        component: AddTest
    },
   
    

    
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;