@foreach ($purchases as $purchase)
    <div class="single-purchase">
        <div class="order-info">
            <b>Information</b>
            <div>
                <span>ID: </span><span style="font-weight: 450; font-style: italic">{{ $purchase->id }}</span>
            </div>
            <div>
                <span>Name: </span><span style="font-weight: 450; font-style: italic">{{ $purchase->name }}</span>
            </div>
            <div>
                <span>Address: </span><span style="font-weight: 450; font-style: italic">{{ $purchase->address }}</span>
            </div>
            <div>
                <span>Phone: </span><span style="font-weight: 450; font-style: italic">{{ $purchase->phone }}</span>
            </div>
            <div>
                <span>Status: </span><span style="font-weight: 450; font-style: italic">
                    @if ($purchase->status == 1)
                        Ordering
                    @elseif ($purchase->status == 2)
                        Delivering
                    @elseif ($purchase->status == 3)
                        Delivered
                    @elseif ($purchase->status == 4)
                        Denied
                    @endif
                </span>
            </div>
        </div>
        <hr class="col-11 mr-auto ml-auto mb-0 mt-10">
        <div class="laptop-list">
            <b>Laptop</b>
            @foreach ($purchase->subOrder as $subOrder)
                <div class="single-laptop">
                    <img src="{{ asset('storage/' . $subOrder->laptop->img) }}" alt="laptop" height="90px"
                        class="col-3 col-md-2">

                    <div class="laptop-info col-5">
                        <div>
                            <span>Laptop: </span><span style="font-style: italic">{{ $subOrder->laptop->name }}</span>
                        </div>
                        <div>
                            <span>Price: </span><span style="font-style: italic">${{ $subOrder->laptop->price }}</span>
                        </div>
                        <div>
                            <span>Quantity: </span><span style="font-style: italic">{{ $subOrder->quantity }}</span>
                        </div>
                        <div>
                            <span>Brand: </span><span
                                style="font-style: italic">{{ $subOrder->laptop->brand->name }}</span>
                        </div>
                    </div>

                    <div class="col-1 col-md-3"></div>

                    <div class="cost-container col-3 col-md-2">
                        <span>Total price: </span><span
                            style="font-weight: 400; font-style: italic; color:#0363cd"><b>${{ $purchase->total_price }}</b></span>
                    </div>
                </div>
            @endforeach
        </div>
        @if ($purchase->status == 2)
            <div class="mb-20 pr-40 text-right">
                <a class="brand-btn" href="{{ url('user/purchase/received/' . $purchase->id) }}">Received</a>
            </div>
        @endif
    </div>

    @if (session('status'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('status') === 'Received Successfully')
                    Swal.fire({
                        icon: 'success',
                        title: 'Received Successfully!',
                        text: 'Thank you for your purchase',
                        timer: 2000,
                        showConfirmButton: false
                    });
                @elseif (session('status') === 'existed')
                    Swal.fire({
                        icon: 'info',
                        title: 'Already Exists!',
                        text: 'Laptop is already in your wishlist.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                @endif
            });
        </script>
    @endif
@endforeach
