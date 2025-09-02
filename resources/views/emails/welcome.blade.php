@extends('emails.layout')

@section('content')
    <h2>Chào mừng {{ $user->name ?? 'bạn' }}!</h2>

    <p>Cảm ơn bạn đã đăng ký tài khoản tại {{ config('app.name') }}. Chúng tôi rất vui mừng được chào đón bạn!</p>

    @if (isset($user->email))
        <p><strong>Email đăng ký:</strong> {{ $user->email }}</p>
    @endif

    @if (isset($customData['welcome_message']))
        <div style="background-color: #e7f3ff; padding: 15px; border-radius: 4px; margin: 20px 0;">
            <p>{{ $customData['welcome_message'] }}</p>
        </div>
    @endif

    @if (isset($customData['activation_url']))
        <p>Để kích hoạt tài khoản của bạn, vui lòng nhấp vào nút bên dưới:</p>
        <p style="text-align: center;">
            <a class="btn" href="{{ $customData['activation_url'] }}">Kích hoạt tài khoản</a>
        </p>
    @endif

    <p>Nếu bạn có bất kỳ câu hỏi nào, đừng ngại liên hệ với chúng tôi.</p>

    <p>Trân trọng,<br>Đội ngũ {{ config('app.name') }}</p>
@endsection
