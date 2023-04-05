import {
    mdiAccountMultiple,
    mdiMonitor,
    mdiShopping,
  } from "@mdi/js";

  export default [
    {
        route: "dashboard",
        icon: mdiMonitor,
        label: "Dashboard",
    },
    {
        route: 'users:index',
        icon: mdiAccountMultiple,
        label: "Users"
    },
    {
        route: 'vendors:products:index',
        icon: mdiShopping,
        label: "Products"
    },

  ];
