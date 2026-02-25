@php use App\Enums\GeneralEnum; @endphp
@extends('layouts.master')
@section('styles')
    <style>
        .cart-summary {
            font-size: 1.2rem;
            font-weight: bold;
        }
    </style>
@endsection
@section('title','Menu Price')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">BAR SELLING POINT</h5>
                </div>
                <div class="col-3" style="text-align: right">
                    <!--Buttons Goes Here-->
                </div>
            </div>

            <hr class="mt-3 mb-4"/>
            <div class="clearfix"></div>

            <div class="container mt-4">
                <!-- Add Item Form -->
                <div class="card mb-4" style="background: whitesmoke">
                    <div class="card-header bg-primary text-white">Add Item</div>
                    <div class="card-body">
                        <form id="addItemForm">
                            <input type="hidden" id="category" value="{{$category}}">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Include In Accommodation Bill?</label>
                                    <select id="is_accommodation" class="form-control">
                                        <option value="No" selected>No</option>
                                        <option value="Yes">Yes</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4" id="added_bill">
                                    <label>Add On existing Bill?</label>
                                    <select id="is_added_bill" class="form-control">
                                        <option value="No" selected>No</option>
                                        <option value="Yes">Yes</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4" id="guest_name" style="display: none">
                                    <label>Client Name</label>
                                    <select id="client_id" class="form-control">
                                        <option value="" disabled selected>Select Client...</option>
                                        @foreach($clients as $client)
                                            <option value="{{$client->id}}">{{$client->full_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4" id="bill_ref" style="display: none">
                                    <label>Bill Ref No:</label>
                                    <input type="text" id="bill_ref_no" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Waiter Name</label>
                                    <select id="staff_id" class="form-control">
                                        <option value="">---Select---</option>
                                        @foreach($staffs as $staff)
                                            <option value="{{$staff->id}}">{{$staff->full_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-3">
                                    <label>Item</label>
                                    <select id="itemName" class="form-control" required>
                                        <option value="" disabled selected>Select item...</option>
                                        @foreach($stock_items as $stock_item )
                                            <option value="{{$stock_item->id}}"
                                                    data-name="{{$stock_item->name}}">{{$stock_item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if($category == 'bar')
                                    <div class="form-group col-2">
                                        <label>Unit</label>
                                        <select id="unit_id" name="unit_id" class="form-control" required>
                                            <option value="" disabled selected>Select Unit</option>
                                            @foreach($units as $unit )
                                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div class="form-group col-2">
                                    <label>Quantity</label>
                                    <input type="number" id="quantity" class="form-control" min="1" value="1" required>
                                </div>
                                <div class="form-group col-3">
                                    <label>Price (auto)</label>
                                    <input type="number" step="0.01" id="price" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-success btn-block">Add to Cart</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Cart Table -->
                <div class="card" style="background: #faf9f9">
                    <div class="card-header bg-dark text-white">Cart</div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="cartTable">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                            <tr>
                                <td colspan="4" class="text-right cart-summary">Grand Total</td>
                                <td colspan="2" class="cart-summary" id="grandTotal">0.00</td>
                            </tr>
                            </tfoot>
                        </table>
                        <div class="text-right">
                            <button class="btn btn-warning" id="clearCart">Clear Cart</button>
                            <button class="btn btn-primary" id="checkout">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('Scripts')
    <script>
        let cart = [];
        let clientId = null;
        let staffId = null;
        let billRefNo = null;
        let isAccommodation = "No";
        let isAddedBill = "No";
        let oldPrice = 0;

        // Autofill price when item selected
        $('#itemName').change(function () {
            const itemId = $(this).val();
            if (itemId != null) {
                const category = $("#category").val();
                getPrice(itemId, category);
            }
        });

        $('#unit_id').change(function () {
            const itemId = $(this).val();
            if (itemId != null && itemId == {{GeneralEnum::TotsUnitId}}) {
                $('#price').val(4000);
            }else if (itemId != null && itemId == {{GeneralEnum::GlassUnitId}}) {
                $('#price').val(4000);
            }else{
                $('#price').val(oldPrice);
            }
        });

        $('#is_accommodation').change(function () {
            isAccommodation = $(this).val();
            if (isAccommodation === "Yes") {
                $("#guest_name").css('display', 'block');
                $("#added_bill").css('display', 'none');
            } else {
                $("#guest_name").css('display', 'none');
                $("#added_bill").css('display', 'block');
            }
        });

        $('#is_added_bill').change(function () {
            isAddedBill = $(this).val();
            if (isAddedBill === "Yes") {
                $("#bill_ref").css('display', 'block');
                $("#bill_ref_no").attr('required', true);
            } else {
                $("#bill_ref").css('display', 'none');
                $("#bill_ref_no").attr('required', false);
            }
        });

        $('#client_id').change(function () {
            const itemId = $(this).val();
            if (itemId != null) {
                clientId = $(this).val();
            }
        });

        function getPrice(itemId, category) {
            $.ajax({
                url: '{{ url("get-item-price") }}/' + itemId + '/' + category,
                method: 'GET',
                success: function (response) {
                    if (response.success === true) {
                        $('#price').val(response.price);
                        oldPrice = response.price;
                    } else {
                        swal("Warning!", response.message, "warning");
                    }
                }
            });
        }

        // Add item to cart
        $('#addItemForm').submit(function (e) {
            e.preventDefault();
            // get selected item
            const itemIdSelector = $('#itemName');
            let itemId = itemIdSelector.val();
            let itemName = $('#itemName option:selected').data('name'); // ✅ correct way to get data-itemName
            let quantity = parseInt($('#quantity').val());
            let unitId = $('#unit_id').val();
            const priceSelector = $('#price');
            let price = parseFloat(priceSelector.val());
            billRefNo = $('#bill_ref_no').val();
            staffId = $('#staff_id').val();

            if (!itemId || quantity < 1) return;

            let total = (price * quantity).toFixed(2);

            cart.push({itemId, itemName, unitId, quantity, price, total});
            updateCart();

            this.reset();
            priceSelector.val('');
            itemIdSelector.val('').change();
        });

        // Remove item
        function removeItem(index) {
            cart.splice(index, 1);
            updateCart();
        }

        // Update cart table
        function updateCart() {
            let tbody = $('#cartTable tbody');
            tbody.empty();

            let grandTotal = 0;

            cart.forEach((item, index) => {
                grandTotal += parseFloat(item.total);

                tbody.append(`
        <tr>
          <td>${index + 1}</td>
          <td>${item.itemName}</td>
          <td>${item.quantity}</td>
          <td>${item.price.toFixed(2)}</td>
          <td>${item.total}</td>
          <td><button class="btn btn-sm btn-danger" onclick="removeItem(${index})">Remove</button></td>
        </tr>
      `);
            });

            $('#grandTotal').text(`${grandTotal.toFixed(2)}`);
        }

        // Clear cart
        $('#clearCart').click(function () {
            cart = [];
            updateCart();
        });

        // Checkout
        $('#checkout').click(function () {
            if (cart.length === 0) {
                alert('Cart is empty!');
                return;
            }
            const category = $("#category").val();

            $.ajax({
                url: '{{ route("sales.item-sales") }}', // 👈 make sure route name or URL matches your controller route
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // CSRF protection
                    cart: cart, // send the entire cart array
                    grand_total: $('#grandTotal').text(),
                    category: category,
                    client_id: clientId,
                    is_accommodation: isAccommodation,
                    is_addition_bill: isAddedBill,
                    bill_ref_no: billRefNo,
                    staff_id: staffId,
                },
                success: function (response) {
                    if (response.success === true) {
                        swal("Success", response.message, 'success');
                    } else {
                        swal("Error", response.message, 'error');
                    }
                    cart = [];
                    updateCart();
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    const message = xhr.responseJSON?.message ||
                        "Something went wrong. Please try again.";

                    swal("Error", message, "error");
                }

            });
        });

    </script>
@endsection
