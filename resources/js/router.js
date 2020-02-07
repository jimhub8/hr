import Vue from 'vue'
import VueRouter from 'vue-router'


Vue.use(VueRouter)

// Settings
import myApp from './components/settings/app'
import myShift from './components/settings/shift'


import myDashboard from './components/dashboard'
import myUser from './components/users/'
import myLeave from './components/leave'
import myLeaveType from './components/leave/leave_type'
import myExpenses from './components/expenses'
import myAttendance from './components/attendance'
import myTasks from './components/tasks'
import myDepartments from './components/departments'
import myComplains from './components/complain'
import myPromotions from './components/promotion'
import myWarnings from './components/warning'
import myAnnouncement from './components/announcement'
import myTermination from './components/termination'

import myCalendar from './components/attendance/Calendar'
import myProfile from './components/users/profile'

const routes = [
    // Settings
    { path: '/app', component: myApp },
    { path: '/shift', component: myShift },


    { path: '/', component: myDashboard },
    { path: '/users', component: myUser },
    { path: '/leave', component: myLeave },
    { path: '/leave_type', component: myLeaveType },
    { path: '/expenses', component: myExpenses },
    { path: '/attendance', component: myAttendance },
    { path: '/tasks', component: myTasks },
    { path: '/departments', component: myDepartments },
    { path: '/promotions', component: myPromotions },
    { path: '/complains', component: myComplains },
    { path: '/warnings', component: myWarnings },
    { path: '/announcements', component: myAnnouncement },
    { path: '/profile', component: myProfile },
    { path: '/calendar', component: myCalendar },
    { path: '/termination', component: myTermination },

]

export default new VueRouter({ routes })
