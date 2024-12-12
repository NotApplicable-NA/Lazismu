import './bootstrap';
import 'flowbite';
import 'tailwindcss';

document.getElementById('dropdownNavbarLink').addEventListener('click', function(event) {
    const dropdown = document.getElementById('dropdownNavbar');
    if (dropdown.classList.contains('hidden') === false) {
        event.preventDefault(); // Mencegah redirect jika dropdown aktif
    }
});

const accButton = document.getElementById("acc");
        const tolakButton = document.getElementById("tolak");
        const formulirPengajuan = document.getElementById("formulirPengajuan");

        accButton.addEventListener("change", () => {
            if (accButton.checked) {
                formulirPengajuan.classList.remove("hidden");
            }
        });

        tolakButton.addEventListener("change", () => {
            if (tolakButton.checked) {
                formulirPengajuan.classList.add("hidden");
            }
        });
