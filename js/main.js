document.querySelector('#btn').addEventListener('click', function () {
    let choice=document.querySelector('#choice').value;

    fetch('http://localhost/rpc/api/NewRound.php?choice='+choice, {
    })
        .then(response => response.json())
        .then(json => {
            console.log(json)
        })
        .catch(error => console.log(error));
});