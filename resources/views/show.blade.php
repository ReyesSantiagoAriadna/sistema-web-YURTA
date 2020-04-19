<div class="col-md-6 offset-md-3 book-desc">
    <div class="card">
        <img class="card-img-top" src="{{url('public/'.$book->filename)}}" alt="{{$book->filename}}">
        <div class="card-body">
            <h4 class="card-title">Book No: {{ $book->id}}</h4>
            <p class="card-text">
                Book <strong>{{ $book->name}}</strong> is written by <strong>{{ $book->author}}</strong>
            </p>
            <a href="{{ route('home') }}" class="btn btn-dark">Back</a>
        </div>
    </div>
</div>