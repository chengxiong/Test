@if(count($errors) > 0)
@foreach($errors->all() as $error)
<div class="col-md-12">
    <div class="col-md-6 alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> 警告!</h4>
        {{ $error }}
    </div>
</div>
@endforeach
@elseif(session('message')!=null)
<div class="col-md-12">
    <div class="col-md-6 alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> 成功!</h4>
        {{ session('message') }}
    </div>
</div>
@endif
