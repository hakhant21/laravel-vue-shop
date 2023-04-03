import {
    mdiAccount,
    mdiLogout,
    mdiThemeLightDark,
  } from "@mdi/js";

  export default [
    {
      isCurrentUser: true,
      menu: [
        {
          icon: mdiAccount,
          label: "My Profile",
          route: "profile.edit",
        }
      ],
    },
    {
      icon: mdiThemeLightDark,
      label: "Light/Dark",
      isDesktopNoLabel: true,
      isToggleLightDark: true,
    },
    {
      icon: mdiLogout,
      label: "Log out",
      isDesktopNoLabel: true,
      isToggleLightDark: true,
      isLogout: true,
    },
  ];
