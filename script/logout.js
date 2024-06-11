document.getElementById('logout').addEventListener('click', function(e) {
    e.preventDefault();
    
    var confirmation = confirm('Apakah Anda yakin ingin logout?');
    
    if (confirmation) {
        window.location.href = 'logout.php';
    }
});