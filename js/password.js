const passwordField = document.getElementById('password');
const togglePasswordButton = document.getElementById('togglePassword');

const confirmPasswordField = document.getElementById('confirm_password');
const toggleConfirmPasswordButton = document.getElementById('toggleConfirmPassword');

// Hàm để chuyển đổi hiển thị/ẩn mật khẩu
function togglePasswordVisibility(inputField, toggleButton) {
    const type = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
    inputField.setAttribute('type', type);

    // Đổi text nút giữa "Hiện" và "Ẩn"
    toggleButton.textContent = type === 'password' ? 'Hiện' : 'Ẩn';
}

// Gắn sự kiện click cho nút hiển thị/ẩn mật khẩu
togglePasswordButton.addEventListener('click', () => {
    togglePasswordVisibility(passwordField, togglePasswordButton);
});

toggleConfirmPasswordButton.addEventListener('click', () => {
    togglePasswordVisibility(confirmPasswordField, toggleConfirmPasswordButton);
});