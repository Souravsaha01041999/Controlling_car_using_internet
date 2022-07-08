<?php
$v=$_GET['id'];
?>
<html>
    <head>
        <title>
            REMOTE
        </title>
         <script type="text/javascript" src="https://souravsaha1234.000webhostapp.com/graphs/meter_support.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['gauge']});
    google.charts.setOnLoadCallback(drawGauge);

    var gaugeOptions = {min: 0, max: 255, yellowFrom: 180, yellowTo: 230,
      redFrom: 230, redTo: 255, minorTicks: 20};
    var gauge;

    function drawGauge() {
      gaugeData = new google.visualization.DataTable();
      gaugeData.addColumn('number', 'Speed');
      gaugeData.addRows(1);
      gaugeData.setCell(0, 0, 0);

      gauge = new google.visualization.Gauge(document.getElementById('gauge_div'));
      gauge.draw(gaugeData, gaugeOptions);
    }

    function changeTemp() {
        var dir=document.getElementById("cng");
      gaugeData.setValue(0, 0, dir.value );
      gauge.draw(gaugeData, gaugeOptions);
      trg(dir.value);
    }
  </script>
    </head>
    <body bgcolor="yellow">
        <center>
            <style>
            input[type=range] {
  height: 26px;
  -webkit-appearance: none;
  margin: 10px 0;
  width: 100%;
}
input[type=range]:focus {
  outline: none;
}
input[type=range]::-webkit-slider-runnable-track {
  width: 100%;
  height: 40px;
  cursor: pointer;
  animate: 0.2s;
  box-shadow: 0px 0px 0px #000000;
  background: #AC51B5;
  border-radius: 25px;
  border: 0px solid #000101;
}
input[type=range]::-webkit-slider-thumb {
  box-shadow: 0px 0px 0px #000000;
  border: 0px solid #000000;
  height: 40px;
  width: 50px;
  border-radius: 20px;
  background: #5DDEF8;
  cursor: pointer;
  -webkit-appearance: none;
  margin-top: -3.5px;
}
input[type=range]:focus::-webkit-slider-runnable-track {
  background: #AC51B5;
}
input[type=range]::-moz-range-track {
  width: 100%;
  height: 13px;
  cursor: pointer;
  animate: 0.2s;
  box-shadow: 0px 0px 0px #000000;
  background: #AC51B5;
  border-radius: 25px;
  border: 0px solid #000101;
}
input[type=range]::-moz-range-thumb {
  box-shadow: 0px 0px 0px #000000;
  border: 0px solid #000000;
  height: 20px;
  width: 39px;
  border-radius: 7px;
  background: #65001C;
  cursor: pointer;
}
input[type=range]::-ms-track {
  width: 100%;
  height: 13px;
  cursor: pointer;
  animate: 0.2s;
  background: transparent;
  border-color: transparent;
  color: transparent;
}
input[type=range]::-ms-fill-lower {
  background: #AC51B5;
  border: 0px solid #000101;
  border-radius: 50px;
  box-shadow: 0px 0px 0px #000000;
}
input[type=range]::-ms-fill-upper {
  background: #AC51B5;
  border: 0px solid #000101;
  border-radius: 50px;
  box-shadow: 0px 0px 0px #000000;
}
input[type=range]::-ms-thumb {
  margin-top: 1px;
  box-shadow: 0px 0px 0px #000000;
  border: 0px solid #000000;
  height: 20px;
  width: 39px;
  border-radius: 7px;
  background: #65001C;
  cursor: pointer;
}
input[type=range]:focus::-ms-fill-lower {
  background: #AC51B5;
}
input[type=range]:focus::-ms-fill-upper {
  background: #AC51B5;
}
            
            
            
                .button {
  padding: 40px 40px;
  font-size: 35px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #FF0000;
  background-color: #C8C7C9;
  border: none;
  border-radius: 40px;
  box-shadow: 0 35px #999;
}

.button:hover {background-color: #C8C7C9;}

.button:active {
  background-color: #C8C7C9;
  box-shadow: 0 3px #666;
  transform: translateY(35px);
}
            </style>
            <p id="uid"><?php echo $v; ?></p>
            <p id="show"></p><br><br>
            
            <table width="50%">
                <tr>
                    <th align="center">
                        <h1>Light1: </h1>
                    </th>
                    <th align="left">
                        <button onclick="trg('a')" class="button"><b>ON</b></button>
                        <br><br><br><br><br><br>
                    </th>
                    <th align="right">
                        <button onclick="trg('b')" class="button"><b>OFF</b></button>
                        <br><br><br><br><br><br>
                    </th>
                </tr>
                <tr>
                    <th align="center">
                        <h1>Light2: </h1>
                    </th>
                    <th align="left">
                        <button onclick="trg('c')" class="button"><b>ON</b></button>
                    </th>
                    <th align="right">
                        <button onclick="trg('d')" class="button"><b>OFF</b></button>
                    </th>
                </tr>
            </table>
            <br><br><br>
            <div id="gauge_div" style="width:450px; height: 250;"></div>
            <br><br>
            <input type="range" min="0" max="255" id="cng" value="0" onmouseup="changeTemp()" ontouchend="changeTemp()" style="width: 800px;" class="demoinput">
            
            
                
            
        </center>
        <script>
        var id=document.getElementById("uid").innerHTML;
        var sh=document.getElementById("show");
            function trg(data)
            {
                sh.innerHTML="Please Wait...";
                var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200) {
        
        sh.innerHTML=this.responseText;
        if(this.responseText=="0")
        {
            alert("USER NOT FOUND");
            sh.innerHTML="";
        }
        else
        {
            sh.innerHTML="Done!";
        }
    }
  };
  xhttp.open("POST", "setdata.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("id_in="+id+"&cm="+data);
            }
        </script>
    </body>
</html>