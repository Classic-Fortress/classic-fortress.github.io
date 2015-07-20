@if(session('flash.message'))
    <div class="status flash active clearfix {{ session('flash.status') }}">
        <ul class="pull-left">
            @foreach(session('flash.message') as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
        <div class="pull-right icon">
            @if(session('flash.status') == 'error')
                <i class="fa fa-times"></i>
            @elseif(session('flash.status') == 'success')
                <i class="fa fa-check"></i>
            @endif
        </div>
    </div>
@endif

@if(count($errors) > 0)

    <div class="status flash active clearfix error">
        <ul class="pull-left">
            @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
        <div class="pull-right icon">
            <i class="fa fa-times"></i>
        </div>
    </div>

@endif