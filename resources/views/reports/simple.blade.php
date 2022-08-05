@php
  $summary = [
    [ 'th' => 'الملفات المدرجة', 'td' => join(' ', [$count['posts'], 'ملفات تم إدراجها في', $count['tags'], 'تصنيفات']) ],
    [ 'th' => 'المستخدمين', 'td' => join(' ،', $users->map(fn ($i) => $i->username)->toArray()) ],
    [ 'th' => 'التصنيفات', 'td' => join('، ', $tags->map(fn ($i) => $i->name)->toArray()) ],
  ];
  $performanceCols = [
    __('Username'), 
    __('Added Posts'), 
    __('Tags')
  ];
  $performanceRows = $performance;
  
  $months = [
    0 => '',
    1 => 'يناير',
    2 => 'فبراير',
    3 => 'مارس',
    4 => 'أبريل',
    5 => 'مايو',
    6 => 'يونيو',
    7 => 'يوليو',
    8 => 'أغسطس',
    9 => 'سبتمبر',
    10 => 'أكتوبر',
    11 => 'نوفمبر',
    12 => 'ديسمبر',
  ];
@endphp

<div role="heading" style="font-size: 1.3cm">تقرير الأرشيف</div>
<span style="font-size: .5cm">{{ join(' ', ['بواسطة:', auth()->user()->roleName(), auth()->user()->username, 'في يوم', now()->isoFormat('dddd، Do MMMM YYYY، hh:mm')]) }}</span>
<br />
<h2>الأرشيف الإلكتروني لشهر ({{ $months[request()->query('month')] }}) {{ now()->year }}</h2>

<hr />
<h3 style="font-size: .5cm">{{ __('Operations Summary') }}</h3>
<table>
  @foreach ($summary as $idx => $row)
    <tr style="border: 1px solid blue">
      <th bgcolor="#9fc4e7" align="left" style="width: 20%;">&nbsp;&nbsp;{{ $row['th'] }}&nbsp;&nbsp;</th>
      <td style="">&nbsp;&nbsp;{{ $row['td'] }}&nbsp;&nbsp;</td>
    </tr>
  @endforeach
</table>
<br /><br /><br />
<hr />
<h3 style="font-size: .5cm">{{ __('Users Performance') }}</h3>
<table>
  <thead>
    <tr>
      @foreach ($performanceCols as $column)      
        <th bgcolor="#9fc4e7">{{ $column }}</th>
      @endforeach
    </tr>
  </thead>
  <tbody>
    @foreach ($performanceRows as $row)
      <tr>
        <td>{{ $row['username'] }}</td>
        <td>{{ $row['additions'] }}</td>
        <td>{{ join('، ', array_map(fn ($x) => $x['tag'].' '.'('.$x['additions'].')', $row['tags'])) }}</td>
      </tr>
    @endforeach
  </tbody>
</table>