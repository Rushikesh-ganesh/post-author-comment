@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <section style="background-color: #eee;"> --}}
        {{-- <div class="container my-5 py-5"> --}}
            <div class="row">

            
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body ">
                      <div class="d-flex flex-start align-items-center">
                        <div>
                          <h6 class="fw-bold text-primary mb-1">   {{$post_data->post_title}} </h6>
                          <p class="text-muted small mb-0">
                            {{$post_data->Author->name}} | Shared publicly - {{date('M d-Y', strtotime($post_data->created_at));}}
                          </p>
                        </div>
                      </div>
          
                      <p class="mt-3 mb-4 pb-2">
                        {{$post_data->post_description}}
                      </p>
                    </div>
                    <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                        <form id="comment" action="{{route('commentStore',$post_data->id)}}" method="POST">
                            @csrf
                      <div class="d-flex flex-start w-100">
                       
                        <div class="form-outline w-100">
                          <textarea
                            class="form-control"
                            id="textAreaExample"
                            rows="4"
                            name="comment_post"
                            style="background: #fff;"
                          ></textarea>
                         
                        </div>
                      </div>
                      <div class="float-end mt-2 pt-1">
                        <button type="button" onclick="submitComment()" class="btn btn-primary btn-sm">Post comment</button>
                       <a href="{{route('home')}}"><button type="button" class="btn btn-outline-primary btn-sm">Back</button></a> 
                      </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5 overflow-auto">
                <div class="card">
                    <div class="card-body">

                <h4 class="mb-0">Recent comments</h4>
                <p class="fw-light mb-4 pb-2">Latest Comments section by users</p>
    
              @if (count($post_data->comments) > 0)
                  
             
                @foreach ($post_data->comments as $item)
                    
                <div class="d-flex flex-start">
                  <div>
                    <h6 class="fw-bold mb-1">{{$item->commented_by->name}}</h6>
                        <div class="d-flex align-items-center mb-3">
                            <p class="mb-0">
                                {{date('M d-Y', strtotime($item->created_at));}}
                            </p>
                        </div>
                        <p class="mb-0">
                            {{$item->post_comment}}
                        </p>
                    @if (Auth::check())
                    @if (Auth::user()->id == $post_data->author_id)
                        <a href="#!" onclick="deleteComment({{$item->id}})" class="btn btn-danger mt-3"
                        >Delete comment</a>
                      @endif
                    @endif
                  </div>
                </div>
               
                <br>
                  @endforeach
                  @else
                    No Comments 
                  @endif
                
                    </div>
                </div>
            </div>

        </div>
       
</div>
@endsection

@push('scripts')
  <script>
       $( document ).ready(function() {
        $("#comment").validate({
            rules: {
                comment_post: {
                    required: true,
                   
                },
            },
            messages: {
                comment_post: {
                    required: "Comment field is requried",
                },
            },
        });
    });

    function submitComment() {
        $.ajax({
            type: "GET",
            url: "{{ url('checkauth')}}",
            success: function (data) {
                if(data){
                    if($("#comment").valid())
                    {
                        $("#comment").submit();
                    }
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

       
    }

    function deleteComment(id){
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
                    url: "{{ url('delete_comment')}}"+"/"+id,
                    data:{ "_token": "{{ csrf_token() }}"},
                    success: function (data) {
                        if(data.success){
                            Swal.fire({
                                text: data.success,   
                            }).then((result) => {
                                let url = "{{ route('show',$post_data->id) }}";
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
  </script>
@endpush
