import {
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
        route: 'vendors:products:index',
        icon: mdiShopping,
        label: "Products"
    }
  ];
