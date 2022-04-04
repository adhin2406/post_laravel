@foreach ($products as $item)
    @if ($item == null)
        <tr>
            <h5 class="text-center text-grey">Data tidak ditemukan</h5>
        </tr>
    @else
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->no_transaksi }}</td>
            <td>{{ date('d M Y', strtotime($item->tgl)) }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->qty }}</td>
            <td>Rp {{ number_format($item->harga_diskon) }}</td>
            <td>
                @if ($item->diskon == null)
                    0%
                @else
                    {{ $item->diskon }}%
                @endif
            </td>
            <td>
                Rp {{ number_format($item->ongkir) }}
            </td>
            <td>Rp {{ number_format($item->harga_diskon) }}</td>
        </tr>
    @endif
@endforeach
