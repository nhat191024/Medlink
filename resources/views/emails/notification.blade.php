@extends('emails.layout')

@section('content')
    <h2>{{ $title }}</h2>

    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 4px; margin: 20px 0;">
        <p>{{ $message }}</p>
    </div>

    @if ($actionUrl)
        <p style="text-align: center;">
            <a class="btn" href="{{ $actionUrl }}">{{ $actionText }}</a>
        </p>
    @endif

    <p>Nếu bạn không thể nhấp vào nút trên, hãy sao chép và dán URL sau vào trình duyệt của bạn:</p>
    @if ($actionUrl)
        <p style="word-break: break-all; color: #007bff;">{{ $actionUrl }}</p>
    @endif

    <p>Trân trọng,<br>Đội ngũ {{ config('app.name') }}</p>
@endsection
