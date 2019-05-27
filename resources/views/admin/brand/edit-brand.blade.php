</!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<br/>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-body">
                {{ Session::get('message')}}
                <form action="{{ route('update-brand') }}"method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-md-3">brand Name</label>
                        <div class="col-md-9">
                            <input type="text" name="brand_name" value = "{{ $brand -> brand_name}}" class="form-control"/>
                            <input type="hidden" name="brand_id" value = "{{ $brand -> id}}" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Category Description</label> 
                        <div class="col-md-9">
                            <textarea class="form-control" name="brand_description">
                                {{ $brand -> brand_description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Publication status</label>
                        <div class="col-md-9 radio">
                            <label><input type="radio" name="publication_status" 
                                {{ $brand->publication_status == 1 ? 'checked' : ''}} value="1"/> Published</label>
                            <label><input type="radio" name="publication_status"
                             {{ $brand->publication_status == 0 ? 'checked' : ''}} value="0"/> Unpublished</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <input type="submit" name="btn" value="update brand Info" class="btn btn-success btn-block"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



</body>
</html>
