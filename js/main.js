let links = document.querySelectorAll("a");
for(let link of links) {
    link.addEventListener('click', function () {
        console.log(link.getAttribute('choice'));
        let choice=link.getAttribute('choice');

        fetch('http://localhost/rpc/api/NewRound.php?choice='+choice, {
        })
            .then(response => response.json())
            .then(json => {
                console.log(json);
                if (json.gewonnen === 'player') {
                    swal ( "Gewonnen" ,  "" ,  "success" )
                } else if (json.gewonnen === 'cpu') {
                    swal ( "Verloren" ,  "" ,  "error" )
                } else {
                    swal ( "Unentschieden" ,  "" ,  "warning" )
                }
                canvas();
            })
            .catch(error => console.log(error));
    })
}

$(document).ready( function () {
    var table = $('#myTable').DataTable();
    let ids = [];
    
    canvas();

    setInterval(() => {
        fetch('http://localhost/rpc/api/Statistik.php')
            .then(function (resp) {
                return resp.json();
            })
            .then(function (json) {
                for(let row_json of json.data) {
                    if (!ids.includes(row_json.id)) {
                        ids.push(row_json.id);
                        table.row.add( [
                            row_json.time,
                            row_json.winner
                        ] ).draw( false );
                    }
                }
            })
            .catch(function (error) {
                console.log(error)
            })

    }, 1000)
} );


function canvas(){
    fetch('http://localhost/rpc/api/Statistik.php')
        .then(function (resp) {
            return resp.json();
        })
        .then(function (json) {
            myChart.data.datasets[0].data[0] = findAmountElement(json.data, 'player');
            myChart.data.datasets[0].data[1] = findAmountElement(json.data, 'cpu');
            myChart.data.datasets[0].data[2] = findAmountElement(json.data, 'tie');

            myChart.update();
        })
        .catch(function (error) {
            console.log(error)
        })
}

function findAmountElement(json, item){
    let count = 0;

    for (let k of json){
        if (k.winner === null) continue;
        if (k.winner.toLowerCase() === item.toLowerCase()) {
            count++;
        }
    }
    return count;
}