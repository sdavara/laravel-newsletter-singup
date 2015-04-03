@extends('app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Settings</div>
        <div class="panel-body">

        @if (Session::has('message'))
            <div class="alert alert-info">
              <p>{{ Session::get('message') }}</p>
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
        @endif

        <div class="form-group">
          {!! Form::label('Title','Title',['class'=>'col-md-4 control-label']) !!}

          <div class="col-md-6">
            {!! Form::label('Newtitle', Input::old('title', isset($settings) ? $settings->title : null) ,['class'=>'form-control', 'id' => 'Newtitle', 'disabled', 'style'=>'display:block']) !!}
          </div>
          {!! Form::button('Change', array('class'=>'btn btn-info' , 'id' => 'title_change' ,'onclick'=>"change(this.id)" )) !!}


          <div class="col-md-6" id="titleblock" style="display:none" >
            {!! Form::open(['url'=>'/admin/settings/'.$settings->id,'method'=>'POST', 'class'=>'form-horizontal form-inline']) !!}
            {!! Form::text('title', Input::old('title', isset($settings) ? $settings->title : null) , ['id' => 'title' ,'class' => 'form-control input-medium']) !!}
            {!! Form::submit('Save',array('id' => 'submit' ,'class'=>'btn btn-primary')) !!}
            {!! Form::button('Cancel', array('class'=>'btn btn-info' , 'id' => 'title_cancel' ,'onclick'=>"cancel(this.id)" )) !!}
            {!! Form::close() !!}
          </div>
          <br>
        </div>
        <br>

        <div class="form-group">
        {!! Form::label('Sub Title','Sub Title',['class'=>'col-md-4 control-label']) !!}
          <div class="col-md-6">
            {!! Form::label('Newsubtitle', Input::old('subtitle', isset($settings) ? $settings->subtitle : null) ,['class'=>'form-control', 'id' => 'Newsubtitle', 'disabled', 'style'=>'display:block']) !!}
           </div>
          {!! Form::button('Change', array('class'=>'btn btn-info' , 'id' => 'subtitle_change' ,'onclick'=>"change(this.id)" )) !!}

          <div class="col-md-6" id="subtitleblock" style="display:none">
            {!! Form::open(['url'=>'/admin/settings/'.$settings->id,'method'=>'POST','class'=>'form-horizontal form-inline']) !!}
            {!! Form::text('subtitle', Input::old('subtitle', isset($settings) ? $settings->subtitle : null) , ['id' => 'subtitle' ,'class' => 'form-control input-medium']) !!}
            {!! Form::submit('Save',array('id' => 'submit' ,'class'=>'btn btn-primary')) !!}
            {!! Form::button('Cancel', array('class'=>'btn btn-info' , 'id' => 'subtitle_cancel' ,'onclick'=>"cancel(this.id)" )) !!}
            {!! Form::close() !!}
          </div>
          <br>
        </div>
        <br>

        <div class="form-group">
        {!! Form::label('Logo','Logo',['class'=>'col-md-4 control-label']) !!}

        <div class="col-md-6">
          @if($settings->logo)
            {!! HTML::image('/uploads/'.$settings->logo, '', array('class' => 'thumbnail' ,'id' => 'Newlogo' ,'name' => 'Newlogo' , 'style' => 'border:solid 2px #000;', 'height' => '100')) !!}
          @else
            {!! HTML::image('#', '', array('class' => 'thumbnail' ,'id' => 'Newlogo' ,'name' => 'Newlogo' ,'style' => 'border:solid 2px #000;', 'readonly')) !!}
          @endif
        </div>

        {!! Form::button('Change', array('class'=>'btn btn-info' , 'id' => 'logo_change' ,'onclick'=>"change(this.id)" )) !!}

        <div class="col-md-6" id="logoblock" style="display:none">
          {!! Form::open(['url'=>'/admin/settings/'.$settings->id,'method'=>'POST','class'=>'form-horizontal form-inline' ,'files'=> true]) !!}
          {!! Form::file(Input::old('logo',isset($settings) ? $settings->logo : null), ['class'=>'form-control input-medium' , 'id' => 'logo', 'name'=>'logo' ,'value' => Input::old('logo',isset($settings) ? $settings->logo : null)]) !!}
          {!! Form::submit('Save',array('id' => 'submit' ,'class'=>'btn btn-primary')) !!}
          {!! Form::button('Cancel', array('class'=>'btn btn-info' , 'id' => 'logo_cancel' ,'onclick'=>"cancel(this.id)" )) !!}
          {!! Form::close() !!}
        </div>
        <br>
        </div>
        <br>
        <br>

            <div class="form-group">
            {!! Form::label('Description','Description',['class'=>'col-md-4 control-label']) !!}

              <div class="col-md-6">
              {!! Form::textarea('Newdescription', Input::old('description',isset($settings) ? $settings->description : null) ,array('required', 'class'=>'form-control input-medium', 'id' => 'Newdescription' ,'readonly' ,'style'=>'display:block')) !!}

              <br>
              </div>
              <br>
              {!! Form::button('Change', array('class'=>'btn btn-info' , 'id' => 'description_change' ,'onclick'=>"change(this.id)" )) !!}

              <div class="col-md-8" id="descriptionblock" style="display:none">
                {!! Form::open(['url'=>'/admin/settings/'.$settings->id,'method'=>'POST','class'=>'form-horizontal form-inline']) !!}
                {!! Form::textarea('description', old('description',isset($settings) ? $settings->description : null) ,array('class'=>'input-medium form-control ', 'id' => 'description')) !!}
                {!! Form::submit('Save',array('id' => 'submit' ,'class'=>'btn btn-primary')) !!}
                {!! Form::button('Cancel', array('class'=>'btn btn-info' , 'id' => 'description_cancel' ,'onclick'=>"cancel(this.id)" )) !!}
                {!! Form::close() !!}
              </div>
              <br>
            </div>
            <br>
            <br>

            <div class="form-group">
            {!! Form::label('Theme','Theme',['class'=>'col-md-4 control-label']) !!}

              <div class="col-md-8">

              {!! Form::open(['url'=>'/admin/settings/'.$settings->id,'method'=>'POST','class'=>'form-horizontal form-inline','files'=> true]) !!}
              {!! Form::radio('theme', "default" ,$settings->theme == 'default' ? 'checked' : '' )!!}
              {!! Form::label('Light','Light') !!}
              @if($thumbnails['default'])
                {!! HTML::image($thumbnails['default'], '', array('class' => 'thumbnail form-inline' , 'style' => 'border:solid 2px #000;', 'width' => '151','height' => '90')) !!}
              @endif

              {!! Form::radio('theme', "dark" ,$settings->theme == 'dark' ? 'checked' : ''  )!!}
              {!! Form::label('Dark','Dark') !!}
              @if($thumbnails['dark'])
                {!! HTML::image($thumbnails['dark'], '', array('class' => 'thumbnail' , 'style' => 'border:solid 2px #000;', 'width' => '151','height' => '90')) !!}
              @endif

              {!! Form::submit('Save',array('id' => 'savetheme' ,'class'=>'btn btn-primary')) !!}
              {!! Form::close() !!}


              </div>
              </div>
             </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script type = "text/javascript">

  function change(id){
    var index = id.indexOf('_');
    var element = id.substr(0,index);
    document.getElementById("New"+element).style.display="none";
    document.getElementById(element+"_change" ).style.display="none";
    document.getElementById(element+"block").style.display="block";
  }

  function cancel(id){
    var index = id.indexOf('_');
    var element = id.substr(0,index);
    document.getElementById("New"+element).style.display="block";
    document.getElementById(element+"_change" ).style.display="block";
    document.getElementById(element+"block").style.display="none";

  }

</script>​
@stop