// awal fungsi password untuk admin
const password = "admin";

function promptForPassword() {
  const input = prompt("Verifikasi Kode Akses:");

  if (input !== password) {
    alert("Password Salah!");
    window.history.back();
  }
}

window.onload = function () {
  promptForPassword();
};
// akhir fungsi password untuk admin
