@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
@if (Auth::check())
        <a href="{{route('create_post')}}" class="btn btn-warning" >Create Post</a> 
@endif
<br><br>
    @foreach ($posts as $i=>$post)
            <div class="card text-left text-dark bg-light">
                <div class="card-header">
                <h5> {{$post->post_title}} </h5>
                </div>
                <div class="card-body text-dark bg-light ">
                    <p class="card-text">{{ $post->post_description }}</p>

                    <a href="#" class="btn btn-primary" onclick="showPost({{$post->id}})">View More</a>
                    <hr>
                    @if (Auth::check())
                      @if (Auth::user()->id == $post->author_id)
                       <a href="#" class="btn btn-primary" onclick="checkauth({{$post->id}})">Edit Post</a>
                       <a href="#" class="btn btn-danger" onclick="deletepost({{$post->id}})">Delete Post</a>
                      @endif
                    @endif
                    
                </div>
                <div class="card-footer text-muted text-dark bg-light">
                   {{$post->Author->name}}  | {{date('M d-Y', strtotime($post->created_at));}}
                </div>
            </div>
        <br>
     @endforeach
    
     
</div>
<div class="d-flex justify-content-center">
    {!! $posts->links() !!}
</div>

@endsection

@push('scripts')

<script>
 $( document ).ready(function() {
 console.log("here");
});

function checkauth(id){

    $.ajax({
            type: "GET",
            url: "{{ url('checkauth')}}",
            success: function (data) {
                if(data){

                    let url = "{{ route('edit_post', ':id') }}";
                    url = url.replace(':id', id);
                    document.location.href=url;

                }else{
                    Swal.fire({
                    title: 'Please login to continue',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Login'
                    }).then((result) => {
                    if (result.isConfirmed) {
                         let url = "{{ route('login') }}";
                         document.location.href=url;
                       }
                    });
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

//    
}

function deletepost(id){
    Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
            type: "DELETE",
            url: "{{ url('delete_post')}}"+"/"+id,
            data:{ "_token": "{{ csrf_token() }}"},
            success: function (data) {
                if(data.success){
                    Swal.fire({
                        text: data.success,   
                    }).then((result) => {
                        let url = "{{ route('home') }}";
                         document.location.href=url;
                    });  
                }
            },  
            error: function (data) {
                console.log('Error:', data);
            }
        });
    

  }
})
}

function showPost(id) {

    let url = "{{ route('show', ':id') }}";
                    url = url.replace(':id', id);
                    document.location.href=url;

    console.log("herr");
    // $.ajax({
    //         type: "GET",
    //         url: "{{ url('show_post')}}"+"/"+id,
    //         success: function (data) {

    //         },  error: function (data) {
    //             console.log('Error:', data);
    //         }
    //     });

}

</script>
@endpush