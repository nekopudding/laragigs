@if(session()->has('success'))
    <div 
      x-data="{ show: true }"
      x-init="setTimeout(() => show = false, 4000)"
      x-show="show"
      class="fixed top-4 left-1/2 transform -translate-x-1/2 
      bg-laravel text-white px-24 text-center py-3 z-10"
    >
        <p>{{session()->get('success')}}</p>
    </div>
@endif