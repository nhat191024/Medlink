@extends('emails.layout')

@section('content')
    <h2>{{ $reportData['title'] ?? 'Báo cáo hệ thống' }}</h2>

    <p>{{ $reportData['description'] ?? 'Dưới đây là báo cáo chi tiết từ hệ thống.' }}</p>

    @if (isset($reportData['summary']))
        <div style="background-color: #e7f3ff; padding: 15px; border-radius: 4px; margin: 20px 0;">
            <h3>Tóm tắt:</h3>
            <p>{{ $reportData['summary'] }}</p>
        </div>
    @endif

    @if (isset($reportData['data']) && is_array($reportData['data']))
        <h3>Chi tiết báo cáo:</h3>
        <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
            <thead>
                <tr style="background-color: #f8f9fa;">
                    @foreach (array_keys($reportData['data'][0] ?? []) as $header)
                        <th style="border: 1px solid #dee2e6; padding: 8px; text-align: left;">{{ ucfirst($header) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($reportData['data'] as $row)
                    <tr>
                        @foreach ($row as $cell)
                            <td style="border: 1px solid #dee2e6; padding: 8px;">{{ $cell }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if (isset($reportData['attachment_note']))
        <div style="background-color: #fff3cd; padding: 15px; border-radius: 4px; margin: 20px 0;">
            <p><strong>Lưu ý:</strong> {{ $reportData['attachment_note'] }}</p>
        </div>
    @endif

    <p>Báo cáo được tạo vào: {{ $reportData['generated_at'] ?? now()->format('d/m/Y H:i:s') }}</p>

    <p>Trân trọng,<br>Hệ thống {{ config('app.name') }}</p>
@endsection
