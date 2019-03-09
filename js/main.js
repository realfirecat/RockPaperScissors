document.querySelector('#btn').addEventListener('click', function () {
    let choice=document.querySelector('#choice').value;

    fetch('http://localhost/rpc/api/NewRound.php?choice='+choice, {
    })
        .then(response => response.json())
        .then(json => {
            console.log(json);
            tableUpdate();
        })
        .catch(error => console.log(error));
});

$(document).ready( function () {
    tableUpdate();

    setInterval(function () {
        updateTime();
    }, 1000)
} );

let bufferTime = [];

function tableUpdate() {
    fetch('http://localhost/rpc/api/Statistik.php')
        .then(function (resp) {
            return resp.json();
        })
        .then(function (json) {
            $('#myTable').DataTable().clear().draw();

            bufferTime = [];

            json.data.forEach((item) => {
                let date = new Date(item.time);
                bufferTime.push(date);

                $('#myTable').dataTable().fnAddData( [
                    date,
                    item.winner
                ]);
            });

            updateTime();
        })
        .catch(function (error) {
            console.log(error)
        })
}


function updateTime() {
    let trs = document.getElementsByTagName('tr');
    for (let i = 1; i < trs.length; i++) {
        let date = new Date(bufferTime[i-1]);

        let diff = (new Date() - date)/1000;
        if(diff/60 >= 1 && diff/60 < 60){
            diff=Math.round(diff/60) + "min ago";
        } else if(diff/60/60 >= 1 && diff/60/60 < 24){
            diff=Math.round(diff/60/60) + "h ago";
        } else if(diff/60/60/24 >= 1){
            diff=(diff/60/60/24).toFixed(2) + "day(s) ago";
        } else {
            diff=Math.round(diff) + "sec ago";
        }
        trs[i].firstChild.innerHTML=diff;
    }
}