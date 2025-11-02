// Keep header height in a CSS var and make sidebar sticky below it.
(function() {
  function setHeaderHeight() {
    const header = document.querySelector('.admin-header');
    const h = header ? header.getBoundingClientRect().height : 64;
    document.documentElement.style.setProperty('--admin-header-h', h + 'px');
  }
  setHeaderHeight();
  window.addEventListener('resize', setHeaderHeight);
  // Also when fonts/icons load
  window.addEventListener('load', setHeaderHeight);
})();