const mode = {
  dark: 'Dark Mode',
  light: 'Light Mode',
};

const checkbox = document.getElementById('checkbox');

const theme = localStorage.getItem('theme');
document.body.classList.add(theme || null);
checkbox.checked = theme !== 'dark';

document.getElementById('label-mode').innerText = mode[theme || 'light'];

checkbox.addEventListener('change', () => {
  document.body.classList.toggle('dark');

  const theme = localStorage.getItem('theme');
  checkbox.checked = theme === 'dark';

  if (theme === 'dark') {
    localStorage.setItem('theme', '');
    document.getElementById('label-mode').innerText = mode.light;
  } else {
    localStorage.setItem('theme', 'dark');
    document.getElementById('label-mode').innerText = mode.dark;
  }
});

function handleClickMenu(e) {
  const navItem = document.querySelectorAll('.item-menu');
  navItem.forEach(function (v) {
    v.classList.remove('active');
  });
  e.closest('.item-menu').classList.add('active');
}

function alertBox() {
  alert("Fitur Ini Akan Segera Hadir");
}

const button = document.getElementsByClassName(".apply-project button btn-rounded");
button.addEventListener("click", function showInfo(){
  const x = document.getElementById("info");
    if(x.style.display == "none"){
        x.style.display = "block";
    }else{
        x.style.display = "none";
    }
 });