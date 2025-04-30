function data() {
  function getThemeFromLocalStorage() {
    if (window.localStorage.getItem('theme')) {
      return window.localStorage.getItem('theme') === 'dark';
    }
    return (
      !!window.matchMedia &&
      window.matchMedia('(prefers-color-scheme: dark)').matches
    );
  }

  function setThemeToLocalStorage(isDark) {
    window.localStorage.setItem('theme', isDark ? 'dark' : 'light');
  }

  function applyTheme(isDark) {
    if (isDark) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  }

  // Inicializar tema al cargar
  const initialDark = getThemeFromLocalStorage();
  applyTheme(initialDark);

  return {
    dark: initialDark,
    toggleTheme() {
      this.dark = !this.dark;
      setThemeToLocalStorage(this.dark);
      applyTheme(this.dark);
    },
    isSideMenuOpen: false,
    toggleSideMenu() {
      this.isSideMenuOpen = !this.isSideMenuOpen;
    },
    closeSideMenu() {
      this.isSideMenuOpen = false;
    },
    isNotificationsMenuOpen: false,
    toggleNotificationsMenu() {
      this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen;
    },
    closeNotificationsMenu() {
      this.isNotificationsMenuOpen = false;
    },
    isProfileMenuOpen: false,
    toggleProfileMenu() {
      this.isProfileMenuOpen = !this.isProfileMenuOpen;
    },
    closeProfileMenu() {
      this.isProfileMenuOpen = false;
    },
    isPagesMenuOpen: false,
    togglePagesMenu() {
      this.isPagesMenuOpen = !this.isPagesMenuOpen;
    },
    // Modal
    isModalOpen: false,
    trapCleanup: null,
    openModal() {
      this.isModalOpen = true;
      this.trapCleanup = focusTrap(document.querySelector('#modal'));
    },
    closeModal() {
      this.isModalOpen = false;
      this.trapCleanup();
    },
  };
}