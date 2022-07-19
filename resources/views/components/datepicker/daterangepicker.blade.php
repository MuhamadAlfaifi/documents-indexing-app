@props(['name' => 'date', 'selectedDate' => ''])

<div class="h-6">
  <div id="reportrange" class="block px-2 w-full h-full border-0 border-b border-transparent rounded-md bg-gray-100 focus:border-indigo-600 focus:ring-0 sm:text-sm">
    <span class="w-48 h-full"></span>
    <input type="hidden" onchange="event.target.form.submit()" {{ str('disabled')->if(blank($selectedDate)) }} name="{{ $name }}" />
  </div>
</div>

<script type="text/javascript">
  $(function() {
    // moment().locale('ar-sa');
    var skipFirst = true;

    function cb(start, end) {
      if (skipFirst) {
        skipFirst = false;
        return;
      }
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      $('#reportrange input').val([start.unix(), end.unix()].join());
    }

    $('#reportrange').daterangepicker({
      ranges: {
        'اليوم': [moment(), moment()],
        'أمس': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'آخر ٧ أيام': [moment().subtract(6, 'days'), moment()],
        'آخر ٣٠ يوم': [moment().subtract(29, 'days'), moment()],
        'الشهر الحالي': [moment().startOf('month'), moment().endOf('month')],
        'الشهر الماضي': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
    }, cb);

    cb(start, end);

  });
</script>
