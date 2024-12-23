@extends('layouts.user-layout')

@section('content-user')
    <div class="table-container">
        <h5 class="title-content mb-20">Your vouchers</h5>
        {{-- <a href="{{ route('')}}" class="add-btn">
            Add voucher
        </a> --}}
        <table id="cart-table" class="">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Discount</th>
                    <th>Expiration date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if ($vouchers->count() === 0)
                    <tr>
                        <td colspan="4">You don't have any voucher</td>
                    </tr>
                @endif
                @foreach ($vouchers as $voucher)
                    <tr>
                        <td>{{ $voucher->code }}</td>
                        <td>{{ $voucher->discount }}%</td>
                        <td>{{ $voucher->expiration_date }}</td>
                        <td><a class="brand-btn" onclick="copyCode('{{ $voucher->code }}')">Copy code</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function copyCode(voucherCode) {
            navigator.clipboard.writeText(voucherCode);
        }

        document.addEventListener('DOMContentLoaded', function() {
            $('#purchase-nav').removeClass('active-nav-user');
            $('#account-nav').removeClass('active-nav-user');
            $('#voucher-nav').addClass('active-nav-user');
            $('#report-nav').removeClass('active-nav-user');
        });
    </script>
@endsection
