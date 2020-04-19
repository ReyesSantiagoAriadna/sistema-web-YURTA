<form method="post" action="{{url('/photo')}}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="author">Cover:</label>
        <input type="file" class="form-control" name="bookcover"/>
    </div>
    <button type="submit" name="upload" title="va"></button>
</form>