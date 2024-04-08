@extends('admin.layout.app')

@section('content')
    <div class="m-2">
        <a href="http://" onclick="history.back(); return false;" title="Go back">
            <i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal"></i>
        </a>
    </div>
    <div class="mt-5">
        {{-- @php
            $filePath = 'public/library/books/' . $pdf;
            $pdfContent = Storage::get($filePath);
        @endphp

        <embed src="data:application/pdf;base64,{{ base64_encode($pdfContent) }}" type="application/pdf" width="100%"
            height="600px" />
        <embed src="{{ asset('storage/library/books/' . $pdf) }}" type="application/pdf" width="100%" height="600px" /> --}}

        <iframe src="{{ route('pdf.show', ['id' => $book->id]) }}" frameborder="0" width="100%" height="600px"></iframe>

    </div>
@endsection
