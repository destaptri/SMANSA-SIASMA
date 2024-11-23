// Ensure this code is in script.js
document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.querySelector('#togglePassword');
    const passwordField = document.querySelector('#password');

    console.log('Toggle Password Element:', togglePassword);
    console.log('Password Field Element:', passwordField);

    if (togglePassword && passwordField) {
        togglePassword.addEventListener('click', function () {

            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    } else {
        console.error('Toggle password or password field not found');
    }
});


// Pagination logic
let currentPage = 1;
const totalPages = 10; // You can dynamically set this based on data

// document.getElementById('totalPages').textContent = totalPages;

// // Event listeners for pagination buttons
// document.getElementById('prevPage').addEventListener('click', function () {
//     if (currentPage > 1) {
//         currentPage--;
//         document.getElementById('currentPage').value = currentPage;
//         loadTableData(currentPage);
//     }
// });

document.getElementById('nextPage').addEventListener('click', function () {
    if (currentPage < totalPages) {
        currentPage++;
        document.getElementById('currentPage').value = currentPage;
        loadTableData(currentPage);
    }
});

// Handle manual input for the page number
document.getElementById('currentPage').addEventListener('change', function () {
    const inputPage = parseInt(this.value);
    if (inputPage >= 1 && inputPage <= totalPages) {
        currentPage = inputPage;
        loadTableData(currentPage);
    } else {
        this.value = currentPage; // Reset if the input is invalid
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const btnEdit = document.getElementById("btn-edit");
    const btnSave = document.getElementById("btn-save");
    const btnCancel = document.getElementById("btn-cancel");
    const btnChangePhoto = document.getElementById("btn-change-photo");
    const biodataTableCells = document.querySelectorAll("#biodata-table td[data-key]");

    btnEdit.addEventListener("click", () => {
        // Aktifkan mode edit
        biodataTableCells.forEach(cell => {
            cell.setAttribute("contenteditable", "true");
            cell.classList.add("editable-cell"); // Tambahkan styling untuk sel editable (opsional)
        });
        btnEdit.classList.add("d-none");
        btnSave.classList.remove("d-none");
        btnCancel.classList.remove("d-none");
        btnChangePhoto.classList.remove("d-none");
    });

    btnCancel.addEventListener("click", () => {
        // Batalkan mode edit
        biodataTableCells.forEach(cell => {
            cell.setAttribute("contenteditable", "false");
            cell.classList.remove("editable-cell");
        });
        btnEdit.classList.remove("d-none");
        btnSave.classList.add("d-none");
        btnCancel.classList.add("d-none");
        btnChangePhoto.classList.add("d-none");
    });

    btnSave.addEventListener("click", () => {
        // Simpan data ke server (placeholder)
        const biodataData = {};
        biodataTableCells.forEach(cell => {
            const key = cell.getAttribute("data-key");
            const value = cell.textContent.trim();
            biodataData[key] = value; // Simpan data ke objek
        });

        console.log("Data yang disimpan:", biodataData);

        // Kembalikan ke mode non-edit
        btnCancel.click();
    });
});


console.log("Button Edit:", btnEdit);
console.log("Button Save:", btnSave);
console.log("Button Cancel:", btnCancel);
console.log("Table Cells:", biodataTableCells);

btnEdit.addEventListener("click", () => {
    console.log("Edit button clicked!");
});
