@if ($errors->any())
<div class="alert alert-danger alert-dismissable margin5">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Error:</strong> Please check the form below for errors
</div>
@endif

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissable margin5">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Success:</strong> {{ $message }}
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissable margin5">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    @php
    // dd($message);
    @endphp
    @if (is_object($message))
    <strong>Error:</strong>
    <p>
        Row: {{ $message->row() }} <br>
        Attribute: {{ $message->attribute() }} <br>
        Message: {{ $message->errors()[0] }} <br>
        Values: <br>
        @foreach ($message->values() as $key => $item)
        {{ $key .' -> '. $item .', '}}
        @endforeach
    </p>
    @elseif (is_array($message))
    {{-- {{dd($message)}} --}}
    <strong>Error:</strong>
    <p>
        Row: {{ $message['row'] }} <br>
        Attribute: {{ $message['attribute'] }} <br>
        Message: {{ $message['error'] }} <br>
        Values: <br>
        {{ $message['values'] }}
    </p>
    @else
    <strong>Error:</strong> {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissable margin5">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Warning:</strong> {{ $message }}
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-dismissable margin5">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Info:</strong> {{ $message }}
</div>
@endif
@if ($message = Session::get('msg'))
<div class="alert alert-danger alert-dismissable margin5">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Error:</strong> {{ $message }}
</div>
@endif