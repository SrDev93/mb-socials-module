@extends('layouts.admin')

@push('stylesheets')
    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>
@endpush

@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">
        <!-- PAGE-HEADER -->
    @include('socials::partial.header')
    <!-- PAGE-HEADER END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">ویرایش شبکه اجتماعی</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('socials.update', $social->id) }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
{{--                            @include('admin.partial.lang')--}}
                            @include('admin.partial.brand')
                            <div class="col-md-6">
                                <label for="name" class="form-label">نام</label>
                                <input type="text" name="name" class="form-control" required value="{{ $social->name }}">
                                <div class="invalid-feedback">لطفا نام را وارد کنید</div>
                            </div>
                            <div class="col-md-6">
                                <label for="url" class="form-label">لینک</label>
                                <input type="text" name="url" class="form-control" required value="{{ $social->url }}">
                                <div class="invalid-feedback">لطفا لینک را وارد کنید</div>
                            </div>
                            <div class="col-md-6">
                                <label for="f_icon" class="form-label">کلاس آیکن ( نمونه : fa-instagram)</label>
                                <input type="text" name="f_icon" class="form-control" id="f_icon" value="{{ $social->f_icon }}">
                                <div class="invalid-feedback">لطفا کلاس آیکن را وارد کنید</div>
                            </div>
                            <div class="col-md-5">
                                <label for="image" class="form-label">تصویر آیکن</label>
                                <input type="file" name="image" class="form-control" aria-label="تصویر آیکن" accept="image/*">
                                <div class="invalid-feedback">لطفا یک آیکن انتخاب کنید</div>
                            </div>
                            <div class="col-md-1">
                                @if($social->i_icon)
                                    <label for="image" class="form-label">آیکن فعلی</label>
                                    <img src="{{ url($social->i_icon) }}" width="16">
                                @endif
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">بروزرسانی</button>
                                @csrf
                                @method('PATCH')
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW CLOSED -->

    </div>

    @push('scripts')

    @endpush
@endsection
