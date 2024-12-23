@extends('layouts.user-layout')

@section('content-user')
    <header>
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> --}}
    </header>
    <div class="table-container mb-20">
        <h5 class="title-content mb-20">Create report</h5>
        {{-- <a href="{{ route('')}}" class="add-btn">
            Add voucher
        </a> --}}
        {{-- <table id="cart-table" class="">
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
        </table> --}}
        <form action="{{ route('createReportHandle') }}" method="POST" class="pl-20 pr-20 mb-20">
            @csrf
            <div class="form-group mt-40">
                <label for="report-type">Report type:</label>
                <select class="form-control" id="report-type" name="report_type">
                    <option value="">Select type</option>
                    <option value="Product">Product report</option>
                    <option value="Voucher">Voucher report</option>
                    <option value="System">System report</option>
                    {{-- <option value="employees">Employees report</option> --}}
                </select>
            </div>
            <div class="form-group mt-40">
                <label for="date-range">Date range:</label>
                <div class="input-group">
                    <input type="date" class="form-control" id="date-range" name="date"
                        placeholder="Select date range">
                </div>

                <div class="form-group mt-40">
                    <label for="report-name">Report content:</label>
                    <input type="text" class="form-control" id="report-name" name="content" placeholder="Content..."
                        required>
                    <div class="d-flex" style="gap: 10px; align-items: center">
                        <input type="checkbox" name="" id="" style="width: 20px" required>
                        <span style="font-size: 14px">I have read and agree that I will be responsible for everything I have submitted.</span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="brand-btn" value="Create report">
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}
    <script>
        function copyCode(voucherCode) {
            navigator.clipboard.writeText(voucherCode);
        }

        document.addEventListener('DOMContentLoaded', function() {
            $('#purchase-nav').removeClass('active-nav-user');
            $('#account-nav').removeClass('active-nav-user');
            $('#voucher-nav').removeClass('active-nav-user');
            $('#report-nav').addClass('active-nav-user');
        });
    </script>
@endsection
