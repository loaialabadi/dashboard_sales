@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">الفروع</h4>
                    <a href="{{ route('branches.create') }}" class="btn btn-primary">إضافة فرع</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>اسم الفرع</th>
                                    <th>العنوان</th>
                                    <th>الهاتف</th>
                                    <th>إجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($branches as $branch)
                                <tr>
                                    <td>{{ $branch->id }}</td>
                                    <td>{{ $branch->name }}</td>
                                    <td>{{ $branch->address }}</td>
                                    <td>{{ $branch->phone }}</td>
                                    <td>
                                        <a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                                        <form action="{{ route('branches.destroy', $branch->id) }}" method="POST" style="display:inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل انت متأكد؟')">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @if($branches->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center">لا توجد فروع حالياً</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
