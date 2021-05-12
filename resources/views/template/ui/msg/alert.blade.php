@if(Session::has('message.alert.title'))
<section class="content-header">
    <div class="alert alert-{{Session::get('message.alert.type')}} alert-dismissable"> 
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
        <label>{!! Session::get('message.alert.title') !!}</label>
        <p>{!! Session::get('message.alert.text') !!} </p>
    </div>
</section>
@endif