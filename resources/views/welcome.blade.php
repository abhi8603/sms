@extends('header')
@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">

@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    @if(Auth::user()->id==1)
    <!-- Main content -->
    <section class="content" style="min-height: 1509px !important;">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div style="border-radius: 15px 1px;" class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$student}}</h3>

              <p>Total Students</p>
            </div>
            <div class="icon">
              <i class="fa fa-fw fa-graduation-cap"></i>
            </div>
                  </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div style="border-radius: 15px 1px;" class="small-box bg-green">
            <div class="inner">
              <h3>{{$emp}}</h3>

              <p>Total Employees</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
           </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div style="border-radius: 15px 1px;" class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$course}}</h3>

              <p>Total Course/Class</p>
            </div>
            <div class="icon">
              <i class="fa fa-fw fa-book"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div style="border-radius: 15px 1px;" class="small-box bg-red">
            <div class="inner">
              <h3>{{$batch}}</h3>

              <p>Total Batch/Section</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>
        </div>
    <div class="row">
           <div class="col-md-12">
             <!-- AREA CHART -->
             <div class="box box-success">
               <div class="box-header with-border">
                 <h3 class="box-title">Fee Collection  ({{date('F - Y')}})</h3>

                 <div class="box-tools pull-right">
                   <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                   </button>
                   <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                 </div>
               </div>
               <div class="box-body">
                 <div class="col-md-12">
                     <div id="expense" style="width:100%; height:400px;"></div>
                 </div>
               </div>
               <!-- /.box-body -->
             </div>
           </div>
            <div class="col-md-12" >
                 <div class="box">
                   <div class="box-header">
                     <h3 class="box-title">Today Birthday's</h3>
                   </div>
                   <!-- /.box-header -->
                   <div class="table-responsive">
                   <div class="box-body">
                     <table id="example" class="table table-striped table-bordered display nowrap">
                       <thead>
                       <tr>
                         <th>#</th>
                         <th>Acadmic Year</th>
                         <th>Dob</th>
                         <th>Name</th>
                         <th>Roll No</th>
                         <th>Course Name</th>
                         <th>Batch</th>
                         <th>Gender</th>
                       </tr>
                       </thead>
                       <tbody>
                         @php $i=0; @endphp 
                         @foreach ($studentBirthdayList as $value)
                           <tr>
                             <td><?=++$i;?></td>
                             <td><?=$value['accdmic_year']!=""?$value['accdmic_year']:"N/A";?></td>
                             <td><?=$value['dob']!=""?$value['dob']:"N/A";?></td>
                             <td><?=$value['stu_name']!=""?$value['stu_name']:"N/A";?></td>
                             <td><?=$value['roll_no']!=""?$value['roll_no']:"N/A";?></td>
                             <td><?=$value['course_name']!=""?$value['course_name']:"N/A";?></td>
                             <td><?=$value['batch_name']!=""?$value['batch_name']:"N/A";?></td>
                             <td><?=$value['gender']!=""?$value['gender']:"N/A";?></td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                   </div>
                 </div>
                   <!-- /.box-body -->
                 </div>
                 <!-- /.box -->
               </div>
               
           </div>
           <div class="row">
           <div class=col-md-12>
           <div class=col-md-8>
             <div class="box">
                   <div class="box-header">
                     <h3 class="box-title">Upcoming Event</h3>
                   </div>
                   <!-- /.box-header -->
                   <div class="table-responsive">
                   <div class="box-body">
                     <table id="example" class="table table-striped table-bordered display nowrap">
                       <thead>
                       <tr>
                         <th>#</th>
                         <th>From Date</th>
                         <th>To Date</th>
                         <th>Event Type</th>
                         <th>Event Name</th>
                       </tr>
                       </thead>
                       <tbody>
                         @php $i=0; @endphp 
                         @foreach ($eventList as $value)
                           <tr>
                             <td><?=++$i;?></td>
                             <td><?=$value['from_date']!=""?date('d-m-Y',strtotime($value['from_date'])):"N/A";?></td>
                             <td><?=$value['to_date']!=""?date('d-m-Y',strtotime($value['to_date'])):"N/A";?></td>
                             <td><?=$value['event_type']!=""?$value['event_type']:"N/A";?></td>
                             <td><?=$value['event_name']!=""?$value['event_name']:"N/A";?></td>
                           </tr>
                           @endforeach
                        </tbody>

                     </table>
                   </div>
                 </div>
                   <!-- /.box-body -->
                 </div>
          </div>
        <div class="col-md-4">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">FEE COLLECTION OF THE DAY</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p>Total Collection (Today) :  {{$todaytotalfee}}</p>
              <p>Total Collection (Month) :  {{$monthtotalfee}}</p>
            </div>
            <!-- /.box-body -->
          </div>

          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Student Attendeance of the day</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p>Total Present (Today) :  {{$attendance[0]->present}}</p>
              <p>Total Absent (Today) :  {{$attendance[0]->absent}}</p>
            </div>
            <!-- /.box-body -->
          </div>

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Notice Board</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="min-height: 222px;">
            <ul>
            <li>
            <p>All Acadmic activity is Suspendended due to COVID-19</p>
            </li>
            </ul>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        </div>




        </div>
        <!-- /.col -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New To Do List</h4>
      </div>
      <div class="modal-body">
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

           </div>
            </div>

      </div>
    </section>
      @elseif(Auth::user()->user_role==6)
 <section id="other"  class="content" style="min-height: 1509px !important;">
   @include('teacherDashbord')
 </section>
  @else
  <section id="other"  class="content" style="min-height: 1509px !important;">


  </section>
    @endif
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
{{--External Style Section--}}
@section('script')
<!--<script src="http://code.jquery.com/jquery-1.10.2.min.js" integrity="sha256-C6CB9UYIS9UJeqinPHWTHVqh/E1uhG5Twh+Y5qFQmYg="
			  crossorigin="anonymous"></script>-->
<script src="{{ URL::asset('assets/dist/js/highcharts.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets\bower_components\datatables.net-bs\js\dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.rowReorder.min.js') }}"></script>

<script>
$(document).ready(function() {
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#example').DataTable( {

       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
         rowReorder: {
           selector: 'td:nth-child(2)'
       },
       responsive: true


   } );
   } );

</script>
<script>
    $(document).ready(function () {
        var get_expense = <?php echo $feecollection; ?>;
        var tot_days=<?php echo $d ; ?>;
      //  alert(tot_days);
        var i=1;
        var get_expense_days = [
         <?php for($i=1;$i<=$d;$i++)
            {
                if($i!=$d)
                echo "{ day: $i, val: [] },";
                else
                 echo "{ day: $i, val: [] }";
            }

            ?>
        ];
      //  var data=JSON.parse(get_expense_days);
    //  alert();
//alert(get_expense);
        get_expense.forEach( function( item ) {
//alert(item.date);
          get_expense_days[new Date(item.date).getDate()-1].val.push( Number(item.amt));

        });
//alert();


get_expense_days=get_expense_days.map( function( item ) {
//item.val = 0;
 if ( item.val.length > 0 ) {
                item.val = item.val.reduce(function(a) {
                    return a;
                });
            } else {
                item.val = 0;
            }
                return item;
            });
        var get_expense_months = get_expense_days.map(function(item){
            return item.day;
        });

        var get_expense_amounts = get_expense_days.map(function(item){
            return item.val;
        });

      var cc=  Highcharts.chart('expense', {
            chart: {
    type: 'line'
},

            title: {
                text: ''
            },

            credits: {
                enabled: false
            },

            xAxis: {
                categories: [<?php for($i=1;$i<=$d;$i++){echo "'".$i."'," ;} ?>]
            },

            yAxis: {
                title: {
                    text: 'Amount'
                }
            },
            plotOptions: {
                line: {
        dataLabels: {
            enabled: true
        },
        enableMouseTracking: true
    },


            },

            series: [{
                name: 'Fee Collection',
                data: get_expense_amounts

            }
            ]

        });


    });
</script>
@endsection
<!-- ./wrapper -->
