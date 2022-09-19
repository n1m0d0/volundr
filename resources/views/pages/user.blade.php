<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Usuario
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('component-user')
            </div>
        </div>
    </div>
    
    @section('scripts')
        <script>
            window.addEventListener('info', event => {
                toastr.info(event.detail.message)
            })
        </script>
        <script>
            window.addEventListener('success', event => {
                toastr.success(event.detail.message)
            })
        </script>
        <script>
            window.addEventListener('warning', event => {
                toastr.warning(event.detail.message)
            })
        </script>
    @endsection
</x-app-layout>