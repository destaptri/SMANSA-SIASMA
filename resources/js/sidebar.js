// Add active class to the current menu item
document.querySelectorAll(".nav-link").forEach((link) => {
    link.addEventListener("click", function () {
      // Remove active class from all links
      document.querySelectorAll(".nav-link").forEach((item) => {
        item.classList.remove("active");
      });
  
      // Add active class to the clicked link
      this.classList.add("active");
    });
  });

  document.addEventListener("DOMContentLoaded", function () {
    console.log("Sidebar and session user dropdown loaded!");
  
    // Example: Logout confirmation
    document.querySelectorAll(".dropdown-item").forEach((item) => {
      item.addEventListener("click", function (e) {
        if (this.textContent.trim() === "Logout") {
          const confirmLogout = confirm("Apakah Anda yakin ingin logout?");
          if (!confirmLogout) e.preventDefault();
        }
      });
    });
  });
  
  document.addEventListener("DOMContentLoaded", () => {
    const navLinks = document.querySelectorAll(".nav-link");

    navLinks.forEach(link => {
        link.addEventListener("click", function() {
            // Hapus semua class active dari link
            navLinks.forEach(nav => nav.classList.remove("active"));

            // Tambahkan class active ke link yang diklik
            this.classList.add("active");
        });
    });
});

  
  
  