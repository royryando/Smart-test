<div class="title" style="padding-bottom: 13px">
    <div style="text-align: center;text-transform: uppercase;font-size: 15px">
        Smart Test
    </div>
    <div style="text-align: center">
        Alamat: Kp Andir Desa Pakutandang Kecamatan Ciparay
    </div>
    <div style="text-align: center">
        Telp: 0857-9087-9087
    </div>
</div>
<table style="width: 100%">
    <thead>
        <tr style="background-color: #e6e6e7;">
            <th scope="col">Date</th>
            <th scope="col">Nama Peserta</th>
            <th scope="col">Nilai Peserta</th>
            <th scope="col">Kategori</th>
        </tr>
    </thead>
    <tbody>
        @foreach($profits as $profit)
        <tr>
            <td>{{ $profit->created_at }}</td>
            <td>{{ $profit->customer->name }}</td>
            <td>{{ $profit->nilai }}</td>
            <td>{{ $profit->kategori }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
