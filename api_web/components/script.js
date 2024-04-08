document.getElementById('dataForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Empêcher le rechargement de la page
    
    const inputData = document.getElementById('inputData').value;
    fetch('../index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `data=${inputData}`
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('response').innerText = data;
    })
    .catch(error => console.error('Error:', error));
});

