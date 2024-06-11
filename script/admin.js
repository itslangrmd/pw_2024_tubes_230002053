window.onload = function() {
    showTable('mobil');
};

function showTable(tableType) {
    var tables = document.querySelectorAll('.tabel');
    tables.forEach(function(table) {
        table.classList.add('hidden');
    });

    var tableToShow = document.getElementById(tableType + 'Table');
    tableToShow.classList.remove('hidden');
}


