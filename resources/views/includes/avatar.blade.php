@if (Auth::user()->image)

    <div class="container-avatar">

        <img src=" {{url('user/avatar/'.Auth::user()->image)}}" alt="" class="avatar">

    </div>
                                
@endif