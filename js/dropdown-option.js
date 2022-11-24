function onLoad(kelas, kelas2) {
    var group1 = document.getElementById(kelas); // Yg mau di show
    group1.classList.remove('hide');
    group1.classList.add('show');
    
    var group2 = document.getElementById(kelas2); // Yg mau di hide
    group2.classList.remove('show');
    group2.classList.add('hide');
}