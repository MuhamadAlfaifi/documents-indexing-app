@php
  $data0 = [
    [ 'th' => 'الملفات المدرجة', 'td' => join(' ', ['8', 'ملفات تم إدراجها في', '5', 'تصنيفات']) ],
    [ 'th' => 'المستخدمين', 'td' => join(' ،', ['al_hakami', 'al_abdili', 'ali_alharbi']) ],
    [ 'th' => 'التصنيفات', 'td' => join('، ', ['دحيقة', 'جازان', 'باعشن']) ],
  ];
  $data1cols = [
    __('Username'), 
    __('Added Posts'), 
    __('Tags')
  ];
  $data1rows = [
    [ 
      'username' => 'al_hakami', 
      'additions' => 5, 
      'tags' => [
        [
          'tag' => 'جازان',
          'additions' => 3,
        ],
        [
          'tag' => 'دحيقة',
          'additions' => 2,
        ],
      ], 
    ],
    [ 
      'username' => 'al_abdili', 
      'additions' => 2, 
      'tags' => [
        [
          'tag' => 'باعشن',
          'additions' => 1,
        ],
      ], 
    ],
    [ 
      'username' => 'ali_alharbi', 
      'additions' => 1, 
      'tags' => [
        [
          'tag' => 'دحيقة',
          'additions' => 1,
        ],
      ], 
    ],
  ];
@endphp

<div role="heading" style="font-size: 1.3cm">تقرير الأرشيف</div>
<span style="font-size: .5cm">{{ join(' ', ['بواسطة: المشرف', '  al_hakami  ', 'في يوم', now()->diffForHumans()]) }}</span>
<br />
<h2>الأرشيف الإلكتروني لشهر (محرم) 1444 هـ</h2>

<hr />
<h3 style="font-size: .5cm">{{ __('Operations Summary') }}</h3>
<table>
  @foreach ($data0 as $idx => $row)
    <tr>
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
      @foreach ($data1cols as $column)      
        <th bgcolor="#9fc4e7">{{ $column }}</th>
      @endforeach
    </tr>
  </thead>
  <tbody>
    @foreach ($data1rows as $row)
      <tr>
        <td>{{ $row['username'] }}</td>
        <td>{{ $row['additions'] }}</td>
        <td>{{ join('، ', array_map(fn ($x) => $x['tag'].' '.'('.$x['additions'].')', $row['tags'])) }}</td>
      </tr>
    @endforeach
  </tbody>
</table>