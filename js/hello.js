// MÔN HỌC
function toggleDropdown(id) {
    var dropdown = document.getElementById(id); // Lấy phần tử dropdown theo id

    // Kiểm tra nếu dropdown đang hiển thị, ẩn nó
    if (dropdown.style.display === "block") {
        dropdown.style.display = "none";
    } else {
        // Nếu không, hiển thị dropdown
        dropdown.style.display = "block";
    }
}

// USER
// Hiển thị/Ẩn menu khi nhấn vào ảnh
const userPic = document.getElementById('userPic');
const subMenu = document.getElementById('subMenu');

userPic.addEventListener('click', () => {
    subMenu.classList.toggle('show');
});

// Ẩn menu nếu nhấn ra ngoài
document.addEventListener('click', (e) => {
    if (!subMenu.contains(e.target) && !userPic.contains(e.target)) {
        subMenu.classList.remove('show');
    }
});