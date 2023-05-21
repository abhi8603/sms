<div class="box-body" >
  <div class="row">
    <div class="col-md-12">
      <div class="form-group col-md-12">
        <p>Answer : </p>
        {!! $wardans[0]->answer !!}
      </div>
      <div class="form-group col-md-12">
        <p>File (if Uploaded) : </p>
        @if($wardans[0]->ans_file=='0')
        <span>NA</span>
        @else
        <a href="{{ URL::asset($wardans[0]->ans_file) }}" class="btn btn-info" target="_blank">View</a>
        @endif
      </div>

    </div>
  </div>
</div>
