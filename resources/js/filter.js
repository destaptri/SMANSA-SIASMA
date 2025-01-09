document.addEventListener('DOMContentLoaded', function() {
    const filterBtn = document.getElementById('dropdownFilterButton'); // Perbaikan: gunakan ID yang sesuai
    const filterMenu = document.getElementById('filterMenu');
    const applyBtn = document.getElementById('applyBtn');

    // Toggle dropdown when Filter By button is clicked
    filterBtn.addEventListener('click', function(e) {
        e.stopPropagation(); // Mencegah bubbling
        filterMenu.classList.toggle('show');
    });

    // Close dropdown only when Apply button is clicked
    applyBtn.addEventListener('click', function(e) {
        e.stopPropagation(); // Mencegah bubbling saat klik
        filterMenu.classList.remove('show');
    });

    // Prevent closing when clicking inside the dropdown
    filterMenu.addEventListener('click', function(e) {
        e.stopPropagation();
    });

    // Tutup dropdown jika klik di luar menu
    document.addEventListener('click', function() {
        filterMenu.classList.remove('show');
    });
});

