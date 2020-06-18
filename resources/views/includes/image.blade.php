<div class="card pub-image">
            
    <div class="card-header">
    
    @if ($image->user->image)
    
    
    <div class="container-avatar">
        
            <img src=" {{url('user/avatar/'.$image->user->image)}}" alt="" class="avatar">
    </div>
    
    @endif

    <div class="data-user">
        
        <a href="{{route('image.detail',['id'=>$image->id]) }}">
        {{$image->user->name.' '.$image->user->surname}} 
        <span class="nickname"> {{' | @'.$image->user->nick}}</span>
        </a>
    </div>

</div>

    <div class="card-body">

    <div class="image-container">

        <img src="{{ route('image.file', ['filename' => $image->image_path ]) }}" alt="">

    </div>

    

    <div class="description">
        <span class="nickname">{{'@'.$image->user->nick}}</span>

        <span class="nickname">{{' | '.\Carbon\Carbon::now()->diffForHumans($image->created_at)}}</span>
        
        <p>{{$image->description}}</p> 
    </div>

    

    
    <div class="likes">
        <?php $user_like = false; ?>
        @foreach ($image->likes as $like)
            @if ($like->user_id == Auth::user()->id)

                <?php $user_like =true; ?>
                
            @endif
            
        @endforeach

        @if ($user_like)

    <img src="{{ asset('img/heart-red.png') }}" alt="" data-id="{{ $image->id }}" class="btn-dislike">

        @else

        <img src="{{ asset('img/heart-black.png') }}" alt="" data-id="{{ $image->id }}" class="btn-like">
            
        @endif
        {{ count($image->likes) }}
    </div>
    
    <div class="comments">
        
        <a href="" class="btn btn-warning tn-sm btn-comments">
            Comentarios ({{ count($image->comments) }})
        </a>
    </div>

         

      
       
    </div>
</div>