<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-body">
        <div class="col-md-12">
                        <div class="form-group">
                          <div class="col-sm-12">
                          <table class="table table-striped table-bordered ">
                            <thead>
                              <tr>
                                <td>  </td>
                                <td>  </td>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Hostel For :</td>
                                <td>{{$info[0]->usertype}}</td>
                              </tr>
                              <tr>
                                <td>Name :</td>
                                <td>{{$info[0]->stu_name}} - {{$info[0]->user_name}}</td>
                              </tr>
                              <tr>
                                <td>Class/Section :</td>
                                <td>{{$info[0]->course_name}}/{{$info[0]->batch_name}}</td>
                              </tr>
                              <tr>
                                <td>Hostel Name :</td>
                                <td>{{$info[0]->hostel_name}}</td>
                              </tr>
                              <tr>
                                <td>Room No/Floor No :</td>
                                <td>{{$info[0]->room_no}}/{{$info[0]->floor_name}}</td>
                              </tr>
                              <tr>
                                <td>Hostel Registration Date :</td>
                                <td>{{$info[0]->hostel_reg_date}}</td>
                              </tr>
                              <tr>
                                <td>Hostel Vacating Date :</td>
                                <td>{{$info[0]->hostel_vacating_date}}</td>
                              </tr>
                            </tbody>
                          </table>
                          </div>
                        </div>
                      </div>
        </div>

    </div>


</div>
