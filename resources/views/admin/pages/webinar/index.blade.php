@extends('admin.layouts.master')

@section('title', $title ?? '')

@section('content')
    @livewire('webinar-component', ['titlePage' => $title ?? ''])
@endsection

@push('custom-scripts')
    <script>
        window.addEventListener('swal:confirm', event => {
            const detail = Array.isArray(event.detail) ? event.detail[0] : event.detail;

            console.log('Swal detail:', detail);

            Swal.fire({
                title: detail.title,
                text: detail.text,
                icon: detail.icon,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then(result => {
                if (result.isConfirmed) {
                    Livewire.dispatch('delete', {
                        id: detail.id
                    });
                }
            });
        });
    </script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('notify', (payload) => {
                const data = payload[0];

                Swal.fire({
                    icon: data.type,
                    title: data.type === 'success' ? 'Berhasil' : 'Terjadi kesalahan',
                    text: data.message,
                    timer: data.type === 'success' ? 1500 : null,
                    showConfirmButton: data.type !== 'success'
                });
            });
        });
    </script>
@endpush
