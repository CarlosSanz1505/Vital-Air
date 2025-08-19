// --- Selección de elementos ---
const menuBtn = document.getElementById("menuBtn");
const accountModal = document.getElementById("accountModal");
const closeAccountModal = document.getElementById("closeAccountModal");

const openPasswordModal = document.getElementById("openPasswordModal");
const passwordModal = document.getElementById("passwordModal");
const closePasswordModal = document.getElementById("closePasswordModal");
const cancelPassword = document.getElementById("cancelPassword");
const savePasswordBtn = document.getElementById("savePassword");

// --- Funciones para mostrar/ocultar modales ---
function openModal(modal) {
modal.classList.add("show");
}

function closeModal(modal) {
modal.classList.remove("show");
}

// --- Eventos para modal de cuenta ---
menuBtn.addEventListener("click", () => openModal(accountModal));
closeAccountModal.addEventListener("click", () => closeModal(accountModal));

// --- Eventos para modal de contraseña ---
openPasswordModal.addEventListener("click", () => {
closeModal(accountModal);
openModal(passwordModal);
});

closePasswordModal.addEventListener("click", () => closeModal(passwordModal));
cancelPassword.addEventListener("click", () => closeModal(passwordModal));

savePasswordBtn.addEventListener("click", () => {
const newPass = document.getElementById("newPass").value;
const confirmPass = document.getElementById("confirmPass").value;

if (newPass.trim() === "" || confirmPass.trim() === "") {
    alert("Por favor complete ambos campos.");
    return;
}

if (newPass !== confirmPass) {
    alert("Las contraseñas no coinciden.");
    return;
}

alert("Contraseña actualizada con éxito ✅");
closeModal(passwordModal);
});

// --- Cerrar modal si se hace clic fuera del contenido ---
window.addEventListener("click", (event) => {
if (event.target === accountModal) {
    closeModal(accountModal);
}
if (event.target === passwordModal) {
    closeModal(passwordModal);
}
});
