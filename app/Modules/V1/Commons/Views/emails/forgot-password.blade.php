@extends('Commons::emails.app')

@section('content')
    <table border='0' cellpadding='0' cellspacing='0' bgcolor="#ffffff" style="width: 100%;">
        <tr>
            <td style="width: 100%; padding:0 50px 28px;background: #ffffff; box-sizing: border-box;">
                <span style="font-size: 22px;margin-bottom: 15px; display: block; color: #7d7d7d;">Hi, {!! $receiver_name !!}!</span>
                <span style="color: #7d7d7d; font-size: 20px; display: block;"></span>
                <p style="font-size: 12px;line-height: 2; color: #7d7d7d;">To reset your <a href="{!! url('/en') !!}">{!! config('app.name') !!}</a> account please use <b>{!! $verification_code !!}</b>.</p>
                <span style="color: #7d7d7d; font-size: 18px; display: block;padding:15px 0 5px;">Team {!! config('app.name') !!}</span>
            </td>
        </tr>
    </table>
@endsection 
