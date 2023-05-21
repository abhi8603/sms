@extends('header')
@section('style')
<script type="text/javascript">
        function OnSelectionChange (select) {
            var selectedOption = select.options[select.selectedIndex];
            alert ("The selected option is " + selectedOption.value);
        }
    </script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="{{ URL::asset('assets/bower_components/select2/dist/css/select2.min.css') }}">

@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-dashboard"></i> Setting</a></li>
        <li class="active">Academic-Details</li>
      </ol>
    </section>
    <section class="content">
        @include('notification.notify')
  <div class="box box-default">
    <!-- Main content -->
    <div class="box-header with-border">
      <h3 class="box-title">Academic Year Details</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button style="display:none;" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>

        <div class="row">
          <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-8 offset-md-3">                        <!-- /.form-group -->
                        <div class="box box-primary">
                                 <div class="box-header with-border">
                                   <h3 class="box-title">View Academic Year</h3>
                                 </div>
                                 <!-- /.box-header -->
                                 <!-- form start -->
                                 <!--{{--<form role="form" method="post" enctype="multipart/form-data" action="{{url('Academic-Details/update')}}">--}}!-->
                                 <form role="form" method="post" enctype="multipart/form-data" action="{{url('Academic-session/update')}}">
                                   <div class="box-body">
                                     <div class="col-md-12">
                                       @foreach($academicyears as $academicyears)
									   
									   <!--{{-- <input type="text" name="id" value="{{$academicyears->startyear}}">--}}!-->
									    <input type="hidden" name="com_Id" value="{{$academicyears->startyear}}">
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">Start Year<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" name="startyear" id="mySelect" onchange="myFunction()" style="width: 100%;" required>
                                           <option value="" selected="selected">Select Year</option>
                                         @for ($i = 2015; $i <= 2030; $i++)
                                          <option value="{{ $i }}" @if($academicyears->startyear== $i) selected @endif>{{ $i }}</option>
                                            @endfor
                                    </select>
                                        </div>
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">Start Month<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" name="startmonth" style="width: 100%;" required>
                                           <option value="">Select Month</option>
                                           <option value="January" @if($academicyears->startmonth== "January") selected @endif>January</option>
                                           <option value="February" @if($academicyears->startmonth== "February") selected @endif>February</option>
                                           <option value="March" @if($academicyears->startmonth== "March") selected @endif>March</option>
                                           <option value="April" @if($academicyears->startmonth== "April") selected @endif>April</option>
                                           <option value="May" @if($academicyears->startmonth== "May") selected @endif>May</option>
                                           <option value="June" @if($academicyears->startmonth== "June") selected @endif>June</option>
                                           <option value="July" @if($academicyears->startmonth== "July") selected @endif>July</option>
                                           <option value="Augest" @if($academicyears->startmonth== "Augest") selected @endif>Augest</option>
                                           <option value="September" @if($academicyears->startmonth== "September") selected @endif>september</option>
                                           <option value="October" @if($academicyears->startmonth== "October") selected @endif>October</option>
                                           <option value="November" @if($academicyears->startmonth== "November") selected @endif>November</option>
                                           <option value="December" @if($academicyears->startmonth== "December") selected @endif>December</option>
                                    </select>
                                   </div>
								   
								   <script>
function myFunction() {
  var x = document.getElementById("mySelect").value;
  var z = +x + +1;
  document.getElementById("demo").value =z;
}
</script>
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">End Year<span style="color:red;"> *</span></label>
                                       <!--{{--<select class="form-control select2" name="endyear" style="width: 100%;" required>
                                           <option value="" selected="selected">Select Year</option>
                                           @for ($i = 2015; $i <= 2031; $i++)
                                            <option value="{{ $i }}" @if($academicyears->endyear== $i) selected @endif>{{ $i }}</option>
                                              @endfor
                                    </select>
									--}}!-->
									<input type="text" id="demo" name="endyear" readonly class="form-group">
                                    </div>
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">End Month<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" style="width: 100%;" name="endmonth" required>
                                         <option value="January" @if($academicyears->endmonth== "January") selected @endif>January</option>
                                         <option value="February" @if($academicyears->endmonth== "February") selected @endif>February</option>
                                         <option value="March" @if($academicyears->endmonth== "March") selected @endif>March</option>
                                         <option value="April" @if($academicyears->endmonth== "April") selected @endif>April</option>
                                         <option value="May" @if($academicyears->endmonth== "May") selected @endif>May</option>
                                         <option value="June" @if($academicyears->endmonth== "June") selected @endif>June</option>
                                         <option value="July" @if($academicyears->endmonth== "July") selected @endif>July</option>
                                         <option value="Augest" @if($academicyears->endmonth== "Augest") selected @endif>Augest</option>
                                         <option value="September" @if($academicyears->endmonth== "September") selected @endif>september</option>
                                         <option value="October" @if($academicyears->endmonth== "October") selected @endif>October</option>
                                         <option value="November" @if($academicyears->endmonth== "November") selected @endif>November</option>
                                         <option value="December" @if($academicyears->endmonth== "December") selected @endif>December</option>
                                    </select>
                                    </div>
                                     <div class="form-group">
                                       <label for="exampleInputEmail1">Active / Deactive<span style="color:red;"> *</span></label>
                                       <select class="form-control select2" style="width: 100%;" name="status" required>
                                           <option value="1" @if($academicyears->status== "1") selected @endif>Active</option>
                                           <option value="0" @if($academicyears->status== "0") selected @endif>Deactive</option>

                                    </select>
                                     </div>

                                   </div>
@endforeach
                                 </div>
                                   <div class="box-footer">
                                     <button type="submit" class="btn btn-primary">Update</button>
                                   </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 </form>
                               </div>
                      </div>
            </div>
          </div>
              </div>
      </section>
    <!-- /.content -->
  </div>
  </div>
  </div>
  <!-- /.content-wrapper -->

@endsection
{{--External Style Section--}}
@section('script')
<script src="{{ URL::asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>


@endsection
<!-- ./wrapper -->
