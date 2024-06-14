@php use Morilog\Jalali\Jalalian; @endphp
@extends('home.layouts.main')

@section('head-tag')
    <title>سفارشات کنونی</title>
@endsection

@section('content')
    <div class="container">
        <div class="row h-100">
            <div class="col-lg-12 mx-auto text-center mt-7">
                <h5 class="fw-bold fs-s fs-lg-5 lh-sm text-center">سفارشات کنونی</h5>
            </div>
            <section class="table-responsive table-padding">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">خریدار</th>
                        <th class="text-center">غذاها</th>
                        <th class="text-center">وضعیت سفارش</th>
                        <th class="text-center">تاریخ ثبت</th>
                        <th class="text-center">قیمت کل غذاها</th>
                        <th class="max-width-16-rem text-center"><i class="fa-solid fa-gears"></i> تنظیمات</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($newOrders as $key => $newOrder)

                        <tr id="tr-{{ $newOrder->id }}">
                            <th class="text-center">{{ $key += 1 }}</th>
                            <td class="text-center">{{ $newOrder->customer->name }}</td>
                            <td class="text-center">
                                <table class="table table-hover">
                                    @foreach($newOrder->orderItems as $orderItem)
                                        <tr>
                                            <td>{{ $orderItem->food->name }}</td>
                                            <td>{{ $orderItem->count }} عدد</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                            <td class="text-center">
                                <select name="order_status" id="status-{{ $newOrder->id }}" class="form-control"
                                        onchange="changeStatus({{ $newOrder->id }})" data-url="{{ route('seller.order.change-status', $newOrder) }}">
                                    @foreach($orderStatuses as $orderStatus)
                                        <option value="{{ $orderStatus->id }}"
                                                @if( $orderStatus->id == $newOrder->order_status_id) selected @endif>
                                            {{ $orderStatus->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-center">{{ Jalalian::forge($newOrder->created_at)->format('H:i Y-m-d') }}</td>
                            <td class="text-center">{{ $newOrder->totalFoodPrice }}</td>
                            <td class="text-center">
                                <form class="d-inline" action="{{ route('seller.order.destroy', $newOrder) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm delete" type="submit"
                                            onclick="return confirm('آیا از حذف داده مطمئن هستید؟')"><i
                                            class="fas fa-trash"></i> حذف
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center">سفارشی برای نمایش وجود ندارد.</td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
                {{ $newOrders->links() }}
            </section>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function changeStatus(id)
        {

            const element = $('#status-' + id);
            const orderStatus = element.children('option:selected').val();
            let url = element.attr('data-url');
            url = url + '?order_status=' + orderStatus

            $.ajax({
                url: url,
                type: "GET",
                success: function(response)
                {
                    if(response.result)
                    {
                        const message = "وضعیت سفارش به " + response.order_status_name + " تغییر یافت";

                        successToast(message);

                        if(response.order_status == 4)
                        {
                            $('#tr-' + id).remove();
                        }
                    }
                    else
                    {
                        element.children('option:selected').prop('selected', false);

                        element.children('option[value="'+ response.order_status +'"]').prop('selected', true);

                        errorToast('هنگام ویرایش مشکلی بوجود آمده است.');
                    }
                },
                error: function ()
                {
                    element.children('option:selected').prop('selected', false);

                    element.children('option[value="'+ response.order_status +'"]').prop('selected', true);

                    errorToast('ارتباط برقرار نشد.');
                }
            });
        }

        function successToast(message)
        {
            const successToastTag = '<section class="toast" data-bs-delay="5000">\n' +
                '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                '<strong class="me-auto">' + message + '</strong>\n' +
                '<button type="button" class="btn-close me-2" data-bs-dismiss="toast" aria-label="close">\n' +
                '</button>\n' +
                '</section>\n' +
                '</section>';

            $('.toast-wrapper').append(successToastTag);

            $('.toast').toast('show').delay('5500').queue(function () {
                $(this).remove();
            });
        }

        function errorToast(message)
        {
            const successToastTag = '<section class="toast" data-bs-delay="5000">\n' +
                '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                '<strong class="me-auto">' + message + '</strong>\n' +
                '<button type="button" class="btn-close me-2" data-bs-dismiss="toast" aria-label="close">\n' +
                '</button>\n' +
                '</section>\n' +
                '</section>';

            $('.toast-wrapper').append(successToastTag);

            $('.toast').toast('show').delay('5500').queue(function () {
                $(this).remove();
            });
        }
    </script>
@endsection
