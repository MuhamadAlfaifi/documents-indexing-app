@php
  $summary = [
    [ 'th' => 'المستندات المدرجة', 'td' => join(' ', [$count['posts'], 'ملفات تم إدراجها في', $count['tags'], 'تصنيفات']) ],
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
    1 => 'محرم',
    2 => 'صفر',
    3 => 'ربيع الأول',
    4 => 'ربيع الثاني',
    5 => 'جمادى الأول',
    6 => 'جمادى الثاني',
    7 => 'رجب',
    8 => 'شعبان',
    9 => 'رمضان',
    10 => 'شوال',
    11 => 'ذو القعدة',
    12 => 'ذو الحجة',
  ];

  $reportHeading = '';
  $tableHeading = '';
  
  switch ($type) {
    case 'month':
      $tableHeading = join(' ', ['الأرشيف الإلكتروني لشهر', '('.$months[request()->query('month')].')', request()->filterable('hijy'), 'هـ']);
      $reportHeading = 'تقرير شهري';
      break;
    case 'user':
      $tableHeading = join(' ', ['الأرشيف الإلكتروني للمستخدم', '('.optional(\App\Models\User::find(request()->query('user_id')))->username.')', request()->filterable('hijy'), 'هـ']);
      $reportHeading = 'تقرير مستخدم';
      break;
    
    default:
      $tableHeading = join(' ', ['الأرشيف الإلكتروني لسنة', request()->filterable('hijy'), 'هـ']);
      $reportHeading = 'تقرير سنوي';
      break;
  }
@endphp

<div role="heading" style="font-size: 1.3cm">{{ $reportHeading }}</div>
<span style="font-size: .5cm">{{ join(' ', ['بواسطة:', auth()->user()->roleName(), auth()->user()->username, 'في يوم', now()->isoFormat('dddd، Do MMMM YYYY، hh:mm')]) }}</span>
<br />
<h2>{{ $tableHeading }}</h2>

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