// Toggle sidebar untuk tampilan mobile
function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    if (sidebar.style.width === "250px") {
        sidebar.style.width = "0";
    } else {
        sidebar.style.width = "250px";
    }
}

// Ganti background color navbar saat scroll
window.onscroll = function() {
    const navbar = document.getElementById("navbar");
    if (window.pageYOffset > 50) { 
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
};


let currentSlide = 0;
const carouselWrapper = document.getElementById('carouselWrapper');
const totalSlides = document.querySelectorAll('.service-box').length;
let maxVisibleSlides = 3; // Default untuk  desktop

// Perbarui jumlah slide yang terlihat berdasarkan ukuran layar
function updateMaxVisibleSlides() {
    const screenWidth = window.innerWidth;

    if (screenWidth <= 768) {
        maxVisibleSlides = 1; // Mobile
    } else {
        maxVisibleSlides; // Desktop
    }
}

// Perbarui posisi carousel berdasarkan slide saat ini
function updateCarousel() {
    updateMaxVisibleSlides();
    const slideWidth = document.querySelector('.carousel-container').clientWidth / maxVisibleSlides;

    const maxSlideIndex = totalSlides - maxVisibleSlides;
    if (currentSlide > maxSlideIndex) {
        currentSlide = maxSlideIndex; //
    }

    carouselWrapper.style.transform = `translateX(-${slideWidth * currentSlide}px)`;
}

// Tombol Setelahnya
document.getElementById('nextBtn').addEventListener('click', function() {
    const maxSlideIndex = totalSlides - maxVisibleSlides;
    if (currentSlide < maxSlideIndex) {
        currentSlide++;
        updateCarousel();
    }
});

// Tombol sebelumnya
document.getElementById('prevBtn').addEventListener('click', function() {
    if (currentSlide > 0) {
        currentSlide--;
        updateCarousel();
    }
});

// Perbarui carousel pada pengubah ukuran jendela untuk menyesuaikan lebar slide
window.addEventListener('resize', updateCarousel);

updateCarousel();

// Accordion
document.querySelectorAll('.accordion-header').forEach(header => {
    header.addEventListener('click', function () {
        const content = this.nextElementSibling;
        const icon = this.querySelector('i');

        // Tutup semua konten lain
        document.querySelectorAll('.accordion-content').forEach(item => {
            if (item !== content) {
                item.classList.remove('open');
                item.style.maxHeight = null; // Menyembunyikan konten
                // Perbarui ikon untuk header yang ditutup
                const otherIcon = item.previousElementSibling.querySelector('i');
                otherIcon.classList.remove('fa-chevron-up'); // Ganti ikon
                otherIcon.classList.add('fa-chevron-down'); // Ganti ikon
            }
        });

        // Toggle antara menampilkan dan menyembunyikan konten
        if (content.classList.contains('open')) {
            content.classList.remove('open');
            content.style.maxHeight = null; // Menyembunyikan konten
            icon.classList.remove('fa-chevron-up'); // Ganti ikon
            icon.classList.add('fa-chevron-down'); // Ganti ikon
        } else {
            content.classList.add('open');
            content.style.maxHeight = content.scrollHeight + "px"; // Menampilkan konten
            icon.classList.remove('fa-chevron-down'); // Ganti ikon
            icon.classList.add('fa-chevron-up'); // Ganti ikon
        }
    });
});


document.getElementById("logo-trigger").addEventListener("click", function () {
    const body = document.body;
    const logoImg = document.getElementById("logo-img");
    const footerLogoImg = document.getElementById("footer-logo");

    // Cek apakah mode dark-mode sudah aktif atau belum
    if (!body.classList.contains("dark-mode")) {
        // Switch ke dark mode
        body.classList.add("dark-mode");
        logoImg.src = "assets/img/2.png";  // Ganti logo untuk dark mode
        footerLogoImg.src = "assets/img/2.png";  // Ganti juga logo di footer
    } else {
        // Switch ke light mode
        body.classList.remove("dark-mode");
        logoImg.src = "assets/img/1.png";  // Kembali ke logo light mode
        footerLogoImg.src = "assets/img/1.png";  // Kembali ke logo light mode di footer
    }
});
    
function showModal() {
    // Ambil nilai dari setiap input
    const name = document.getElementById('name').value;
    const phone = document.getElementById('phone').value;
    const address = document.getElementById('address').value;
    const service = document.getElementById('service').value;
    const weight = document.getElementById('weight').value;
    const pickup = document.getElementById('pickup').value;
    const note = document.getElementById('note').value;

    // Periksa apakah semua input wajib diisi
    if (!name || !phone || !address || !service || !weight || !pickup) {
        alert("Please fill in all required fields.");
        return; // Hentikan fungsi jika ada yang kosong
    }

    // Tampilkan isi modal jika semua input sudah terisi
    document.getElementById('modal-body').innerHTML = `
        <strong>Name :</strong> ${name} <br>
        <strong>Phone :</strong> ${phone} <br>
        <strong>Address :</strong> ${address} <br>
        <strong>Service :</strong> ${service} <br>
        <strong>Weight :</strong> ${weight} Kg <br>
        <strong>Pickup Date :</strong> ${pickup} <br>
        <strong>Note :</strong> ${note ? note : 'None'}
    `;

    document.getElementById('confirmationModal').style.display = 'block';
}


function closeModal() {
    document.getElementById('confirmationModal').style.display = 'none';
}

function submitForm() {
    document.getElementById('laundryForm').submit();
}