@include('pdf_header')

{{-- Table Class Assign Start Here --}}
<table class="table" id="classAssignings-table">
        <caption style="margin-top:20px; text-transform:uppercase" >Users PDF</caption>
    <thead>
        <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr class="border">
                <td class="col-md-6 pull">{!! $user->name !!} </td>
                <td class="col-md-6 pull">{!! $user->email !!}</td>
                <td class="col-md-3 pull">{!! $user->role['name'] !!}</td>
            </tr>
        @endforeach

    </tbody>
    
</table>
</div>




