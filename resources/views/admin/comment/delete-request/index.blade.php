@extends('admin.layouts.main')

@section('head-tag')
    <title>درخواست حذف نظر</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">درخواست حذف نظر</h5>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">متن نظر</th>
                        <th class="text-center">امتیاز</th>
                        <th class="text-center">علت حذف</th>
                        <th class="max-width-16-rem text-center"><i class="fa-solid fa-gears"></i> تنظیمات</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($commentDeleteRequests as $key => $commentDeleteRequest)

                        <tr>
                            <th class="text-center">{{ $key += 1 }}</th>
                            <td class="text-center max-width-20-rem">{{ $commentDeleteRequest->comment->content }}</td>
                            <td class="text-center max-width-20-rem">{{ $commentDeleteRequest->comment->score }}</td>
                            <td class="text-center max-width-20-rem">{{ $commentDeleteRequest->body }}</td>
                            <td class="width-16-rem text-start">
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.comment-delete-request.show', $commentDeleteRequest) }}"><i class="ti ti-edit"></i> بررسی درخواست</a>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center">نظری برای نمایش وجود ندارد.</td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
            </div>
            {{ $commentDeleteRequests->links() }}
        </div>
    </div>
@endsection
