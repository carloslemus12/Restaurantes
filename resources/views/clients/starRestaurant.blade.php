<center>
    @php
        $count =  $restaurante->votos();
    @endphp
    
    @for ($i = 0; $i < $count; $i++)
        <img src="{{ asset('img/favorite.png') }}" />
    @endfor
    
    @for ($i = 0; $i < (5 -$count); $i++)
        <img src="{{ asset('img/dislike.png') }}" />
    @endfor
</center>