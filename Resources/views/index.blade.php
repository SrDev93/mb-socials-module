@extends('layouts.admin')
@push('stylesheets')
    <link rel='stylesheet' href='{{ asset('assets/efaicons/style.css') }}' />
@endpush
@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">


        <!-- PAGE-HEADER -->
        @include('socials::partial.header')
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">لیست شبکه های اجتماعی</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                <thead>
                                <tr>
                                    @if(!\Illuminate\Support\Facades\Auth::user()->brand_id)
                                        <th class="wd-15p border-bottom-0">برند</th>
                                    @endif
                                    <th class="wd-15p border-bottom-0">نام</th>
                                    <th class="wd-20p border-bottom-0">عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        @if(!\Illuminate\Support\Facades\Auth::user()->brand_id)
                                            <td>{{ optional($item->brand)->name }}</td>
                                        @endif
                                        <td>@if($item->f_icon) @if($item->name == 'aparat') <i class="efa {{ $item->f_icon }}"></i> @else <i class="fa {{ $item->f_icon }}"></i> @endif @endif{{ $item->name }}</td>
                                        <td>
                                            <a href="{{ route('socials.edit', $item->id) }}" class="btn btn-primary fs-14 text-white edit-icn" title="ویرایش">
                                                <i class="fe fe-edit"></i>
                                            </a>
                                            <button type="submit" onclick="return confirm('برای حذف اطمبنان دارید؟')" form="form-{{ $item->id }}" class="btn btn-danger fs-14 text-white edit-icn" title="حذف">
                                                <i class="fe fe-trash"></i>
                                            </button>
                                            <form id="form-{{ $item->id }}" action="{{ route('socials.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('socials.create') }}" class="btn btn-primary">افزودن</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
@endsection
