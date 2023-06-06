@if(session()->has('success'))
    <div class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-24 text-center py-3 z-10">
        <p>{{session()->get('success')}}</p>
    </div>
@endif