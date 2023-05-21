<html>
<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
body {
    margin-top: 20px;
}
@media print {
  #submit {
    display: none;
  }
}
</style>
</head>
<body>
<div class="container" id="download">
    <div class="row">
      <div style="text-align:center;">
        <h2 >Seventh Day Adventist School</h2>
        <span>(Manage by Metas of SDA) Affiliated by CISCE,New Delhi(JH076)</span>
        <p>Bariyatu Road, Ranchi-834009| Ph.:0651-2541829,(+91) 9199440352</p>
      </div>
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <strong>{{$receipt[0]->billing_address}}</strong>
                        <br>
                        {{$receipt[0]->billing_city}}, {{$receipt[0]->billing_state}} {{$receipt[0]->billing_zip}}
                        <br>
                        {{$receipt[0]->billing_country}}
                        <br>
                        <abbr title="Phone">P:</abbr> {{$receipt[0]->billing_tel}}
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Date: {{$receipt[0]->trans_date}}</em>
                    </p>
                    <p>
                        <em>Receipt #: {{$receipt[0]->order_id}}</em>
                    </p>
                    <p>
                        <em><b>Status : {{$receipt[0]->order_status}}</b></em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h1>Receipt</h1>
                </div>
                </span>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name  </th>
                            <th style="text-align: center">#</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-6"><em>Admission Form Fee</em></h4></td>
                            <td class="col-md-2" style="text-align: center"> {{$receipt[0]->order_id}} </td>
                            <td class="col-md-2 text-center">&#x20B9; {{$receipt[0]->amt}}</td>
                            <td class="col-md-2 text-center">&#x20B9; {{$receipt[0]->amt}}</td>
                        </tr>

                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right"><h4><strong>Total: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong>&#x20B9; {{$receipt[0]->amt}}</strong></h4></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" id="submit" class="btn btn-success btn-block"  onclick="window.print()">
                    Print Receipt   <span class="glyphicon glyphicon-chevron-right"></span>
                </button></td>
            </div>
        </div>
    </div>
   
    <script>
function printDiv()
{

  var divToPrint=document.getElementById('download');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}


    $(document).ready(function(){




        $("#submit").click(function(){

        });
    });
    </script>
    </body>
</html>