function showForm(formId, listItem) {
    document.querySelectorAll('.form-container').forEach(form => {
        form.style.display = 'none';
    });
    document.getElementById(formId).style.display = 'block';
    document.querySelectorAll('.list-group-item').forEach(item => {
        item.classList.remove('active');
    });
    listItem.classList.add('active');
}

document.addEventListener("DOMContentLoaded", function () {
    var modalTambahAnak = document.getElementById("modalTambahAnak");
    if (modalTambahAnak) {
        modalTambahAnak.addEventListener("shown.bs.modal", function () {
            console.log("Modal Tambah Anak terbuka!");
        });
    }
});



document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const activeTab = urlParams.get("tab");
    if (activeTab) {
        document.querySelectorAll(".nav-link").forEach(tab => {
            tab.classList.remove("active");
        });
        document.querySelectorAll(".tab-pane").forEach(tabPane => {
            tabPane.classList.remove("show", "active");
        });
        const selectedTab = document.getElementById(activeTab + "-tab");
        if (selectedTab) {
            selectedTab.classList.add("active");
            document.getElementById(activeTab).classList.add("show", "active");
        }
    }
});

document.getElementById("changePasswordForm").addEventListener("submit", function(event) {
event.preventDefault();
let newPassword = document.getElementById("new-password").value;
let confirmPassword = document.getElementById("confirm-password").value;
let errorMessage = document.getElementById("password-error");

if (newPassword !== confirmPassword) {
    errorMessage.style.display = "block";
} else {
    errorMessage.style.display = "none";
    alert("Password changed successfully!"); // Simulasi update password
    this.reset();
}
});

function showTab(event, tabId) {
event.preventDefault();
document.querySelectorAll('.tab-pane').forEach(tab => {
    tab.classList.remove('show', 'active');
});
document.getElementById(tabId).classList.add('show', 'active');

document.querySelectorAll('.nav-link').forEach(link => {
    link.classList.remove('active');
});
document.getElementById(tabId + '-tab').classList.add('active');
}